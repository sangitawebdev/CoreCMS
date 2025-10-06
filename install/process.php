<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Invalid request");
}

$db_name     = $_POST['db_name'];
$db_user     = $_POST['db_user'];
$db_pass     = $_POST['db_pass'];
$db_host     = $_POST['db_host'];
$site_name   = $_POST['site_name'];
$admin_user  = $_POST['admin_user'];
$admin_email = $_POST['admin_email'];
$admin_pass  = password_hash($_POST['admin_pass'], PASSWORD_BCRYPT);

// 1. Try DB connection
try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}

// 2. Create tables
$queries = [

    // Users table (WP-style)
    "CREATE TABLE IF NOT EXISTS users (
        id BIGINT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_login VARCHAR(60) NOT NULL UNIQUE,
        user_pass VARCHAR(255) NOT NULL,
        user_nicename VARCHAR(50) NOT NULL,
        user_email VARCHAR(100) NOT NULL UNIQUE,
        user_url VARCHAR(100) DEFAULT NULL,
        user_registered DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        user_activation_key VARCHAR(255) DEFAULT NULL,
        user_status INT(11) NOT NULL DEFAULT 0,
        display_name VARCHAR(250) NOT NULL,
        role ENUM('admin','editor','author','subscriber') DEFAULT 'subscriber',
        KEY user_login_key (user_login),
        KEY user_nicename (user_nicename) 
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    // Posts table
    "CREATE TABLE IF NOT EXISTS posts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id BIGINT(20) UNSIGNED NOT NULL,
        title VARCHAR(255),
        slug VARCHAR(255) UNIQUE,
        content TEXT,
        status ENUM('draft','published') DEFAULT 'draft',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",

    // Options table
    "CREATE TABLE IF NOT EXISTS options (
        id INT AUTO_INCREMENT PRIMARY KEY,
        option_name VARCHAR(100) UNIQUE,
        option_value TEXT
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ",

    "CREATE TABLE menus (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        slug VARCHAR(255) NOT NULL UNIQUE,
        type VARCHAR(50) NULL
    );",

    "CREATE TABLE menu_items (
        id INT AUTO_INCREMENT PRIMARY KEY,
        menu_id INT NOT NULL,
        title VARCHAR(255) NOT NULL,
        url VARCHAR(255) DEFAULT NULL,
        parent_id INT DEFAULT NULL,
        position INT DEFAULT 0,
        type ENUM('custom','page','category') DEFAULT 'custom',
        FOREIGN KEY (menu_id) REFERENCES menus(id) ON DELETE CASCADE,
        FOREIGN KEY (parent_id) REFERENCES menu_items(id) ON DELETE CASCADE
    );"
];


foreach ($queries as $sql) {
    $pdo->exec($sql);
}
// Generate user_nicename: lowercase, letters, numbers, underscores only
$admin_log = preg_replace('/[^A-Za-z0-9_]+/', '_', $admin_user); 
$admin_log = strtolower($admin_log); 
$admin_log = preg_replace('/_+/', '_', $admin_log); 
$admin_log = trim($admin_log, '_');  
 

$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST']; 
$folder = rtrim(str_replace('\\', '/', dirname(dirname($_SERVER['SCRIPT_NAME']))), '/'); 
$folder = $folder === '' || $folder === '/' ? '' : $folder;
$base_url = $protocol . '://' . $host . $folder;

// Generate user URL
$user_url = $base_url;

// 3. Insert default admin & site name & site url
$stmt = $pdo->prepare("
    INSERT INTO users 
    (user_login, user_pass, user_nicename, user_email, display_name, user_url, role) 
    VALUES (?, ?, ?, ?, ?, ?, 'admin')
");
$stmt->execute([$admin_log, $admin_pass, $admin_user, $admin_email, $admin_user, $user_url]);

 

$stmt = $pdo->prepare("INSERT INTO options (option_name, option_value) VALUES (?, ?)");
$stmt->execute(['site_name', $site_name]);
$stmt->execute(['base_url', $base_url]);

// 4. Create config.php file
$config_content = "<?php
return [
'app_name' => '$site_name',   // Dynamic site name
'base_url' => '$base_url',
'db' => [
'host' => '$db_host',
'name' => '$db_name',
'user' => '$db_user',
'pass' => '$db_pass'
]
];";

file_put_contents(__DIR__ . '/../config/config.php', $config_content);

// 5. Redirect to login
header("Location: $base_url/login");
exit;
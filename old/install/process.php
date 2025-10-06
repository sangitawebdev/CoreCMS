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

    "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE,
        email VARCHAR(100) UNIQUE,
        password VARCHAR(255),
        role ENUM('admin','editor','author','subscriber') DEFAULT 'admin',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )",

    "CREATE TABLE IF NOT EXISTS posts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        title VARCHAR(255),
        slug VARCHAR(255) UNIQUE,
        content TEXT,
        status ENUM('draft','published') DEFAULT 'draft',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )",

    "CREATE TABLE IF NOT EXISTS options (
        id INT AUTO_INCREMENT PRIMARY KEY,
        option_name VARCHAR(100) UNIQUE,
        option_value TEXT
    )"
];

foreach ($queries as $sql) {
    $pdo->exec($sql);
}

// 3. Insert default admin & site name
$stmt = $pdo->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, 'admin')");
$stmt->execute([$admin_user, $admin_email, $admin_pass]);

$stmt = $pdo->prepare("INSERT INTO options (option_name, option_value) VALUES ('site_name', ?)");
$stmt->execute([$site_name]);

// 4. Create config.php file
$config_content = "<?php
return [
    'app_name' => 'CoreCMS',
    'base_url' => 'http://localhost/CoreCMS',
    'db' => [
        'host' => '$db_host',
        'name' => '$db_name',
        'user' => '$db_user',
        'pass' => '$db_pass'
    ]
];";

file_put_contents(__DIR__ . '/../config/config.php', $config_content);

// 5. Redirect to login
echo "<h2>Installation Complete ✅</h2>";
echo "<p><a href='../login'>Go to Login</a></p>";

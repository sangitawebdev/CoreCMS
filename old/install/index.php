<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CoreCMS Installation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f1f1;
            margin: 0;
            padding: 0;
        }
        .installer-wrapper {
            max-width: 600px;
            margin: 60px auto;
            background: #fff;
            border-radius: 10px;
            padding: 30px 40px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        h3 {
            margin-top: 30px;
            border-bottom: 1px solid #eee;
            padding-bottom: 8px;
            color: #444;
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 12px;
            margin-bottom: 6px;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }
        button {
            margin-top: 25px;
            width: 100%;
            padding: 12px;
            background: #0073aa;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background: #005f8d;
        }
        .footer-note {
            text-align: center;
            margin-top: 25px;
            font-size: 13px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="installer-wrapper">
        <h1>Welcome to CoreCMS 🚀</h1>
        <p style="text-align:center; color:#555;">Please provide the required details to set up your site.</p>

        <form method="POST" action="process.php">
            <h3>Database Info</h3>
            <label for="db_name">Database Name</label>
            <input type="text" id="db_name" name="db_name" required>

            <label for="db_user">Database User</label>
            <input type="text" id="db_user" name="db_user" required>

            <label for="db_pass">Database Password</label>
            <input type="password" id="db_pass" name="db_pass">

            <label for="db_host">Database Host</label>
            <input type="text" id="db_host" name="db_host" value="localhost" required>

            <h3>Site Info</h3>
            <label for="site_name">Site Name</label>
            <input type="text" id="site_name" name="site_name" required>

            <h3>Admin User</h3>
            <label for="admin_user">Username</label>
            <input type="text" id="admin_user" name="admin_user" required>

            <label for="admin_email">Email</label>
            <input type="email" id="admin_email" name="admin_email" required>

            <label for="admin_pass">Password</label>
            <input type="password" id="admin_pass" name="admin_pass" required>

            <button type="submit">Install CoreCMS</button>
        </form>

        <div class="footer-note">
            &copy; <?= date("Y"); ?> CoreCMS. Inspired by WordPress.
        </div>
    </div>
</body>
</html>

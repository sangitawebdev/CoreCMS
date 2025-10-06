<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - CoreCMS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f1f1f1;
            margin: 0;
            padding: 0;
        }
        .login-wrapper {
            width: 350px;
            margin: 80px auto;
            background: #fff;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0,0,0,0.1);
        }
        .login-wrapper h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
        }
        label {
            font-weight: bold;
            display: block;
            margin: 10px 0 6px;
        }
        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }
        button {
            margin-top: 20px;
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
        .error {
            background: #ffebe8;
            border: 1px solid #dd3c10;
            color: #dd3c10;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            font-size: 13px;
        }
        .footer-note {
            text-align: center;
            margin-top: 25px;
            font-size: 13px;
            color: #777;
        }
        .site-logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .site-logo h1 {
            font-size: 24px;
            margin: 0;
            color: #0073aa;
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="site-logo">
            <!-- You can replace with logo.png later -->
            <h1>CoreCMS</h1>
        </div>

        <h2>Login</h2>

        <?php if (!empty($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <label>Email</label>
            <input type="email" name="email" required>

            <label>Password</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>

    <div class="footer-note">
        &copy; <?= date("Y"); ?> CoreCMS. All rights reserved.
    </div>
</body>
</html>

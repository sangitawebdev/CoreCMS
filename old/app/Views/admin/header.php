<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CoreCMS Admin</title>
    <link rel="stylesheet" href="/CoreCMS/public/css/admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="admin-topbar">
    <div class="logo">CoreCMS</div>
    <div class="topbar-right">
        <input type="text" placeholder="Search..." class="topbar-search">
        <div class="user-menu">
            <?= $_SESSION['user']['username']; ?> ▼
            <ul class="user-dropdown">
                <li><a href="/CoreCMS/logout">Logout</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="admin-container">

<?php
$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

function isActive($path, $currentPath) {
    return str_starts_with($currentPath, $path) ? 'bg-primary text-white fw-bold' : 'link-dark';
}
?>

<div class="col-md-2 sidebar vh-100 p-3 bg-light">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="<?= BASE_URL ?>/dashboard" class="nav-link <?= isActive('/CoreCMS/dashboard', $currentPath) ?>">Dashboard</a>
        </li>
        <li class="nav-item">
            <a href="<?= BASE_URL ?>/admin/posts" class="nav-link <?= isActive('/CoreCMS/admin/posts', $currentPath) ?>">Posts</a>
        </li>
        <li class="nav-item">
            <a href="<?= BASE_URL ?>/admin/pages" class="nav-link <?= isActive('/CoreCMS/admin/pages', $currentPath) ?>">Pages</a>
        </li>
        <li class="nav-item">
            <a href="<?= BASE_URL ?>/admin/media" class="nav-link <?= isActive('/CoreCMS/admin/media', $currentPath) ?>">Media</a>
        </li>
        <li class="nav-item">
            <a href="<?= BASE_URL ?>/admin/users" class="nav-link <?= isActive('/CoreCMS/admin/users', $currentPath) ?>">Users</a>
        </li>
       
        <li class="nav-item">
            <a href="<?= BASE_URL ?>/admin/menu" class="nav-link <?= isActive('/CoreCMS/admin/menu', $currentPath) ?>">Menu</a>
        </li>
         <li class="nav-item">
            <a href="<?= BASE_URL ?>/admin/settings" class="nav-link <?= isActive('/CoreCMS/admin/settings', $currentPath) ?>">Settings</a>
        </li>
    </ul>
</div>

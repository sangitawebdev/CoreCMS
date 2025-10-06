<?php
use App\Models\Option;

// Fetch theme options
$logo = Option::get('site_logo');
$primary = Option::get('primary_color') ?: '#000000';
$secondary = Option::get('secondary_color') ?: '#ffffff';
$headerText = Option::get('header_text') ?: 'Welcome to CoreCMS';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $headerText ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: <?= $primary ?>;
            --secondary-color: <?= $secondary ?>;
        }
        body { color: var(--primary-color); }
        a { color: var(--primary-color); }
        header { background-color: var(--primary-color); color: var(--secondary-color); }
    </style>
</head>
<body>

<header class="py-3 text-center">
    <?php if ($logo): ?>
        <img src="<?= $logo ?>" alt="Logo" class="img-fluid" style="max-height:80px;">
    <?php endif; ?>
    <h1 class="mt-2"><?= $headerText ?></h1>
</header>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: <?= $primary ?>;">
  <div class="container">
    <a class="navbar-brand" href="<?= BASE_URL ?>">CoreCMS</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <?php
        $menuItems = Option::get('menu_items');
        if ($menuItems) {
            $items = explode(',', $menuItems);
            foreach ($items as $item):
                $item = trim($item);
        ?>
        <li class="nav-item"><a class="nav-link text-white" href="#"><?= htmlspecialchars($item) ?></a></li>
        <?php endforeach; } ?>
      </ul>
    </div>
  </div>
</nav>

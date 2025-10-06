<?php
if (session_status() == PHP_SESSION_NONE) session_start();
require __DIR__ . '/../header.php';
require __DIR__ . '/../sidebar.php';
?>

<div class="col-md-10 py-3">
    <h1 class="h3 mb-4">Add New Menu</h1>
    <form method="post" action="<?= BASE_URL ?>/admin/menu/add">
        <div class="mb-3">
            <label class="form-label">Name:</label>
            <input type="text" class="form-control" name="name" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Slug:</label>
            <input type="text" class="form-control" name="slug" required>
        </div>
<div class="mb-3">
    <label class="form-label">Menu Type:</label>
    <select name="type" class="form-select" required>
         <option value="" <?= ($menu['type'] ?? '') == '' ? 'selected' : '' ?>>--Select--</option>
        <option value="header" <?= ($menu['type'] ?? '') == 'header' ? 'selected' : '' ?>>Header Menu</option>
        <option value="footer" <?= ($menu['type'] ?? '') == 'footer' ? 'selected' : '' ?>>Footer Menu</option>
        <option value="sidebar" <?= ($menu['type'] ?? '') == 'sidebar' ? 'selected' : '' ?>>Sidebar Menu</option>
    </select>
</div>

        <button type="submit" class="btn btn-primary">Save Menu</button>
    </form>
</div>

<?php require __DIR__ . '/../footer.php'; ?>

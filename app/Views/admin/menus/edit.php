<?php
if (session_status() == PHP_SESSION_NONE) session_start();
require __DIR__ . '/../header.php';
require __DIR__ . '/../sidebar.php';
?>

<div class="col-md-10 py-3">

    <h1 class="h3 mb-4">Edit Menu: <?= htmlspecialchars($menu['name']) ?></h1>
    <form method="post" action="<?= BASE_URL ?>/admin/menu/edit/<?= $menu['id'] ?>">
        <div class="mb-3">
            <label class="form-label">Name:</label>
            <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($menu['name']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Slug:</label>
            <input type="text" class="form-control" name="slug" value="<?= htmlspecialchars($menu['slug']) ?>" required>
        </div>
<div class="mb-3">
    <label class="form-label">Type:</label>
    <select name="type" class="form-select">
        <option value="" <?= empty($menu['type']) ? 'selected' : '' ?>>— None —</option>
        <option value="header" <?= ($menu['type'] === 'header') ? 'selected' : '' ?>>Header</option>
        <option value="footer" <?= ($menu['type'] === 'footer') ? 'selected' : '' ?>>Footer</option>
        <option value="sidebar" <?= ($menu['type'] === 'sidebar') ? 'selected' : '' ?>>Sidebar</option>
    </select>
</div>
 


        <button type="submit" class="btn btn-primary">Update Menu</button>
    </form>

    <hr class="my-4">

    <h2>Menu Items</h2>
    <a href="<?= BASE_URL ?>/admin/menu/items/<?= $menu['id'] ?>/add" class="btn btn-success mb-3">➕ Add New Item</a>

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Title</th>
                <th>URL</th>
                <th>Parent</th>
                <th>Order</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php require __DIR__ . '/items.php'; ?>
        </tbody>
    </table>
</div>

<?php require __DIR__ . '/../footer.php'; ?>

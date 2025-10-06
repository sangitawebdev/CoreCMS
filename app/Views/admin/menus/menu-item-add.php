<?php
if (session_status() == PHP_SESSION_NONE) session_start();
require __DIR__ . '/../header.php';
require __DIR__ . '/../sidebar.php';
?>

<div class="col-md-10 py-3">
    <h1 class="h3 mb-4">Add Menu Item to: <?= htmlspecialchars($menu['name']) ?></h1>
    <form method="post" action="<?= BASE_URL ?>/admin/menu/items/<?= $menu['id'] ?>/add">
        <div class="mb-3">
            <label class="form-label">Title:</label>
            <input type="text" class="form-control" name="title" required>
        </div>

        <div class="mb-3">
            <label class="form-label">URL:</label>
            <input type="text" class="form-control" name="url">
        </div>

        <div class="mb-3">
            <label class="form-label">Parent Item:</label>
            <select name="parent_id" class="form-select">
                <option value="">— None —</option>
                <?php foreach ($items as $item): ?>
                    <option value="<?= $item['id'] ?>"><?= htmlspecialchars($item['title']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Position:</label>
            <input type="number" class="form-control" name="position" value="0">
        </div>

        <button type="submit" class="btn btn-primary">Add Item</button>
    </form>
</div>

<?php require __DIR__ . '/../footer.php'; ?>

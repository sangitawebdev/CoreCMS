<?php
if (session_status() == PHP_SESSION_NONE) session_start();
require __DIR__ . '/../header.php';
require __DIR__ . '/../sidebar.php';
?>

<div class="col-md-10 py-3">
    <h1 class="h3 mb-4">Edit Menu Item: <?= htmlspecialchars($item['title']) ?></h1>
    <form method="post" action="<?= BASE_URL ?>/admin/menu/items/<?= $menu['id'] ?>/edit/<?= $item['id'] ?>">

        <div class="mb-3">
            <label class="form-label">Title:</label>
            <input type="text" class="form-control" name="title" value="<?= htmlspecialchars($item['title']) ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">URL:</label>
            <input type="text" class="form-control" name="url" value="<?= htmlspecialchars($item['url']) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Parent:</label>
            <select name="parent_id" class="form-select">
                <option value="">— None —</option>
                <?php foreach ($items as $i): ?>
                    <option value="<?= $i['id'] ?>" <?= ($item['parent_id'] == $i['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($i['title']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Order:</label>
            <input type="number" class="form-control" name="position" value="<?= $item['position'] ?>">
        </div>

        <button type="submit" class="btn btn-primary">Update Item</button>
        <a href="<?= BASE_URL ?>/admin/menu/edit/<?= $menu['id'] ?>" class="btn btn-secondary ms-2">Cancel</a>
    </form>
</div>

<?php require __DIR__ . '/../footer.php'; ?>

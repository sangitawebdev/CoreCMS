<?php
if (session_status() == PHP_SESSION_NONE) session_start();
require __DIR__ . '/../header.php';
require __DIR__ . '/../sidebar.php';
?>

<div class="col-md-10 py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Menus</h1>
        <a href="<?= BASE_URL ?>/admin/menu/add" class="btn btn-primary">➕ Add New Menu</a>
    </div>

    <?php if (!empty($menus)): ?>
        <div class="row g-3">
            <?php foreach ($menus as $menu): ?>
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title mb-1"><?= htmlspecialchars($menu['name']) ?></h5>
                                <p class="card-text text-muted mb-0"><?= htmlspecialchars($menu['slug']) ?></p>
                            </div>
                            <div class="btn-group">
                                <a href="<?= BASE_URL ?>/admin/menu/edit/<?= $menu['id'] ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                                <a href="<?= BASE_URL ?>/admin/menu/delete/<?= $menu['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this menu?');">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-info">No menus found. Click "Add New Menu" to create one.</div>
    <?php endif; ?>
</div>

<?php require __DIR__ . '/../footer.php'; ?>

<?php
if (session_status() == PHP_SESSION_NONE) session_start();
require __DIR__ . '/header.php';
require __DIR__ . '/sidebar.php';
?>

<div class="col-md-10 py-4">
    <h1 class="h3 mb-4">Theme Settings</h1>

    <?php if (!empty($_SESSION['message'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <!-- Site Logo -->
        <div class="mb-3">
            <label class="form-label">Site Logo:</label><br>
            <?php if ($logo): ?>
                <img src="<?= $logo ?>" alt="Logo" class="img-thumbnail mb-2" style="max-width:150px"><br>
            <?php endif; ?>
            <input type="file" name="site_logo" class="form-control">
        </div>

        <!-- Primary Color -->
        <div class="mb-3">
            <label class="form-label">Primary Color:</label>
            <input type="color" name="primary_color" value="<?= htmlspecialchars($primary_color) ?>" class="form-control form-control-color" style="width: 100px;">
        </div>

        <!-- Secondary Color -->
        <div class="mb-3">
            <label class="form-label">Secondary Color:</label>
            <input type="color" name="secondary_color" value="<?= htmlspecialchars($secondary_color) ?>" class="form-control form-control-color" style="width: 100px;">
        </div>

        <!-- Header Text -->
        <div class="mb-3">
            <label class="form-label">Header Text:</label>
            <input type="text" name="header_text" value="<?= htmlspecialchars($header_text) ?>" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Save Settings</button>
    </form>
</div>

<?php require __DIR__ . '/footer.php'; ?>

<?php include __DIR__ . '/../layouts/header.php'; ?>

<section class="hero">
    <div class="container">
        <h1>Welcome to <?= htmlspecialchars($site_name) ?></h1>
        <p>Your lightweight PHP CMS – fast, flexible, and powerful.</p>
    </div>
</section>

<section class="features">
    <div class="container">
        <div class="feature">
            <h3>📝 Manage Posts</h3>
            <p>Create and publish content with ease.</p>
        </div>
        <div class="feature">
            <h3>⚡ Fast & Simple</h3>
            <p>No bloated plugins. Just what you need.</p>
        </div>
        <div class="feature">
            <h3>🌐 SEO Friendly</h3>
            <p>Clean URLs and meta for better visibility.</p>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../layouts/footer.php'; ?>

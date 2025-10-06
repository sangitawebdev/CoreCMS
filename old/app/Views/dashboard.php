<?php
if (session_status() == PHP_SESSION_NONE) session_start();
require __DIR__ . '/admin/header.php';
require __DIR__ . '/admin/sidebar.php';
?>

<div class="admin-content">
    <h1>Dashboard</h1>

    <div class="dashboard-widgets">
        <div class="widget">
            <h3>Total Posts</h3>
            <?php
            $stmt = Bootstrap::$db->query("SELECT COUNT(*) as total FROM posts");
            $count = $stmt->fetch();
            echo $count['total'];
            ?>
        </div>
        <div class="widget">
            <h3>Total Users</h3>
            <?php
            $stmt = Bootstrap::$db->query("SELECT COUNT(*) as total FROM users");
            $count = $stmt->fetch();
            echo $count['total'];
            ?>
        </div>
        <div class="widget">
            <h3>Recent Posts</h3>
            <ul>
                <?php
                $stmt = Bootstrap::$db->query("SELECT title FROM posts ORDER BY created_at DESC LIMIT 5");
                $posts = $stmt->fetchAll();
                foreach ($posts as $post) {
                    echo "<li>".$post['title']."</li>";
                }
                ?>
            </ul>
        </div>
    </div>

    <div class="charts">
        <canvas id="postsChart" width="400" height="150"></canvas>
    </div>
</div>

<script>
const ctx = document.getElementById('postsChart').getContext('2d');
const postsChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Posts', 'Users'],
        datasets: [{
            label: 'Counts',
            data: [
                <?= $countPosts ?? 0 ?>,
                <?= $countUsers ?? 0 ?>
            ],
            backgroundColor: ['#0073aa','#00a65a']
        }]
    },
    options: { responsive: true }
});
</script>

<?php require __DIR__ . '/admin/footer.php'; ?>

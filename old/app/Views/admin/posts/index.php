<h1>All Posts</h1>
<a href="/CoreCMS/admin/posts/create">Add New Post</a>
<table border="1" cellpadding="10">
<tr><th>ID</th><th>Title</th><th>Author</th><th>Status</th><th>Actions</th></tr>
<?php foreach($posts as $p): ?>
<tr>
    <td><?= $p['id'] ?></td>
    <td><?= $p['title'] ?></td>
    <td><?= $p['username'] ?></td>
    <td><?= $p['status'] ?></td>
    <td>
        <a href="/CoreCMS/admin/posts/edit?id=<?= $p['id'] ?>">Edit</a> |
        <a href="/CoreCMS/admin/posts/delete?id=<?= $p['id'] ?>">Delete</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

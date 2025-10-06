<h1>All Users</h1>
<a href="/CoreCMS/admin/users/create">Add New User</a>
<table border="1" cellpadding="10">
    <tr><th>ID</th><th>Username</th><th>Email</th><th>Role</th><th>Actions</th></tr>
    <?php foreach($users as $u): ?>
    <tr>
        <td><?= $u['id'] ?></td>
        <td><?= $u['username'] ?></td>
        <td><?= $u['email'] ?></td>
        <td><?= $u['role'] ?></td>
        <td>
            <a href="/CoreCMS/admin/users/edit?id=<?= $u['id'] ?>">Edit</a> | 
            <a href="/CoreCMS/admin/users/delete?id=<?= $u['id'] ?>">Delete</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

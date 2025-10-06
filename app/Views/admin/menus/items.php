<?php
function renderTree($items, $level = 0) {
    foreach ($items as $item):
?>
<tr>
    <td><?= str_repeat('--', $level) ?> <?= htmlspecialchars($item['title']) ?></td>
    <td><?= htmlspecialchars($item['url']) ?></td>
    <td><?= $item['parent_id'] ?? '—' ?></td>
    <td><?= $item['position'] ?></td>
    <td>
        <a href="<?= BASE_URL ?>/admin/menu/items/<?= $item['menu_id'] ?>/edit/<?= $item['id'] ?>"  class="btn btn-sm btn-primary me-1">Edit</a>
        <a href="<?= BASE_URL ?>/admin/menu/items/<?= $item['menu_id'] ?>/delete/<?= $item['id'] ?>" class="btn btn-sm btn-danger"  onclick="return confirm('Delete this item?');">Delete</a>
    </td>
</tr>
<?php
        if (!empty($item['children'])) {
            renderTree($item['children'], $level + 1);
        }
    endforeach;
}

if (empty($items)):
?>
<tr><td colspan="5">No menu items found</td></tr>
<?php
else:
    renderTree($items);
endif;
?>

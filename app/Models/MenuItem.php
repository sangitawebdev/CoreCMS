<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class MenuItem
{
    public static function getByMenu($menu_id)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM menu_items WHERE menu_id = ? ORDER BY position ASC");
        $stmt->execute([$menu_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM menu_items WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT INTO menu_items (menu_id, title, url, parent_id, position, type) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['menu_id'],
            $data['title'],
            $data['url'] ?? '',
            $data['parent_id'] ?? null,
            $data['position'] ?? 0,
            $data['type'] ?? 'custom'
        ]);
    }

    public static function update($id, $data)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE menu_items SET title = ?, url = ?, parent_id = ?, position = ?, type = ? WHERE id = ?");
        return $stmt->execute([
            $data['title'],
            $data['url'] ?? '',
            $data['parent_id'] ?? null,
            $data['position'] ?? 0,
            $data['type'] ?? 'custom',
            $id
        ]);
    }

    public static function delete($id)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM menu_items WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

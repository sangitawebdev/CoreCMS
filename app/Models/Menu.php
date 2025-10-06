<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Menu
{
    public static function getAll() {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->query("SELECT * FROM menus ORDER BY name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

public static function getById($id)
{
    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("SELECT * FROM menus WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


    public static function create($name, $slug,$type = '') {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("INSERT INTO menus (name, slug,type) VALUES (?, ?,?)");
        return $stmt->execute([$name, $slug,$type]);
    }

public static function update($id, $name, $slug, $type)
{
    $db = Database::getInstance()->getConnection();

    // ✅ If type is 'footer' or 'header', make sure only one menu can have it
    if (!empty($type)) {
        $stmt = $db->prepare("SELECT id FROM menus WHERE type = ? AND id != ? LIMIT 1");
        $stmt->execute([$type, $id]);
        $existing = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existing) {
            // Set the existing menu's type to NULL
            $stmtNull = $db->prepare("UPDATE menus SET type = NULL WHERE id = ?");
            $stmtNull->execute([$existing['id']]);
        }
    }

    // ✅ Now update the current menu
    $stmt = $db->prepare("UPDATE menus SET name = ?, slug = ?, type = ? WHERE id = ?");
    return $stmt->execute([$name, $slug, $type ?: NULL, $id]);
}


    public static function delete($id) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("DELETE FROM menus WHERE id = ?");
        return $stmt->execute([$id]);
    }
    public static function getByType($type) {
    $db = Database::getInstance()->getConnection();
    $stmt = $db->prepare("SELECT * FROM menus WHERE type = ? LIMIT 1");
    $stmt->execute([$type]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

}

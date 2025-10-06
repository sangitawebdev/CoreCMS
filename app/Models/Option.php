<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class Option
{
    public static function get($key)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT option_value FROM options WHERE option_name = ?");
        $stmt->execute([$key]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['option_value'] : null;
    }

    public static function set($key, $value)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("
            INSERT INTO options (option_name, option_value)
            VALUES (?, ?)
            ON DUPLICATE KEY UPDATE option_value = VALUES(option_value)
        ");
        return $stmt->execute([$key, $value]);
    }
}

<?php
// app/Core/Bootstrap.php

class Bootstrap {
    public static $config;
    public static $db;

    public static function init() {
        // Load config
        self::$config = require __DIR__ . '/../../config/config.php';

        // DB connection (PDO)
        try {
            self::$db = new PDO(
                "mysql:host=" . self::$config['db']['host'] . ";dbname=" . self::$config['db']['name'],
                self::$config['db']['user'],
                self::$config['db']['pass']
            );
            self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("DB Connection failed: " . $e->getMessage());
        }
    }
}

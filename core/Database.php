<?php

namespace Database;

use PDO;

abstract class Database
{
    private static $pdo;
    private const HOSTNAME = "localhost";
    private const DATANAME = "myblog";
    private const USERNAME = "root";
    private const PASSWORD = "";

    private static function setBdd()
    {
        $pdo = new PDO('mysql:host='.self::HOSTNAME.';dbname='. self::DATANAME, self::USERNAME, self::PASSWORD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET CHARACTER SET UTF8'
        ]);
        return self::$pdo = $pdo;
    }

    protected function getDbb()
    {
        if (self::$pdo === null) {
            self::setBdd();
        }
        return self::$pdo;
    }
}
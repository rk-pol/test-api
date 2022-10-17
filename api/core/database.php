<?php
namespace Api\Core;

include './api/config/database.php';

class DataBase
{
    private static $connection = null;

    public function __construct(){}
    public function __wakeup(){}

    public static function getConnection()
    {
        if (self::$connection) {
            return self::$connection;
        }
        $dns = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
        self::$connection = new \PDO($dns, DB_USER, DB_PASSWORD);
        return self::$connection;
    }
}



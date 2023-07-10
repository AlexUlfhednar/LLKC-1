<?php

namespace App\Libs;

use PDO;
use PDOException;

class Db
{
    private static PDO $dbInstance;

    private function __construct() {}
    private function __clone() {}

    public static function getConnection(): PDO
    {
        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
        if ( empty(self::$dbInstance) ) {
            try {
//                self::$dbInstance = new PDO('mysql:host=127.0.0.1;dbname=llkc-1', 'root', 'root1234');
                self::$dbInstance = new PDO($dsn, DB_USER, DB_PASS);
			} catch (PDOException $e) {
                throw new PDOException($e->getMessage(), (int)$e->getCode());
            }
		}
        return self::$dbInstance;
    }
}
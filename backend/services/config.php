<?php

namespace App\services;

use PDO;
use PDOException;

class Database {
   private static $host = 'localhost';
   private static $dbName = 'moje_zdravlje_a';
   private static $username = 'root';
   private static $password = 'g3c9h.,1?0';
   private static $connection = null;


   public static function connect() {
       if (self::$connection === null) {
           try {
               self::$connection = new PDO(
                   "mysql:host=" . self::$host . ";dbname=" . self::$dbName,
                   self::$username,
                   self::$password,
                   [
                       PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                       PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                   ]
               );
           } catch (PDOException $e) {
               die("Connection failed: " . $e->getMessage());
           }
       }
       return self::$connection;
   }
}
class Config {
    public static function JWT_SECRET() {
        return 'aa68644b6dde3f13b99ef790ba7388956a70a24efdd07ea2161612b8a49db7fe';
    }
}

?>
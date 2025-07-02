<?php

namespace App\services;

use PDO;
use PDOException;

class Database {
   /*
   private static $host = self::get_env("DB_NAME", "localhost");
   private static $dbName = 'moje_zdravlje_a';
   private static $username = 'root';
   private static $password = 'g3c9h.,1?0';
   private static $connection = null;
   */
  private static $connection = null;
  public static function DB_NAME() {
    return self::get_env("DB_NAME", "moje_zdravlje_a");
}
   public static function DB_PORT() {
       return self::get_env("DB_PORT", 3306);
   }
   public static function DB_USER() {
       return self::get_env("DB_USER", 'root');
   }
   public static function DB_PASSWORD() {
       return self::get_env("DB_PASSWORD", '');
   }
   public static function DB_HOST() {
       return self::get_env("DB_HOST", '127.0.0.1');
   }



   public static function connect() {
       if (self::$connection === null) {
           try {
               self::$connection = new PDO(
                   "mysql:host=" . self::DB_HOST() . ";port=" . self::DB_PORT() . ";dbname=" . self::DB_NAME(),
                   self::DB_USER(),
                   self::DB_PASSWORD(),
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
   public static function get_env($name, $default){
    return isset($_ENV[$name]) && trim($_ENV[$name]) != "" ? $_ENV[$name] : $default;
}
}
class Config {
    public static function JWT_SECRET() {
        return 'aa68644b6dde3f13b99ef790ba7388956a70a24efdd07ea2161612b8a49db7fe';
    }
}

?>
<?php

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

/*

//SETTING REPORTING
ini_set('display_errors' ,1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);  //Svi errori osim NOTICE ( used by prof Becir )

//DATABASE Credential settings :

define('DB_NAME', 'moje_zdravlje_a');
define('DB_PORT' , 3306);
define('DB_USER' , 'root');
define('DB_PASSWORD','g3c9h.,1?0');
define('DB_HOST','127.0.0.1');

*/
?>
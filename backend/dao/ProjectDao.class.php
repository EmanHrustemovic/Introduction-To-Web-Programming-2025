<?php

require_once __DIR__ ."/../config.php";

class ProjectDao{

    protected $connection;

    private $table;

    //CONSTRUCTOR OF THE CLASS
    public function __construct($table) {
        $this->table = $table;

        try {
            $connection = new PDO(
                "mysql:host = ". DB_HOST . ";db_name=" . DB_NAME . ";port=" . DB_PORT , 
                DB_USER,
                DB_PASSWORD , [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
            }
            catch (PDOExceprion $e) {
                throw $e;
            }
    }

}




















?>
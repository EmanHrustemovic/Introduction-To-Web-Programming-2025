<?php

namespace App\dao;
use PDO;


require_once __DIR__ . '/ProjectDao.php';

use App\dao\ProjectDao;

class AuthDao extends ProjectDao{

    protected $table_name;
    
    public function __construct() {
        $this->table_name = 'user';
        parent::__construct($this->table_name);
    }

    public function get_user_by_email($email) {
        $query = "SELECT id, email, password, uloga AS role FROM " . $this->table_name . " WHERE email = :email";
        return $this->query_unique($query, ['email' => $email]);
    }

    /*

    public function get_user_by_email($email) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email";
        return $this->query_unique($query, ['email' => $email]);
    }
    */
}
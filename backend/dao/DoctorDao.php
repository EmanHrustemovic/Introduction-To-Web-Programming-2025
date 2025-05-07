<?php

namespace App\dao;
use App\dao\ProjectDao;

use PDO;

require_once 'services/config.php';
require_once __DIR__ . '/ProjectDao.php';

class DoctorDao extends ProjectDao {
    public function __construct() {
        parent::__construct('doktor_info'); 
    }

    public function getAllDoctors() {
        $stmt = $this->connection->prepare("SELECT * FROM doktor_info");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByDocID($id) {
        $stmt = $this->connection->prepare("SELECT * FROM doktor_info WHERE user_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function addDoctor($user_id, $titula, $odjeljenje) {
        $sql = "INSERT INTO doktor_info (user_id, titula, odjeljenje) 
                VALUES (:user_id, :titula, :odjeljenje)";
        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':titula', $titula);
        $stmt->bindParam(':odjeljenje', $odjeljenje);

        $stmt->execute();
    }

    public function updateDoctor($id, $data) {
        $sql = "UPDATE doktor_info 
                SET user_id = :user_id, titula = :titula, odjeljenje = :odjeljenje 
                WHERE user_id = :id";
        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(':user_id', $data->user_id);
        $stmt->bindParam(':titula', $data->titula);
        $stmt->bindParam(':odjeljenje', $data->odjeljenje);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function deleteDoctor($id) {
        $stmt = $this->connection->prepare("DELETE FROM doktor_info WHERE user_id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
    /*
    private $conn;
    private $pdo;

    public function __construct() {
        parent::__construct('doktor');

    }

    public function getAllDoctors() {
        $stmt = $this->connection->prepare("SELECT * FROM doktor_info");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByDocID($id) {
        $stmt = $this->connection->prepare("SELECT * FROM doktor_info WHERE user_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function addDoctor($user_id, $titula, $odjeljenje) {
        $sql = "INSERT INTO doktor_info (user_id, titula, odjeljenje) 
            VALUES (:user_id, :titula, :odjeljenje)";

        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':titula', $titula);
        $stmt->bindParam(':odjeljenje', $odjeljenje);

        $stmt->execute();
    }


    public function updateDoctor($id, $data) {
        $sql = "UPDATE doktor_info SET user_id = :user_id, titula = :titula, odjeljenje = :odjeljenje 
              WHERE user_id = :id";
        
        $stmt = $this->connection->prepare($sql);

        $user_id = $data->user_id;
        $titula = $data->titula;
        $odjeljenje = $data->odjeljenje;

        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':titula', $titula);
        $stmt->bindParam(':odjeljenje', $odjeljenje);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function deleteDoctor($id) {
        $sql = "DELETE FROM doktor_info WHERE user_id = :id";
        
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function getConn() {
        return $this->conn;
    }
    */
}

<?php

namespace App\dao;

//require_once '../services/config.php';
require_once __DIR__ . '/ProjectDao.php';

class PreglediDao extends ProjectDao {
    private $pdo;

    public function __construct() {
        parent::__construct('pregledi');

//        try {
//            $servername = 'localhost';
//            $db_name = 'moje_zdravlje';
//            $username = 'root';
//            $password = 'g3c9h.,1?0';
//
//            $this->pdo = new PDO("mysql:host=$servername;dbname={$db_name}", $username, $password);
//            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        } catch (PDOException $e) {
//            die("Connection failed: " . $e->getMessage());
//        }
    }

    public function getAllChecks() {
        $stmt = $this->pdo->prepare("SELECT * FROM pregledi");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function preglediPoID($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM pregledi WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function dodajPregled($data) {
        $sql = "INSERT INTO pregledi (nazivPregleda, datum_vrijeme, status, opis, rezultati, odjeljenje_id, doktor_id, preporuka)
                VALUES (:nazivPregleda, :datum_vrijeme, :status, :opis, :rezultati, :odjeljenje_id, :doktor_id, :preporuka)";

        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($data);
    }

    public function izmjeniPregled($id, $data) {
        $sql = "UPDATE pregledi SET 
                    nazivPregleda = :nazivPregleda, 
                    datum_vrijeme = :datum_vrijeme, 
                    status = :status, 
                    opis = :opis, 
                    rezultati = :rezultati, 
                    odjeljenje_id = :odjeljenje_id, 
                    doktor_id = :doktor_id, 
                    preporuka = :preporuka 
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        $data[':id'] = $id;
        return $stmt->execute($data);
    }

    public function obrišiPregled($id) {
        $sql = "DELETE FROM pregledi WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>

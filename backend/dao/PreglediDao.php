<?php

namespace App\dao;
use App\dao\ProjectDao;

use PDO;

require_once __DIR__ . '/ProjectDao.php';

class PreglediDao extends ProjectDao {

    public function __construct() {
        parent::__construct('pregledi');
    }

    public function getAllChecks() {
        $stmt = $this->connection->prepare("SELECT * FROM pregledi");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function preglediPoID($id) {
        $stmt = $this->connection->prepare("SELECT * FROM pregledi WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function dodajPregled($id, $nazivPregleda, $datum_vrijeme, $status, $opis, $rezultati, $odjeljenje_id, $doktor_id, $preporuka) {
        $sql = "INSERT INTO pregledi 
                    (id, nazivPregleda, datum_vrijeme, status, opis, rezultati, odjeljenje_id, doktor_id, preporuka) 
                VALUES 
                    (:id, :nazivPregleda, :datum_vrijeme, :status, :opis, :rezultati, :odjeljenje_id, :doktor_id, :preporuka)";

        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nazivPregleda', $nazivPregleda);
        $stmt->bindParam(':datum_vrijeme', $datum_vrijeme);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':opis', $opis);
        $stmt->bindParam(':rezultati', $rezultati);
        $stmt->bindParam(':odjeljenje_id', $odjeljenje_id);
        $stmt->bindParam(':doktor_id', $doktor_id);
        $stmt->bindParam(':preporuka', $preporuka);

        $stmt->execute();
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

        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(':nazivPregleda', $data->nazivPregleda);
        $stmt->bindParam(':datum_vrijeme', $data->datum_vrijeme);
        $stmt->bindParam(':status', $data->status);
        $stmt->bindParam(':opis', $data->opis);
        $stmt->bindParam(':rezultati', $data->rezultati);
        $stmt->bindParam(':odjeljenje_id', $data->odjeljenje_id);
        $stmt->bindParam(':doktor_id', $data->doktor_id);
        $stmt->bindParam(':preporuka', $data->preporuka);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function obrisiPregled($id) {
        $stmt = $this->connection->prepare("DELETE FROM pregledi WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /*
    private $pdo;

    public function __construct() {
        parent::__construct('pregledi');

    }

    public function getAllChecks() {
        $stmt = $this->connection->prepare("SELECT * FROM pregledi");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function preglediPoID($id) {
        $stmt = $this->connection->prepare("SELECT * FROM pregledi WHERE id = :id");
        $stmt->bindParam(':id', $id);

        $stmt->execute();
        return $stmt->fetch();
    }

    public function dodajPregled($id,$nazivPregleda,$datum_vrijeme,$status,$opis,$rezultati,$odjeljenje_id,$doktor_id,$preporuka) {
        $sql = "INSERT INTO pregledi (id,nazivPregleda, datum_vrijeme, status, opis, rezultati, odjeljenje_id, doktor_id, preporuka)
                VALUES (:id,:nazivPregleda, :datum_vrijeme, :status, :opis, :rezultati, :odjeljenje_id, :doktor_id, :preporuka)";

        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nazivPregleda', $nazivPregleda);
        $stmt->bindParam(':datum_vrijeme', $datum_vrijeme);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':opis', $opis);
        $stmt->bindParam(':rezultati', $rezultati);
        $stmt->bindParam(':odjeljenje_id', $odjeljenje_id);
        $stmt->bindParam(':doktor_id', $doktor_id);
        $stmt->bindParam(':preporuka', $preporuka);

        $stmt->execute();
    }

    public function izmjeniPregled($id, $data) {
        $sql = "UPDATE pregledi SET nazivPregleda = :nazivPregleda, datum_vrijeme = :datum_vrijeme, status = :status, 
                opis = :opis,rezultati = :rezultati,odjeljenje_id = :odjeljenje_id, doktor_id = :doktor_id, 
                preporuka = :preporuka WHERE id = :id";
    
        $stmt = $this->connection->prepare($sql);
    
        $stmt->bindParam(':nazivPregleda', $data->nazivPregleda);
        $stmt->bindParam(':datum_vrijeme', $data->datum_vrijeme);
        $stmt->bindParam(':status', $data->status);
        $stmt->bindParam(':opis', $data->opis);
        $stmt->bindParam(':rezultati', $data->rezultati);
        $stmt->bindParam(':odjeljenje_id', $data->odjeljenje_id);
        $stmt->bindParam(':doktor_id', $data->doktor_id);
        $stmt->bindParam(':preporuka', $data->preporuka);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Samo ovdje bindamo ID
    
        $stmt->execute();
    }
    

    public function obrisiPregled($id) {
        $sql = "DELETE FROM pregledi WHERE id = :id";
        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getConn() {
        return $this->conn;
    }
    */
}

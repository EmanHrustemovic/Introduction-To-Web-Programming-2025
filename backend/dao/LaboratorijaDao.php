<?php

namespace App\dao;
use App\dao\ProjectDao;

use PDO;

require_once 'services/config.php';
require_once __DIR__ . '/ProjectDao.php';

class LaboratorijaDao extends ProjectDao {

    private $conn;
    private $pdo;

    public function __construct() {
        parent::__construct('laboratorija'); 
    }

    public function pregledLaboratorije() {
        $stmt = $this->connection->prepare("SELECT * FROM laboratorija");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function laboratorijaPoId($id) {
        $stmt = $this->connection->prepare("SELECT * FROM laboratorija WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function addLaboratory($sifraNalaza, $tipNalaza, $vrsta_uzorka, $datum_obrade, $status, $pregledi_id) {
        $sql = "INSERT INTO laboratorija (sifraNalaza, tipNalaza, vrsta_uzorka, datum_obrade, status, pregledi_id) 
            VALUES (:sifraNalaza, :tipNalaza, :vrsta_uzorka, :datum_obrade, :status, :pregledi_id)";

        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(':sifraNalaza', $sifraNalaza);
        $stmt->bindParam(':tipNalaza', $tipNalaza);
        $stmt->bindParam(':vrsta_uzorka', $vrsta_uzorka);
        $stmt->bindParam(':datum_obrade', $datum_obrade);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':pregledi_id', $pregledi_id);

        $stmt->execute();
    }



    public function updateLaboratory($id, $data) {
        $sql = "UPDATE laboratorija SET id = :id, sifraNalaza = :sifraNalaza, tipNalaza = :tipNalaza,
                        vrsta_uzorka =:vrsta_uzorka,datum_obrade =:datum_obrade,
                        status =:status,pregledi_id = :pregledi_id
                WHERE id = :id";

        $stmt = $this->connection->prepare($sql);

        $id = $data->id;

        $sifraNalaza = $data->sifraNalaza;
        $tipNalaza = $data->tipNalaza;
        $vrsta_uzorka = $data -> vrsta_uzorka;
        $datum_obrade = $data -> datum_obrade;
        $status = $data -> status;
        $pregledi_id = $data -> pregledi_id ;

        $stmt->bindParam(':sifraNalaza', $sifraNalaza);
        $stmt->bindParam(':tipNalaza', $tipNalaza);
        $stmt->bindParam(':vrsta_uzorka', $vrsta_uzorka);
        $stmt->bindParam(':datum_obrade', $datum_obrade);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':pregledi_id',$pregledi_id);


        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function deleteLaboratory($id) {
        $sql = "DELETE FROM laboratorija WHERE id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function getConn() {
        return $this->conn;
    }
}


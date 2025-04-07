<?php

require_once '../config.php';
require_once __DIR__ . '/ProjectDao.class.php';

class LaboratorijaDao extends ProjectDao {

    public function __construct() {
        parent::__construct('laboratorija'); 
    }

    public function pregledLaboratorije() {
        $stmt = $this->pdo->prepare("SELECT * FROM laboratorija");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function laboratorijaPoId($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM laboratorija WHERE šifraNalaza = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addLaboratory($data) {
        $sql = "INSERT INTO laboratorija (šifraNalaza, tipNalaza, vrsta_uzorka, datum_obrade, status, pregledi_id) 
                VALUES (:šifraNalaza, :tipNalaza, :vrsta_uzorka, :datum_obrade, :status, :pregledi_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
    }

    public function updateLaboratory($id, $data) {
        $sql = "UPDATE laboratorija SET tipNalaza = :tipNalaza, vrsta_uzorka = :vrsta_uzorka, 
                datum_obrade = :datum_obrade, status = :status, pregledi_id = :pregledi_id 
                WHERE šifraNalaza = :šifraNalaza";
        $stmt = $this->pdo->prepare($sql);
        $data['šifraNalaza'] = $id;
        $stmt->execute($data);
    }

    public function deleteLaboratory($id) {
        $sql = "DELETE FROM laboratorija WHERE šifraNalaza = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>

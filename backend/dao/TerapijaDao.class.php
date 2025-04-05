<?php

require_once __DIR__ . "/../services/config.php";
require_once __DIR__ . "/ProjectDao.class.php";

class TerapijaDao extends ProjectDao {

    public function __construct() {
        parent::__construct('terapija'); 
    }

    public function getAllTherapy(){
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTherapyByID($id){
        $stmt = $this->connection->prepare("SELECT * FROM " . $this->table . " WHERE terapija_id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function addTherapy($data){
        $sql = "INSERT INTO " . $this->table . " (terapija_id, vrsta, doza_i_uputa, trajanje, kontrola, doktor_id, pregledi_id)
                VALUES (:terapija_id, :vrsta, :doza_i_uputa, :trajanje, :kontrola, :doktor_id, :pregledi_id)";

        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(':terapija_id', $data['terapija_id'], PDO::PARAM_INT);
        $stmt->bindParam(':vrsta', $data['vrsta'], PDO::PARAM_STR);
        $stmt->bindParam(':doza_i_uputa', $data['doza_i_uputa'], PDO::PARAM_STR);
        $stmt->bindParam(':trajanje', $data['trajanje'], PDO::PARAM_STR);
        $stmt->bindParam(':kontrola', $data['kontrola'], PDO::PARAM_STR);
        $stmt->bindParam(':doktor_id', $data['doktor_id'], PDO::PARAM_INT);
        $stmt->bindParam(':pregledi_id', $data['pregledi_id'], PDO::PARAM_INT);

        $stmt->execute();
    }

    public function updateTherapy($id, $data){
        $sql = "UPDATE " . $this->table . " SET 
                vrsta = :vrsta, 
                doza_i_uputa = :doza_i_uputa,
                trajanje = :trajanje,
                kontrola = :kontrola,
                doktor_id = :doktor_id,
                pregledi_id = :pregledi_id
                WHERE terapija_id = :id"; 

        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':vrsta', $data['vrsta'], PDO::PARAM_STR);
        $stmt->bindParam(':doza_i_uputa', $data['doza_i_uputa'], PDO::PARAM_STR);
        $stmt->bindParam(':trajanje', $data['trajanje'], PDO::PARAM_STR);
        $stmt->bindParam(':kontrola', $data['kontrola'], PDO::PARAM_STR);
        $stmt->bindParam(':doktor_id', $data['doktor_id'], PDO::PARAM_INT);
        $stmt->bindParam(':pregledi_id', $data['pregledi_id'], PDO::PARAM_INT);

        $stmt->execute();
    }

    public function deleteTherapy($id){
        $sql = "DELETE FROM " . $this->table . " WHERE terapija_id = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}

?>
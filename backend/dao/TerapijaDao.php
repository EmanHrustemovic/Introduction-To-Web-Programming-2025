<?php

namespace App\dao;
use App\dao\ProjectDao;

use PDO;

require_once __DIR__ . "/../services/config.php";
require_once __DIR__ . "/ProjectDao.php";

class TerapijaDao extends ProjectDao {

    private $conn;
    private $pdo;


    public function __construct() {
        parent::__construct('terapija'); 
    }

    public function getAllTherapy(){
        $stmt = $this->connection->prepare("SELECT * FROM terapija");

        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTherapyByID($id){

        $stmt = $this->connection->prepare("SELECT * FROM  terapija WHERE id = :id");
        $stmt->bindParam(':id', $id);

        $stmt->execute();
        return $stmt->fetch();
    }

    public function addTherapy($id,$terapija_id,$vrsta,$doza_i_uputa,$trajanje,$kontrola,$doktor_id, $pregledi_id){
        $sql = "INSERT INTO terapija (id,terapija_id,vrsta,doza_i_uputa,trajanje,kontrola,doktor_id, pregledi_id)
                VALUES (:id,:terapija_id, :vrsta, :doza_i_uputa, :trajanje, :kontrola, :doktor_id, :pregledi_id)";

        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':terapija_id', $terapija_id);
        $stmt->bindParam(':vrsta', $vrsta);
        $stmt->bindParam(':doza_i_uputa', $doza_i_uputa);
        $stmt->bindParam(':trajanje', $trajanje);
        $stmt->bindParam(':kontrola', $kontrola);
        $stmt->bindParam(':doktor_id', $doktor_id);
        $stmt->bindParam(':pregledi_id', $pregledi_id);

        $stmt->execute();
    }

    public function updateTherapy($id, $data){
        $sql = "UPDATE terapija SET terapija_id =:terapija_id,vrsta = :vrsta, doza_i_uputa = :doza_i_uputa,trajanje = :trajanje,
                kontrola = :kontrola,doktor_id = :doktor_id,pregledi_id = :pregledi_id WHERE id = :id";

        $stmt = $this->connection->prepare($sql);

        //$id = $data -> id;
        $terapija_id = $data -> terapija_id;
        $vrsta = $data -> vrsta;
        $doza_i_uputa = $data -> doza_i_uputa;
        $trajanje = $data -> trajanje;
        $kontrola = $data -> kontrola;
        $doktor_id = $data -> doktor_id;
        $pregledi_id = $data -> pregledi_id;

        //$stmt->bindParam(':id',$id);
        $stmt->bindParam(':terapija_id', $terapija_id);
        $stmt->bindParam(':vrsta', $vrsta);
        $stmt->bindParam(':doza_i_uputa', $doza_i_uputa);
        $stmt->bindParam(':trajanje', $trajanje);
        $stmt->bindParam(':kontrola', $kontrola);
        $stmt->bindParam(':doktor_id', $doktor_id);
        $stmt->bindParam(':pregledi_id', $pregledi_id);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function deleteTherapy($id){
        $sql = "DELETE FROM terapija WHERE id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function getConn() {
        return $this->conn;
    }
}


<?php
namespace App\services;

require_once __DIR__ . '/ProjectService.php';
require_once __DIR__ . '/../dao/PacijentDao.php';

use Flight;

class PacijentService extends ProjectService {
    
    public function __construct() {
        $dao = Flight::PacijentDao();
        parent::__construct($dao);  
    }

    public function getByPatientID($id) {
        return $this->dao->getPatientByID($id);
    }

    /*
    private $dao;
    
    public function __construct(){

        $this->dao = new PacijentDao();

    }

    public function getAllPatients(){

        return $this->dao->getAllPatients();
    }

    public function getPatientByID($id){

        return $this->dao->getPatientByID($id);
    }

    public function addPatient($pacijent_id,$JMBG,$grad,$tezina,$visina,$datumRodenja,$nazivOsiguranika){

        $this->dao->addPatient($pacijent_id,$JMBG,$grad,$tezina,$visina,$datumRodenja,$nazivOsiguranika);
    }

    public function updatePatient($id, $data){

        return $this->dao->updatePatient($id, $data);
    }

    public function deletePatient($id){

        return $this->dao->deletePatient($id);
    }


    public function insert($data) {
        $data = iterator_to_array($data);
        var_dump($data);
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));

        var_dump($columns);
        var_dump($placeholders);
        die();

        
        $sql = "INSERT INTO " . $this->table . " ($columns) VALUES ($placeholders)";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($data);
    }
    */ 
}
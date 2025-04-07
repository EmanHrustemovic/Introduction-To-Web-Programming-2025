<?php

require_once '../dao/PacijentDao.php';

class PacijentService extends ProjectService {
    
    public function __construct(){

        $dao = new PacijentDao();
        parent::__construct($dao);
    }

    public function getAllPatients(){

        return $this->dao->getAllPatients();
    }

    public function getPatientByID($id){

        return $this->dao->getPatientByID($id);
    }

    public function addPatient($data){

        return $this->dao->addPatient($data);
    }

    public function updatePatient($id, $data){

        return $this->dao->updatePatient($id, $data);
    }

    public function deletePatient($id){

        return $this->dao->deletePatient($id);
    }
}
?>
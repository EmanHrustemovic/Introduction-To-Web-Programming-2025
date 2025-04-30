<?php

require_once '../dao/DoctorDao.php';


class DoctorService extends ProjectService{

    public function __construct(){

        $dao = new DoctorDao(); 
        
        parent::__construct($dao);
    }

    public function getAllDoctors(){
        
        return $this->dao->getAllDoctors();
    }

    public function getByDocID($id){

        return $this->dao->getByDocID($id);
    }

    public function addDoctor($data){

        return $this->dao->addDoctor($data);

    }

    public function deleteDoctor($id){
        
        return $this->dao->deleteDoctor($id);
    }


}

?>
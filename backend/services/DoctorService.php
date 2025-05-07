<?php
namespace App\services;

require_once __DIR__ . '/../services/ProjectService.php';
require_once __DIR__ . '/../dao/DoctorDao.php';  

use Flight;

class DoctorService extends ProjectService {
    
    public function __construct() {
        //$dao = new DoctorDao();
        $dao = Flight::DoctorDao();
        parent::__construct($dao);
    }

    public function getByDocID($id) {
        return $this->dao->getByDocID($id);
    }
}
    /*
    private $dao;

    public function __construct(){

        $this->dao = new DoctorDao();

    }

    public function getAllDoctors(){
        
        $this->dao->getAllDoctors();
    }

    public function getByDocID($id){

        return $this->dao->getByDocID($id);
    }

    public function addDoctor($user_id,$titula,$odjeljenje){

        $this->dao->addDoctor($user_id,$titula,$odjeljenje);
    }

    public function updateDoctor($id,$data){

        return $this->dao->updateDoctor($id,$data);

    }

    public function deleteDoctor($id){
        
        return $this->dao->deleteDoctor($id);
    }
*/
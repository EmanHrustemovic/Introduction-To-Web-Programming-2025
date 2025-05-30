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

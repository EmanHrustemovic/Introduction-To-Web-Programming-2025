<?php

namespace App\services;

require_once __DIR__ . '/ProjectService.php';  
require_once __DIR__ . '/../dao/LaboratorijaDao.php';  

use Flight;

class LaboratorijaService extends ProjectService {

    public function __construct() {
        $dao = Flight::LaboratorijaDao();
        parent::__construct($dao);  
    }

    public function getByLabID($id) {
        return $this->dao->laboratorijaPoId($id);
    }
}

?>
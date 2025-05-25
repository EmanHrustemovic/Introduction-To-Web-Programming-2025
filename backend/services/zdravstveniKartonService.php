<?php

namespace App\services;

require_once __DIR__ . '/ProjectService.php';
require_once __DIR__ . '/../dao/ZdravstveniKartonDao.php';

use Flight;

class ZdravstveniKartonService extends ProjectService {

    public function __construct() {
        $dao = Flight::ZdravstveniKartonDao();
        parent::__construct($dao);
    }

    public function getByMedicalRecordID($id) {
        return $this->dao->kartoniPoID($id);
    }
    
}
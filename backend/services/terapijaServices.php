<?php

namespace App\services;

require_once __DIR__ . '/ProjectService.php';
require_once __DIR__ . '/../dao/TerapijaDao.php';

use Flight;

class TerapijaServices extends ProjectService {

    public function __construct() {
        $dao = Flight::TerapijaDao();
        parent::__construct($dao);
    }

    public function getByTherapyID($id) {
        return $this->dao->getTherapyByID($id);
    }

    /*

    private $dao;

    public function __construct(){

        $this -> dao = new TerapijaDao();
    }

    public function getAllTherapy(){

        $this->dao->getAllTherapy();
    }

    public function getTherapyByID($id){

        return $this->dao->getTherapyByID($id);
    }

    public function addTherapy($id,$terapija_id,$vrsta,$doza_i_uputa,$trajanje,$kontrola,$doktor_id, $pregledi_id){

        $this->dao->addTherapy($id,$terapija_id,$vrsta,$doza_i_uputa,$trajanje,$kontrola,$doktor_id, $pregledi_id);
    }

    public function updateTherapy($id, $data){

        return $this->dao->updateTherapy($id,$data);
    }

    public function deleteTherapy($id){

        return $this->dao->deleteTherapy($id);

    }
    */
}
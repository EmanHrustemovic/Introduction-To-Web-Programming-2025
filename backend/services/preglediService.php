<?php

namespace App\services;

require_once __DIR__ . '/ProjectService.php';
require_once __DIR__ . '/../dao/PreglediDao.php';

use Flight;

class PreglediService extends ProjectService {

    public function __construct() {
        $dao = Flight::PreglediDao();
        parent::__construct($dao);
    }

    public function getByCheckID($id) {
        return $this->dao->preglediPoID($id);
    }

 /*

    private $dao;

    public function __construct(){

        $this -> dao = new PreglediDao();
    }

    public function getAllChecks(){
        
        $this->dao->getAllChecks();
    }

    public function preglediPoID($id){

        return $this->dao->preglediPoID($id);
    }

    public function dodajPregled($id,$nazivPregleda,$datum_vrijeme,$status,$opis,$rezultati,$odjeljenje_id,$doktor_id,$preporuka){

        $this->dao->dodajPregled($id,$nazivPregleda,$datum_vrijeme,$status,$opis,$rezultati,$odjeljenje_id,$doktor_id,$preporuka);
    }

    public function izmjeniPregled($id, $data){

        return $this->dao->izmjeniPregled($id, $data);
    }

    public function obrisiPregled($id){

        return $this->dao->obrisiPregled($id);
    }
    */
}
<?php

namespace App\services;

require_once __DIR__ . '/ProjectService.php';
require_once __DIR__ . '/../dao/ZdravstveniKartonDao.php';

use App\dao\ZdravstveniKartonDao;

class ZdravstveniKartonService extends ProjectService {

    public function __construct() {
        $dao = new ZdravstveniKartonDao();
        parent::__construct($dao);
    }

    public function getByMedicalRecordID($id) {
        return $this->dao->kartoniPoID($id);
    }
    
    /*
    private $dao;

    public function __construct(){

        $this -> dao = new ZdravstveniKartonDao();

    }

    public function izlistajKarton(){

         $this->dao->izlistajKarton();
    }

    public function kartoniPoID($id){

        return $this->dao->kartoniPoID($id);
    }

    public function izmjeniKarton($id, $data){

        return $this->dao->izmjeniKarton($id,$data);
    }

    public function dodajKarton($id,$sifraBolesti,$nazivBolesti,$dijagnoza,$terapija,$pacijent_id,$pregledi_id,$doktor_id){

       return $this->dao->dodajKarton($id,$sifraBolesti,$nazivBolesti,$dijagnoza,$terapija,$pacijent_id,$pregledi_id,$doktor_id);
    }

    public function obrisiKarton($id){

        return $this->dao->obrisiKarton($id);
    }
    */
}
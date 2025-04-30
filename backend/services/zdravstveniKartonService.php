<?php

namespace App\services;

use App\dao\kartonService;

class kartonService {

    private $dao;

    public function __construct(){

        $this -> dao = new ZdravstveniKartontDao();

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

    public function dodajKarton($data){

        return $this->dao->dodajKarton($data);
    }

    public function obrišiKarton($id){

        return $this->dao->obrišiKaton($id);
    }
}
?>
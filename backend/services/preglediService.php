<?php

require_once '../dao/PreglediDao.php';

class PreglediService extends ProjectService{

    public function __construct(){

        $dao = new PacijentDao();
        parent::__construct($dao);
    }

    public function getAllChecks(){
        
        return $this->dao->getAllChecks();
    }

    public function preglediPoID($id){

        return $this->dao->preglediPoID($id);
    }

    public function dodajPregled($data){

        return $this->dao->dodajPregled($data);
    }

    public function izmjeniPregled($id, $data){

        return $this->dao->izmjeniPregled($id, $data);
    }

    public function obrišiPregled($id){

        return $this->dao->obrišiPregled($id);
    }
}
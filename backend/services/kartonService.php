<?php

require_once '../dao/ZdravstveniKartonDao.php';


class TerapijaServices extends ProjectService{

    public function __construct(){

        $dao = new ZdravstveniKartontDao();
        parent::__construct($dao);
    }

    public function dodajKarton($data){

        return $this->dao->dodajKarton($data);
    }

    public function izlistajKarton(){

        return $this->dao->izlistajKarton();
    }

    public function kartoniPoID($id){

        return $this->dao->kartoniPoID($id);
    }

    public function izmjeniKarton($id, $data){

        return $this->dao->izmjeniKarton($id,$data);
    }

    public function obrišiKarton($id){

        return $this->dao->obrišiKaton($id);
    }
}
?>
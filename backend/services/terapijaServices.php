<?php

require_once '../dao/TerapijaDao.php';


class TerapijaServices extends ProjectService{

    public function __construct(){

        $dao = new PacijentDao();
        parent::__construct($dao);
    }

    public function getAllTherapy(){

        return $this->dao->getAllTherapy();
    }

    public function getTherapyByID($id){

        return $this->dao->getTherapyByID($id);
    }

    public function addTherapy($data){

        return $this->dao->addTherapy($data);
    }

    public function updateTherapy($id, $data){

        return $this->updateTherapy($id,$data);
    }

    public function deleteTherapy($id){

        return $this->dao->deleteTherapy($id);

    }
}

?>
<?php

require_once '../dao/LaboratorijaDao.php';

class LaboratorijaService extends ProjectService {
    
    public function __construct(){

        $dao = new LaboratorijaDao();
        parent::__construct($dao);
    }

    public function pregledLaboratorije(){
        
        return $this->dao->pregledLaboratorije();
    } 

    public function laboratorijaPoId($id){

        return $this->dao->laboratorijaPoId($id);
    }

    public function addLaboratory($data){

        return $this->dao->addLaboratory($data);
    }

    public function updateLaboratory($id, $data){

        return $this->dao->updateLaboratory($id, $data);
    }

    public function deleteLaboratory($id){
        
        return $this->dao->deleteLaboratory($id);
    }

}

?>
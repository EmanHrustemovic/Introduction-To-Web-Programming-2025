<?php

namespace App\services;

require_once __DIR__ . '/ProjectService.php';  
require_once __DIR__ . '/../dao/LaboratorijaDao.php';  

use App\dao\LaboratorijaDao;

class LaboratorijaService extends ProjectService {

    public function __construct() {
        $dao = new LaboratorijaDao();
        parent::__construct($dao);  
    }

    public function getByLabID($id) {
        return $this->dao->laboratorijaPoId($id);
    }
}
    /*

    private $dao;

    public function __construct(){

        $this->dao = new LaboratorijaDao();
    }

    public function pregledLaboratorije(){
        
         $this->dao->pregledLaboratorije();
    } 

    public function laboratorijaPoId($id){

        return $this->dao->laboratorijaPoId($id);
    }

    public function addLaboratory($sifraNalaza, $tipNalaza, $vrsta_uzorka, $datum_obrade, $status, $pregledi_id) {

        $this->dao->addLaboratory($sifraNalaza, $tipNalaza, $vrsta_uzorka, $datum_obrade, $status, $pregledi_id);
    }


    public function updateLaboratory($id, $data){

        return $this->dao->updateLaboratory($id, $data);
    }

    public function deleteLaboratory($id){
        
        return $this->dao->deleteLaboratory($id);
    }
*/
?>
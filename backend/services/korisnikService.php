<?php

require_once '../dao/KorisnikDao.php';

class KorisnikService extends ProjectService{

    public function __construct(){

        $dao = new KorisnikDao();
        parent::__construct($dao);
    }

    public function getAllUsers(){

        return $this->dao->getAllUsers();
    }

    public function getUserByID($id){

        return $this->dao->getUserByID($id);
    }

    public function addUser($data){

        return $this->dao->addUser($data);
    }

    public function updateUser($id, $data){

        return $this->dao->updateUser($id, $data);
    }

    public function deleteUser($id){

        return $this->dao->deleteUser($id);
    }
}
?>
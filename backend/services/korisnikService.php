<?php

namespace App\services;

require_once __DIR__ . '/ProjectService.php';
require_once __DIR__ . '/../dao/KorisnikDao.php';  

use Flight;

class KorisnikService extends ProjectService {

    public function __construct() {
        $dao = Flight::KorisnikDao();
        parent::__construct($dao);
    }

    public function getByEmail($email) { //ne znam moram li ovo imati ? 
        return $this->dao->getByEmail($email);
    }

    /*

    private $dao;

    public function __construct(){

        $this -> dao = new KorisnikDao();
        //parent::__construct($dao);

        //Dodaj Base Service 
    }

    public function getAllUsers(){

        return $this->dao->getAllUsers();
    }

    public function getUserByID($id){

        return $this->dao->getUserByID($id);
    }

    public function addUser($id,$ime,$prezime,$email,$telefon,$password,$uloga){

        return $this->dao->addUser($id,$ime,$prezime,$email,$telefon,$password,$uloga);;
    }

    public function updateUser($id, $data){

        return $this->dao->updateUser($id, $data);
    }

    public function deleteUser($id){

        return $this->dao->deleteUser($id);
    }
    */
}
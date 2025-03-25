<?php

require_once __DIR__."/../dao/ProjectDao.php";

class projectService{
    protected $dao;

    public $connStatus;

    public function __construct(){
        $this->dao = new ProjectDao();
        $this->connStatus = $this->dao->getConn();
        
    }

}












?>
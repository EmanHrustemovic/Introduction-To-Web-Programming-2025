<?php

require_once '../config.php';
require_once __DIR__ . ProjectDao.clas.php ;


class TerapijaDao extends ProjectDao{
    private $conn;
    private $pdo;

    public function __construct() {
        parent::__construct('doktor');

        try {
            $servername='localhost';
            $db_name='moje_zdravlje';
            $username='root';
            $password='g3c9h.,1?0';

            $this->pdo = new PDO("mysql:host=$servername;dbname={$db_name}",$username,$password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
           
           
           $this->conn = "Connected successfully";
        } catch (PDOException $e) {
            $this->conn = "Connection failed: " . $e->getMessage();
        }
    }

    public function getAllTherapy(){
        $stmt = $this->$connection->prepare("SELECT * FROM terapija " . $this->$table);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getTherapyByID($id){
        $stmt = $this->$connection->prepare("SELECT * FROM terapija WHERE terapija_id = :id" . $this->$table);

        $stmt->bindParam(':id' , $id);
       
        $stmt->execute();
        return $stmt->fetch();
    }

    public function addTherapy($id,$data){
        $sql = "INSERT INTO terapija(terapija_id,vrsta,doza_i_uputa,trajanje,kontrola,doktor_id,pregledi_id)
        VALUES(:terapija_id, :vrsta, :doza_i_uputa, :trajanje, :kontrola, :doktor_id, :pregledi_id)";

        $stmt = $this-> pdo -> prepare($sql);

        $id = $data[':terpaija_id'];
        $type =  $data[':vrsta'];
        $instructions=$data[':doza_i_uputa'];
        $duration = $data[':trajanje'];
        $control = $data[':kontrola'];
        $doctor_id = $data[':doktor_id'];
        $checks = $data[':pregledi_id'];



        $stmt -> bindParam(':terapija_id',$id);
        $stmt -> bindParam(':vrsta',$type);
        $stmt -> bindParam(':doza_i_uputa',$instructions);
        $stmt -> bindParam(':trajanje',$duration);
        $stmt -> bindParam(':kontrola',$control);
        $stmt -> bindParam(':doktor_id',$doctor_id);
        $stmt -> bindParam(':pregledi_id',$checks);

        $stmt -> execute();
    }

    public function updateTherapy($id,$data){

        $sql = "UPDATE terapija SET terapija_id = :terapija_id,vrsta = :vrsta,doza_i_uputa =:doza_i_uputa,
        trajanje = :trajanje ,kontrola =:kontrola, doktor_id =:doktor_id,pregledi_id = :pregledi_id";
        
        $stmt = $this-> pdo -> prepare($sql);


        $id = $data[':terpaija_id'];
        $type =  $data[':vrsta'];
        $instructions=$data[':doza_i_uputa'];
        $duration = $data[':trajanje'];
        $control = $data[':kontrola'];
        $doctor_id = $data[':doktor_id'];
        $checks = $data[':pregledi_id'];



        $stmt -> bindParam(':terapija_id',$id,PDO::PARAM_INT);
        $stmt -> bindParam(':vrsta',$type,PDO::PARAM_STR);
        $stmt -> bindParam(':doza_i_uputa',$instructions,PDO::PARAM_STR);
        $stmt -> bindParam(':trajanje',$duration,PDO::PARAM_STR);
        $stmt -> bindParam(':kontrola',$control,PDO::PARAM_STR);
        $stmt -> bindParam(':doktor_id',$doctor_id,PDO::PARAM_INT);
        $stmt -> bindParam(':pregledi_id',$checks,PDO::PARAM_INT);

        $stmt -> execute();

        $sql = "SELECT * FROM terapija WHERE terapija_id = : id";

        $stmt = $this->pdo->prepare($sql);
        $stmt = bindParam(':id',$id,PDO::PARAM_INT);
        $stmt -> execute();

    }

    public function deleteTherapy($id){
        $sql = "DELETE FROM terapija WHERE terapija_id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt = bindParam(":id",$id,PARAM_INT);

        return $stmt->execute(); 
    }

    public function getConn(){
        return $this->conn;
    }
}


?>
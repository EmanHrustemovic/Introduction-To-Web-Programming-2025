<?php

require_once '../config.php';
require_once __DIR__ . ProjectDao.clas.php ;

class DoctorDao extends ProjectDao{

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

    public function getAllChecks(){
        $stmt = $this->$conn->prepare("SELECT * FROM pregledi " . $this->$table);

        $stmt ->execute();
        return $stmt -> fetchAll();
    }

    public function preglediPoID($id){
        $stmt = $this->$conn->prepare("SELECT * FROM pregledi WHERE id = :id" . $this->$table);

        $stmt->bindParam(':id',$id);
        
        $stmt -> execute();
        return $stmt -> fetchAll();
    }

    public function dodajPregled($data){
        $sql = "INSERT INTO pregledi (id,nazivPregleda,datum_vrijeme,status,opis,rezultati,odjeljeneje_id,doktor_id,preporuka)
        VALUES(:id,:nazivPregleda,:datum_vrijeme,:status,:opis,:rezultati,:odjeljeneje_id,:doktor_id,:preporuka)";

        $stmt = $this->pdo->prepare($sql);

        $id = $data[':id'];
        $name =$data['nazivPregleda'];
        $date = $data[':datum_vrijeme'];
        $status = $data[':status'];
        $description = $data[':opis'];
        $results = $data[':rezultati'];
        $department = $data[':odjeljenje_id'];
        $doctor_id = $data[':doktor_id'];
        $recommendation = $data[':preporuka'];

        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':nazivPregleda',$name);
        $stmt->bindParam(':datum_vrijeme',$date);
        $stmt->bindParam(':status',$status);
        $stmt->bindParam(':opis',$description);
        $stmt->bindParam(':rezultati',$results);
        $stmt->bindParam(':odjeljenje_id',$department);
        $stmt->bindParam(':doktor_id',$doctor_id);
        $stmt->bindParam(':preporuka',$recommendation);
      

        $stmt->execute();

        $sql = "SELECT * FROM pregledi WHERE id = :id";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt = bindParam(':id',$id,PDO::PARAM_INT);
        $stmt -> execute();
    }

    public function izmjeniPegled($id,$data){
        $sql = "UPDATE pregledi SET id = :id ,nazivPregleda = :nazivPregleda ,datum_vrijeme = :datum_vrijeme,
        status = :status,opis = :opis,rezultati = :rezultati,odjeljeneje_id = odjeljenje_id,
        doktor_id = :doktor_id,preporuka = :preporuka ";

        $stmt = $this-> pdo -> prepare($sql);

        $id = $data[':id'];
        $name =$data['nazivPregleda'];
        $date = $data[':datum_vrijeme'];
        $status = $data[':status'];
        $description = $data[':opis'];
        $results = $data[':rezultati'];
        $department = $data[':odjeljenje_id'];
        $doctor_id = $data[':doktor_id'];
        $recommendation = $data[':preporuka'];

        $stmt->bindParam(':id', $id,PARAM_INT);
        $stmt->bindParam(':nazivPregleda', $name,PARAM_STR);
        $stmt->bindParam(':datum_vrijeme', $date,PARAM_DATE);
        $stmt->bindParam(':status', $status,PARAM_INT);
        $stmt->bindParam(':opis', $description,PARAM_STR);
        $stmt->bindParam(':rezultati', $results,PARAM_STR);
        $stmt->bindParam(':odjeljenje_id', $department,PARAM_INT);
        $stmt->bindParam(':doktor_id', $doctor_id,PARAM_INT);
        $stmt->bindParam(':preporuka', $recommendation,PARAM_INT);

        $stmt->execute();

        $sql = "SELECT * FROM terapija WHERE terapija_id = : id";

        $stmt = $this->pdo->prepare($sql);
        $stmt = bindParam(':id',$id,PDO::PARAM_INT);
        $stmt -> execute();


    }


    public function obrišiPregled($id){
        $sql = "DELETE FROM pregledi WHERE id = :id";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt = bindParam(":id",$id,PARAM_INT);

        return $stmt->execute(); 
    }

    public function getConn(){
        return $this->conn;
    }

}
?>
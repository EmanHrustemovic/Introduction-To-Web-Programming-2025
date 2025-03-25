<?php

require_once '../config.php';
require_once __DIR__ . ProjectDao.clas.php ;

class zdravstveniKartonDao extends ProjectDao{

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

    public function izlistajKarton() { 
        $stmt = $this->$connection->prepare("SELECT * FROM zdravstveniKarton " . $this->$table);
        $stmt->execute();
        return $stmt->fetchAll();

    }

    public function kartoniPoID($id){ 
        $stmt = $this->$connection->prepare("SELECT * FROM doktor WHERE šifraBolesti = :id" . $this->$table);

        $stmt->bindParam(':id' , $id);
       
        $stmt->execute();
        return $stmt->fetch();
    }

    public function dodajKarton($data){ 
        $sql = "INSERT INTO zdravstveniKarton (šifraBolesti, nazivBolesti, dijagnoza, terapija, JMBG, pregledi_id, doktor_id) VALUES(:šifraBolesti, :nazivBolesti, :dijagnoza, :terapija, :JMBG, :pregledi_id,:doktor_id)";
        
        $stmt = $this->pdo->prepare($sql);

        $id= $data['šifraBolesti'];
        $name = $data['nazivBolesti'];
        $diagnosis = $data['dijagnoza'];
        $terpahy = $data['terapija'];
        $personal_number = $data['JMBG'];
        $checks = $data['pregledi_id'];
        $doctor_id = $data['doktor_id'];

        $stmt->bindParam(':šifraBolesti', $id);
        $stmt->bindParam(':nazivBolesti', $name);
        $stmt->bindParam(':dijagnoza', $diagnosis);
        $stmt->bindParam(':terapija', $terpahy);
        $stmt->bindParam(':JMBG', $personal_number);
        $stmt->bindParam(':pregledi_id', $checks);
        $stmt->bindParam(':doktor_id', $doctor_id);

        $stmt->execute();
    }

    public function izmjeniKarton($id,$data){
        $sql = "UPDATE zdravstveniKarton SET šifraBolesti = :šifraBolesti, nazivBolesti= :nazivBolesti, 
        dijagnoza =:dijagnoza, terapija = :terapija, JMBG = :JMBG, pregledi_id = :pregledi_id, , doktor_id = :doktor_id";
        
        $stmt = $this->pdo->prepare($sql);

        $id= $data['šifraBolesti'];
        $name = $data['nazivBolesti'];
        $diagnosis = $data['dijagnoza'];
        $terpahy = $data['terapija'];
        $personal_number = $data['JMBG'];
        $checks = $data['pregledi_id'];
        $doctor_id = $data['doktor_id'];

        $stmt->bindParam(':šifraBolesti', $id,PDO::PARAM_INT);
        $stmt->bindParam(':nazivBolesti', $name,POD::PARAM_STR);
        $stmt->bindParam(':dijagnoza', $diagnosis,PDO::PARAM_STR);
        $stmt->bindParam(':terapija', $terpahy,PDO::PARAM_STR);
        $stmt->bindParam(':JMBG', $personal_number,PDO::PARAM_INT);
        $stmt->bindParam(':pregledi_id', $checks,PDO::PARAM_INT);
        $stmt->bindParam(':doktor_id', $doctor_id,PDO::PARAM_INT);

        $stmt->execute();

        $sql = "SELECT * FROM zdravstveniKarton WHERE šifraBolesti = :id";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt = bindParam(':id',$id,PDO::PARAM_INT);
        $stmt -> execute();

    }

    public function obrišiKarton($id){
        $sql = "DELETE FROM zdravstveniKarton WHERE šifraBolesti = :id";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt = bindParam(":id",$id,PARAM_INT);

        return $stmt->execute(); 

    }
 
    public function getConn(){
        return $this->conn;
    }

}
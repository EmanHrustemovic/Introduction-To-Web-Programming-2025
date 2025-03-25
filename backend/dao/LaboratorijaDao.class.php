<?php

require_once '../config.php';
require_once __DIR__ . ProjectDao.clas.php ;


class LaboratorijaDao extends ProjectDao{
    
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

    public function pregledLaboratorije(){
        $stmt = $this->$connection->prepare("SELECT * FROM laboratorija " . $this->$table);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function laboratorijaPoId($id){
        $stmt = $this -> $connection -> prepare("SELECT * FROM laboratorija WHERE šifraNalaza = :id");
        $stmt->bindParam(':id' , $id);
       
        $stmt->execute();
        return $stmt->fetch();
    }

    public function addLaboratory($id,$data){
        $sql = "INSERT INTO laboratorija (šifraNalaza,tipNalaza,vrsta_uzorka,datum_obrade,status,pregledi_id) 
        VALUES(:šifraNalaza,tipNalaza, :vrsta_uzorka, :datum_obrade, :status, :pregledi_id)";

        $stmt = $this-> pdo -> prepare($sql);
        
        $code = $data[':šifraNalaza'];
        $type = $data[':tipNalaza'];
        $sample = $data[':vrsta_uzorka'];
        $date = $data[':datum_obrade'];
        $status = $data[':status'];
        $checks = $data[':pregledi_id'];

        $stmt -> bindParam(':šifraNalaza',$code);
        $stmt -> bindParam(':tipNalaza',$type);
        $stmt -> bindParam(':vrsta_uzorka',$sample);
        $stmt -> bindParam(':datum_obrade',$date);
        $stmt -> bindParam(':status',$status);
        $stmt -> bindParam(':pregledi_id',$checks);

        $stmt -> execute();

    }
    
    public function updateLaboratory($id,$data){
        $sql = "UPDATE laboratorija SET šifraNalaza = :šifraNalaza,tipNalaza :tipNalaza,
        vrsta_uzorka :vrsta_uzorka,datum_obrade :datum_obrade,status :status,
        pregledi_id ;pregledi_id
        WHERE šifraNalaza = :id";

        $stmt = $this-> pdo -> prepare($sql);

        $code = $data[':šifraNalaza'];
        $type = $data[':tipNalaza'];
        $sample = $data[':vrsta_uzorka'];
        $date = $data[':datum_obrade'];
        $status = $data[':status'];
        $checks = $data[':pregledi_id'];

        $stmt -> bindParam(':šifraNalaza',$code,PARAM_INT);
        $stmt -> bindParam(':tipNalaza',$type,PARAM_STR);
        $stmt -> bindParam(':vrsta_uzorka',$sample,PARAM_STR);
        $stmt -> bindParam(':datum_obrade',$date,PARAM_STR);
        $stmt -> bindParam(':status',$status,PARAM_STR);
        $stmt -> bindParam(':pregledi_id',$checks,PARAM_INT);

        $stmt -> execute();

        $sql = "SELECT * FROM laboratorija WHERE šifraNalaza = : id";

        $stmt = $this->pdo->prepare($sql);
        $stmt = bindParam(':id',$id,PDO::PARAM_INT);
        $stmt -> execute();
    }

    public function deleteLaboratory($id){
        $sql = "DELETE * FROM laboratorija WHERE šifraNalaza = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt = bindParam(":id",$id,PARAM_INT);

        return $stmt->execute(); 
    }

    public function getConn(){
        return $this->conn;
    }

}
?>
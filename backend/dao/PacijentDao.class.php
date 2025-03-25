<?php

require_once '../config.php';
require_once __DIR__ . ProjectDao.clas.php ;


class PacijentDao extends ProjectDao{

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

    public function getAllPatients(){
        $stmt = $this->$connection->prepare("SELECT * FROM pacijent " . $this->$table);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getPatientByID($id){
        $stmt = $this->$connection->prepare("SELECT * FROM pacijent WHERE JMBG = :id" . $this->$table);

        $stmt->bindParam(':id' , $id);
       
        $stmt->execute();
        return $stmt->fetch();
    }

    public function addPatient($data){
        $sql = "INSERT INTO pacijent (JMBG , punoIme ,email , password , grad , težina , visina , datumRođenja, nazivOsiguranika) VALUES(:JMBG , :punoIme , :email , :password , :grad , :težina , :visina , :datumRođenja, :nazivOsiguranika)";
        $stmt = $this-> pdo -> prepare($sql);

        $id = $data['JMBG'];
        $ime = $data['punoIme'];
        $email = $data['email'];
        $password = $data['password'];
        $grad= $data['grad'];
        $tezina = $data['težina'];
        $visina = $data['visina'];
        $rodendan = $data['datumRođenja'];
        $osiguranje = $data['nazivOsiguranika'];

        $stmt->bindParam(':JMBG', $id);
        $stmt->bindParam(':punoIme', $ime);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':grad', $grad);
        $stmt->bindParam(':težina', $tezina);
        $stmt->bindParam(':visina', $visina);
        $stmt->bindParam(':datumRođenja', $rodendan);
        $stmt->bindParam(':nazivOsiguranika', $osiguranje);
        
        $stmt->execute();
    }

    public function updatePatient($id,$data){
        $sql = "UPDATE pacijent SET JMBG :JMBG , punoIme :punoIme ,email :email ,password :password,
        grad :grad ,težina:težina ,visina :visina ,datumRođenja :datumRođenja, nazivOsiguranika :nazivOsiguranika";

        $stmt = $this->pdo->prepare($sql);


        $id = $data['JMBG'];
        $ime = $data['punoIme'];
        $email = $data['email'];
        $password = $data['password'];
        $grad= $data['grad'];
        $tezina = $data['težina'];
        $visina = $data['visina'];
        $rodendan = $data['datumRođenja'];
        $osiguranje = $data['nazivOsiguranika'];

        $stmt->bindParam(':JMBG', $id,PARAM_INT);
        $stmt->bindParam(':punoIme', $ime,PARAM_STR);
        $stmt->bindParam(':email', $email,PARAM_STR);
        $stmt->bindParam(':password', $password,PARAM_STR);
        $stmt->bindParam(':grad', $grad,PARAM_STR);
        $stmt->bindParam(':težina', $tezina,PARAM_DEC);
        $stmt->bindParam(':visina', $visina,PARAM_DEC);
        $stmt->bindParam(':datumRođenja', $rodendan,PARAM_STR);
        $stmt->bindParam(':nazivOsiguranika', $osiguranje,PARAM_STR);

        $stmt->execute();

        $sql = "SELECT * FROM pacijent WHERE JMBG = :id";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt = bindParam(':id',$id,PDO::PARAM_INT);
        $stmt -> execute();
    } 
    public function deletePatient($data,$id){
        $sql = "DELETE FROM pacijent WHERE JMBG = :id";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt = bindParam(":id",$id,PARAM_INT);

        return $stmt->execute(); 
    }

    public function getConn(){
        return $this->conn;
    }


}
   
?>
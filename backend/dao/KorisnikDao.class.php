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

    public function getAllUsers(){
        $stmt = $this->$conn->prepare("SELECT * FROM user " . $this->$table);

        $stmt ->execute();
        return $stmt -> fetchAll();

    }

    public function getUserByID($id){
        $stmt = $this->$conn->prepare("SELECT * FROM user WHERE JMBG = :id" . $this->$table);

        $stmt->bindParam(':id',$id);
        
        $stmt -> execute();
        return $stmt -> fetchAll();
    }

    public function addUser($data){
        $sql = "INSERT INTO user (JMBG,punoIme,prezime,email,telefon)
        VALUES(:JMBG, :punoIme,:prezime,:email,:telefon)";

        $stmt = $this->pdo->prepare($sql);

        $id = $data[':JMBG'];
        $name =$data['punoIme'];
        $prezime = $data[':prezime'];
        $email = $data[':email'];
        $phone = $data[':telefon'];

        $stmt->bindParam(':JMBG',$id);
        $stmt->bindParam(':punoIme',$name);
        
        $stmt->bindParam(':prezime',$prezime);
        $stmt->bindParam(':emal',$email);
        $stmt->bindParam(':telefon' , $phone);
      

        $stmt->execute();

        $sql = "SELECT * FROM user WHERE JMBG = :id";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt = bindParam(':id',$id,PDO::PARAM_INT);
        $stmt -> execute();
    }

    public function updateUser($id,$data){
        $sql = "UPDATE user SET  JMBG = :JMBG, punoIme= :punoIme,  prezime= :prezime, 
        email = :email, telefon = :telefon";

        $stmt = $this-> pdo -> prepare($sql);

        $id = $data[':JMBG'];
        $name =$data['punoIme'];
        $prezime = $data[':prezime'];
        $email = $data[':email'];
        $phone = $data[':telefon'];

        $stmt->bindParam(':JMBG',$id);
        $stmt->bindParam(':punoIme',$name);
        
        $stmt->bindParam(':prezime',$prezime);
        $stmt->bindParam(':emal',$email);
        $stmt->bindParam(':telefon' , $phone);
        
        $stmt->execute();

        $sql = "SELECT * FROM user WHERE JMBG = : id";

        $stmt = $this->pdo->prepare($sql);
        $stmt = bindParam(':id',$id,PDO::PARAM_INT);
        $stmt -> execute();


    }

    public function deleteUser($id){
        $sql = "DELETE FROM user WHERE JMBG = :id";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt = bindParam(":id",$id,PARAM_INT);

        return $stmt->execute(); 
    }

    public function getConn(){
        return $this->conn;
    }

}
?>
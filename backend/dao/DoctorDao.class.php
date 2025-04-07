<?php

require_once 'services/config.php';
require_once __DIR__ . '/ProjectDao.class.php';

class DoctorDao extends ProjectDao {

    private $conn;
    private $pdo;

    public function __construct() {
        parent::__construct('doktor');

        try {
            $servername = 'localhost';
            $db_name = 'moje_zdravlje';
            $username = 'root';
            $password = 'g3c9h.,1?0';

            $this->pdo = new PDO("mysql:host=$servername;dbname={$db_name}", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn = "Connected successfully";
        } catch (PDOException $e) {
            $this->conn = "Connection failed: " . $e->getMessage();
        }
    }

    public function getAllDoctors() {
        $stmt = $this->pdo->prepare("SELECT * FROM doktor");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByDocID($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM doktor WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function addDoctor($data) {
        $sql = "INSERT INTO doktor (ime, titula, email, password, telefon, odjeljenje) 
                VALUES(:ime, :titula, :email, :password, :telefon, :odjeljenje)";
        
        $stmt = $this->pdo->prepare($sql);

        $ime = $data['ime'];
        $titula = $data['titula'];
        $email = $data['email'];
        $password = $data['password'];
        $telefon = $data['telefon'];
        $odjeljenje = $data['odjeljenje'];

        $stmt->bindParam(':ime', $ime);
        $stmt->bindParam(':titula', $titula);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':telefon', $telefon);
        $stmt->bindParam(':odjeljenje', $odjeljenje);

        $stmt->execute();
    }

    public function updateDoctor($id, $data) {
        $sql = "UPDATE doktor SET ime = :ime, titula = :titula, email = :email, password = :password, 
                telefon = :telefon, odjeljenje = :odjeljenje WHERE id = :id";
        
        $stmt = $this->pdo->prepare($sql);

        $ime = $data['ime'];
        $titula = $data['titula'];
        $email = $data['email'];
        $password = $data['password'];
        $telefon = $data['telefon'];
        $odjeljenje = $data['odjeljenje'];

        $stmt->bindParam(':ime', $ime);
        $stmt->bindParam(':titula', $titula);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':telefon', $telefon);
        $stmt->bindParam(':odjeljenje', $odjeljenje);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function deleteDoctor($id) {
        $sql = "DELETE FROM doktor WHERE id = :id";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function getConn() {
        return $this->conn;
    }
}

?>
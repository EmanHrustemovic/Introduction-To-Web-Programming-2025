<?php

require_once '../config.php';
require_once __DIR__ . '/ProjectDao.class.php';

class PacijentDao extends ProjectDao {
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

        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getAllUsers() {
        $stmt = $this->pdo->prepare("SELECT * FROM user");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUserByID($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM user WHERE JMBG = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addUser($data) {
        $sql = "INSERT INTO user (JMBG, punoIme, prezime, email, telefon)
                VALUES (:JMBG, :punoIme, :prezime, :email, :telefon)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':JMBG', $data['JMBG']);
        $stmt->bindParam(':punoIme', $data['punoIme']);
        $stmt->bindParam(':prezime', $data['prezime']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':telefon', $data['telefon']);

        $stmt->execute();

        return $this->getUserByID($data['JMBG']);
    }

    public function updateUser($id, $data) {
        $sql = "UPDATE user SET punoIme= :punoIme, prezime= :prezime, email= :email, telefon= :telefon WHERE JMBG = :JMBG";
        $stmt = $this->pdo->prepare($sql);

        $stmt->bindParam(':JMBG', $id);
        $stmt->bindParam(':punoIme', $data['punoIme']);
        $stmt->bindParam(':prezime', $data['prezime']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':telefon', $data['telefon']);

        $stmt->execute();

        return $this->getUserByID($id);
    }

    public function deleteUser($id) {
        $sql = "DELETE FROM user WHERE JMBG = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>

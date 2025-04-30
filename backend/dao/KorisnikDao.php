<?php

namespace App\dao;
use App\dao\ProjectDao;

use PDO;

class KorisnikDao extends ProjectDao {
    public function __construct() {
        parent::__construct('user');
    }

    public function getAllUsers() {
        $stmt = $this->connection->prepare("SELECT * FROM user");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getUserByID($id) {
        $stmt = $this->connection->prepare("SELECT * FROM user WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addUser($ime, $prezime, $email, $telefon, $password, $uloga) {
        $sql = "INSERT INTO user (ime, prezime, email, telefon, password, uloga)
                VALUES (:ime, :prezime, :email, :telefon, :password, :uloga)";
        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(':ime', $ime);
        $stmt->bindParam(':prezime', $prezime);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefon', $telefon);
        $stmt->bindParam(':password', $password); 
        $stmt->bindParam(':uloga', $uloga);

        $stmt->execute();
    }

    public function updateUser($id, $data) {
        $sql = "UPDATE user SET ime = :ime, prezime = :prezime, email = :email,
                telefon = :telefon, password = :password, uloga = :uloga WHERE id = :id";
        $stmt = $this->connection->prepare($sql);

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':ime', $data->ime);
        $stmt->bindParam(':prezime', $data->prezime);
        $stmt->bindParam(':email', $data->email);
        $stmt->bindParam(':telefon', $data->telefon);
        $stmt->bindParam(':password', $data->password);
        $stmt->bindParam(':uloga', $data->uloga);

        $stmt->execute();
    }

    public function deleteUser($id) {
        $stmt = $this->connection->prepare("DELETE FROM user WHERE id = :id");
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    /*
    private $pdo;

    public function __construct() {
        parent::__construct('user');

    }
    
    public function create($user){
        $db = $this->connect();
        $stmt = $db->prepare("INSERT INTO user (email, password_hash, otp_secret) VALUES (?, ?, ?)");
        $stmt->execute([
            $user['email'],
            AuthService::hashPassword($user['password']),
            $user['otp_secret']
        ]);
    }

    public function getAllUsers() {
        $stmt = $this->connection->prepare("SELECT * FROM user");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getUserByID($id) {
        $stmt = $this->connection->prepare("SELECT * FROM user WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addUser($ime,$prezime,$email,$telefon,$password,$uloga) {

         $sql = "INSERT INTO user (ime, prezime, email, telefon,password,uloga)
                VALUES ( :ime, :prezime, :email, :telefon,:password,:uloga)";

        $stmt = $this->connection->prepare($sql);

        //$stmt->bindParam(':id', $id);
        $stmt->bindParam(':ime', $ime);
        $stmt->bindParam(':prezime', $prezime);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefon', $telefon);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':uloga', $uloga);

        $stmt->execute();

    }

    public function updateUser($id, $data) {
        $sql = "UPDATE user SET  ime = :ime, prezime = :prezime, email = :email,
                 telefon = :telefon , password = :password,uloga = :uloga WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        //$id = $data -> id;
        $ime = $data -> ime;
        $prezime = $data -> prezime;
        $email = $data -> email;
        $telefon = $data -> telefon;
        $password = $data -> password;
        $uloga = $data -> uloga;

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':ime', $ime);
        $stmt->bindParam(':prezime', $prezime);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefon', $telefon);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':uloga', $uloga);


        $stmt->execute();
    }

    public function deleteUser($id) {
        $sql = "DELETE FROM user WHERE id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
    */
}
?>

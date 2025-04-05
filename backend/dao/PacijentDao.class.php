<?php 

require_once '../config.php';
require_once __DIR__ . '/ProjectDao.class.php';

class PacijentDao extends ProjectDao {

    private $pdo;

    public function __construct() {
        parent::__construct('pacijent');

        try {
            $servername = 'localhost';
            $db_name = 'moje_zdravlje';
            $username = 'root';
            $password = 'g3c9h.,1?0';

            $this->pdo = new PDO("mysql:host=$servername;dbname=$db_name", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getAllPatients() {
        $stmt = $this->pdo->prepare("SELECT * FROM pacijent");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPatientByID($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM pacijent WHERE JMBG = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addPatient($data) {
        $sql = "INSERT INTO pacijent (JMBG, punoIme, email, password, grad, težina, visina, datumRođenja, nazivOsiguranika) 
                VALUES (:JMBG, :punoIme, :email, :password, :grad, :težina, :visina, :datumRođenja, :nazivOsiguranika)";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    public function updatePatient($id, $data) {
        $sql = "UPDATE pacijent SET punoIme = :punoIme, email = :email, password = :password, grad = :grad, 
                težina = :težina, visina = :visina, datumRođenja = :datumRođenja, nazivOsiguranika = :nazivOsiguranika 
                WHERE JMBG = :JMBG";

        $stmt = $this->pdo->prepare($sql);
        $data['JMBG'] = $id;
        return $stmt->execute($data);
    }

    public function deletePatient($id) {
        $sql = "DELETE FROM pacijent WHERE JMBG = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_STR);
        return $stmt->execute();
    }
}

?>
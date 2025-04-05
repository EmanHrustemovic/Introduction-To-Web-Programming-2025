<?php

require_once '../config.php';
require_once __DIR__ . '/ProjectDao.class.php';

class ZdravstveniKartonDao extends ProjectDao {
    private $pdo;

    public function __construct() {
        parent::__construct('zdravstveniKarton');

        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=moje_zdravlje", "root", "g3c9h.,1?0");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function izlistajKarton() {
        $stmt = $this->pdo->prepare("SELECT * FROM zdravstveniKarton");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function kartoniPoID($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM zdravstveniKarton WHERE šifraBolesti = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function dodajKarton($data) {
        $sql = "INSERT INTO zdravstveniKarton (šifraBolesti, nazivBolesti, dijagnoza, terapija, JMBG, pregledi_id, doktor_id) 
                VALUES (:šifraBolesti, :nazivBolesti, :dijagnoza, :terapija, :JMBG, :pregledi_id, :doktor_id)";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }

    public function izmjeniKarton($id, $data) {
        $sql = "UPDATE zdravstveniKarton SET 
                    nazivBolesti = :nazivBolesti, 
                    dijagnoza = :dijagnoza, 
                    terapija = :terapija, 
                    JMBG = :JMBG, 
                    pregledi_id = :pregledi_id, 
                    doktor_id = :doktor_id
                WHERE šifraBolesti = :šifraBolesti";
        
        $stmt = $this->pdo->prepare($sql);
        $data[':šifraBolesti'] = $id;
        return $stmt->execute($data);
    }

    public function obrišiKarton($id) {
        $sql = "DELETE FROM zdravstveniKarton WHERE šifraBolesti = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>

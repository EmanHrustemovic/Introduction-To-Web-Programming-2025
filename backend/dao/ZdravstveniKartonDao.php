<?php
namespace App\dao;

//require_once '../config.php';
require_once __DIR__ . '/ProjectDao.php';


class ZdravstveniKartonDao extends ProjectDao {
    private $pdo;

    public function __construct() {
        parent::__construct('zdravstveniKarton');

//        try {
//            $this->pdo = new \PDO("mysql:host=localhost;dbname=moje_zdravlje", "root", "g3c9h.,1?0");
//            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//        } catch (PDOException $e) {
//            die("Connection failed: " . $e->getMessage());
//        }
    }


    public function dodajKarton($data) {
        $sql = "INSERT INTO zdravstveniKarton (sifraBolesti, nazivBolesti, dijagnoza, terapija,  pregledi_id, doktor_id) VALUES (:sifraBolesti, :nazivBolesti, :dijagnoza, :terapija,  :pregledi_id, :doktor_id)";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data);
        return (int)$this->connection->lastInsertId();
    }

    public function izlistajKarton() {
        $stmt = $this->pdo->prepare("SELECT * FROM zdravstveniKarton");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function kartoniPoID($id) {
        $stmt = $this->connection->prepare("SELECT * FROM zdravstveniKarton WHERE sifraBolesti = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }



    public function izmjeniKarton($id, $data) {
        $sql = 'UPDATE zdravstveniKarton SET 
                    nazivBolesti = :nazivBolesti, 
                    dijagnoza = :dijagnoza, 
                    terapija = :terapija, 
                    JMBG = :JMBG, 
                    pregledi_id = :pregledi_id, 
                    doktor_id = :doktor_id
                WHERE sifraBolesti = :sifraBolesti';
        
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($data);
    }

    public function obrišiKarton($id) {
        $sql = "DELETE FROM zdravstveniKarton WHERE sifraBolesti = :id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(":id", $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>

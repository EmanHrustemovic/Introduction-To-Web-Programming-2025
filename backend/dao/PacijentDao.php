<?php

namespace App\dao;

use PDO;
use App\dao\ProjectDao;

class PacijentDao extends ProjectDao {
    public function __construct() {
        parent::__construct('pacijent_info');
    }

    public function getAllPatients() {
        $stmt = $this->connection->prepare("SELECT * FROM pacijent_info");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $stmt = $this->connection->prepare("SELECT * FROM pacijent_info WHERE pacijent_id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function insert($data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO pacijent_info ($columns) VALUES ($placeholders)";
        $stmt = $this->connection->prepare($sql);
        return $stmt->execute($data);
    }

    public function update($id, $data) {
        $fields = "";
        foreach ($data as $key => $value) {
            $fields .= "$key = :$key, ";
        }
        $fields = rtrim($fields, ", ");
        $sql = "UPDATE pacijent_info SET $fields WHERE pacijent_id = :id";
        $stmt = $this->connection->prepare($sql);
        $data['id'] = $id;
        return $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->connection->prepare("DELETE FROM pacijent_info WHERE pacijent_id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}

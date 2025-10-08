<?php

class VoitureModel
{
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=bruno_uber;charset=utf8", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }
    public function getDBAllVoitures()
    {
        $stmt = $this->pdo->query("SELECT * FROM Voiture");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getDBVoitureById($idVoiture){
        $stmt = $this->pdo->prepare("SELECT * FROM Voiture WHERE voiture_id = :idVoiture");
        $stmt->bindValue(":idVoiture", $idVoiture, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

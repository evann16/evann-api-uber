<?php

class ClientModel
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
    public function getDBAllClients()
    {
        $stmt = $this->pdo->query("SELECT * FROM Client");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDBClientById($idClient){
        $stmt = $this->pdo->prepare("SELECT * FROM Client WHERE client_id = :idClient");
        $stmt->bindValue(":idClient", $idClient, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

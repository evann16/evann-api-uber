<?php

require_once "./models/TrajetModel.php";

class TrajetController
{
    private $model;

    public function __construct()
    {
        $this->model = new TrajetModel();
    }

    public function getAllTrajets()
    {
        $trajets = $this->model->getDBAllTrajets();
        echo json_encode($trajets);
    }

    public function getTrajetById ($idTrajet){
        $lignesTrajet = $this->model->getDBTrajetById($idTrajet);
        echo json_encode($lignesTrajet);
    }

    public function getChauffeurByTrajetId ($idTrajet){
        $chauffeurId = $this->model->getDBChauffeurByTrajetId($idTrajet);
        return $chauffeurId;
    }

    public function getClientByTrajetId ($idTrajet){
        $clientId = $this->model->getDBClientByTrajetId($idTrajet);
        return $clientId;
    }
}

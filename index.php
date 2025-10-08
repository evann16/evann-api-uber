<?php
require_once "controllers/ChauffeurController.php";
require_once "controllers/ClientController.php";
require_once "controllers/TrajetController.php";
require_once "controllers/VoitureController.php";

$chauffeurController = new ChauffeurController();
$clientController = new ClientController();
$trajetController = new TrajetController();
$voitureController = new VoitureController();

// Vérifie si le paramètre "page" est vide ou non présent dans l'URL
if (empty($_GET["page"])) {
    // Si le paramètre est vide, on affiche un message d'erreur
    echo "Cette page est introuvable.";
} else {
    // Sinon, on récupère la valeur du paramètre "page"
    // et on la découpe en plusieurs morceaux, séparés par "/"
    // Cela permet d'analyser chaque segment de l'URL
    $url = explode("/", $_GET['page']);
    
    // Affiche le tableau résultant pour visualiser les parties de l'URL
    print_r($url);

    // On traite le premier segment de l’URL avec une instruction switch
    // Cela nous permet de rediriger la requête vers le bon traitement
    switch($url[0]) {
        // Si le premier segment est "chauffeurs", on traite la logique associée
        case "chauffeurs" : 
            if (isset($url[1])) {
                // Exemple : /chauffeurs/3 → affiche les infos du chauffeur 3
                $chauffeurController->getChauffeurById($url[1]);
            } if (isset($url[2])=="voitures"){
                $chauffeurController->getVoitureByChauffeurId($url[1]);
            } else {
                // Sinon, on affiche tous les chauffeurs
                print_r($chauffeurController->getAllChauffeurs());
            }
            break;
        case "clients" : 
            if (isset($url[1])) {
                $clientController->getClientById($url[1]);
            } else {
                print_r($clientController->getAllClients());
            }
            break;
        case "voitures" : 
            if (isset($url[1])) {
                $voitureController->getVoitureById($url[1]);
            } else {
                print_r($voitureController->getAllVoitures());
            }
            break;
        case "trajets" : 
            if (isset($url[1])) {
                $trajetController->getTrajetById($url[1]);

            } if (isset($url[2])=="details"){
                $chauffeurId = $trajetController->getChauffeurByTrajetId($url[1]);

                $clientIds = $trajetController->getClientByTrajetId($url[1]);
                
                foreach ($clientIds as $clientId) {
                    $clientController->getClientById($clientId);
                }
                
                $chauffeurController->getChauffeurById($chauffeurId);
                $chauffeurController->getVoitureByChauffeurId($chauffeurId);
            
            } else {
                print_r($trajetController->getAllTrajets());
            }
            break;

        default :
            echo "La page n'existe pas";
    }
}
?>

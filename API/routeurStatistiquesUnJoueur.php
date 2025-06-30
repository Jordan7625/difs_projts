<?php
// inclure les fonctions d’accès à la base de données
require("dataJoueurs.php");

// Récupérer le verbe (méthode http) de la requête
$request_method = $_SERVER["REQUEST_METHOD"];

$dataJoueurs = new DataJoueurs();

// test de la méthode de la requête http
switch ($request_method) {
    case 'GET': // Si c’est une méthode GET
        // Récupérer les statistiques
        if (!empty($_GET["identifiant"])) // Si la propriété identifiant existe
        {
            $identifiant = $_GET["identifiant"];
            $reponse = $dataJoueurs->getStatistiquesUnjoueur($identifiant); // alors appelle de la méthode getStatistiques($identifiant)

            // création de la réponse en JSON
            header('Content-Type: application/json');
            
            // Vérification si le joueur est trouvé
            if ($reponse['statut'] == 1) {
                echo json_encode($reponse, JSON_PRETTY_PRINT);
            } else {
                // Si aucun identifiant de joueur n'est trouvé, renvoyer un message d'erreur
                header("HTTP/1.0 404 Not Found");
                echo json_encode($reponse, JSON_PRETTY_PRINT);
            }
        } else {
            // Si aucun identifiant de joueur n'est fourni, renvoyer un message d'erreur
            header("HTTP/1.0 400 Bad Request");
            echo json_encode(array("message" => "Choisir identifiant pour stats"), JSON_PRETTY_PRINT);
        }
        break;

    default:
        // Requête invalide
        header("HTTP/1.0 405 Method Not Allowed");
        break;
}

?>

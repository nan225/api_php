<?php
// les entêtes requises 
header("Access-Control-Allow-Origin:*");
header("Content-Type: application/json; charset = UTF-8");
header("Access-Control-Allow-Methods: DELETE");

require_once '../config/database.php';
require_once '../models/Etudiant.php';

// supprimer les clients
if($_SERVER['REQUEST_METHOD']==="DELETE"){
    // On instnacie la base de données

    $database = new Database();
    $db = $database->getConnexion();

    // On instnacie l'objet client

    $projet = new Etudiant($db);
    //On récupère les infos envoyées

    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->id_etudiant)) {
        $projet->id_etudiant = $data->id_etudiant;
        if ($projet->delete()) {
            http_response_code(200);
            echo json_encode(["message" => "le projet a été supprimé avec succès !!!"]);
        }else {
            http_response_code(503);
            echo json_encode(["message" => "le projet n'a pas pu etre supprimé"]);
        }
    }else{
        echo json_encode(['message' => "vous devez précisez l'identifiant"]);
    }

}else{
    http_response_code(405);
    echo json_encode(["message" => "la methode n'est pas autorisé"]);
}
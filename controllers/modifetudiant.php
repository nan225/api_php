<?php
// Les entetes requises 

header("Access-Control-Origin:*");
header("Content-type:application/json; charset=UTF-8");
header("Access-Control-Allow-Methods:PUT");
require_once('../config/database.php');
require_once('../models/Etudiant.php');

if($_SERVER['REQUEST_METHOD']==="PUT"){
    // on ninstancie la base de donées

$database = new Database();
$db = $database->getConnexion();

//on instancie l'objet article

$etudiant=new Etudiant($db);


// on recupere les infos envoyés
$data=json_decode(file_get_contents("php://input"));
if(!empty($data->id_etudiant) && !empty($data->nom) && !empty($data->prenoms) && !empty($data->matricule) && !empty($data->email)){
    //on hydrate l'objet étudiant
    $etudiant->id_etudiant=htmlspecialchars($data->id_etudiant);
    $etudiant->nom=htmlspecialchars($data->nom);
    $etudiant->prenoms=htmlspecialchars($data->prenoms);
    $etudiant->matricule=htmlspecialchars($data->matricule);
    $etudiant->email=htmlspecialchars($data->email);

    $result=$etudiant->update();
    if($result){
        http_response_code(201);
        echo json_encode(['message' =>"membre du projet modifié avec succes"]);
    }else{
        http_response_code(503);
        echo json_encode(['message' =>"Modification membre du projet a echoué"]);
    }
}else{
    echo json_encode(['message' => 'les Données ne sont pas au complet']);
}
}else{
    http_response_code(405);
    echo json_encode(['message'=>"la methode n'est pas autorisé"]);
}
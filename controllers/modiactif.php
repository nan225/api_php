<?php
// Les entetes requises 

header("Access-Control-Origin:*");
header("Content-type:application/json; charset=UTF-8");
header("Access-Control-Allow-Methods:PUT");
require_once('../config/database.php');
require_once('../models/Actif_year.php');

if($_SERVER['REQUEST_METHOD']==="PUT"){
    // on ninstancie la base de donées

$database = new Database();
$db = $database->getConnexion();

//on instancie l'objet article

$Actif=new Actif_year($db);


// on recupere les infos envoyés
$data=json_decode(file_get_contents("php://input"));
if(!empty($data->id_ay) && !empty($data->id_niveau) && !empty($data->promo) && !empty($data->groupe) && !empty($data->id_etudiant)){
    //on hydrate l'objet étudiant
    $Actif->id_ay=htmlspecialchars($data->id_ay);
    $Actif->id_niveau=htmlspecialchars($data->id_niveau);
    $Actif->promo=htmlspecialchars($data->promo);
    $Actif->groupe=htmlspecialchars($data->groupe);
    $Actif->id_etudiant=htmlspecialchars($data->id_etudiant);


    $result=$Actif->update();
    if($result){
        http_response_code(201);
        echo json_encode(['message' =>"année modifié avec succes"]);
    }else{
        http_response_code(503);
        echo json_encode(['message' =>"Modification année a echoué"]);
    }
}else{
    echo json_encode(['message' => 'les Données ne sont pas au complet']);
}
}else{
    http_response_code(405);
    echo json_encode(['message'=>"la methode n'est pas autorisé"]);
}
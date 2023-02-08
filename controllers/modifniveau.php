<?php
// Les entetes requises 

header("Access-Control-Origin:*");
header("Content-type:application/json; charset=UTF-8");
header("Access-Control-Allow-Methods:PUT");
require_once('../config/database.php');
require_once('../models/Niveau.php');

if($_SERVER['REQUEST_METHOD']==="PUT"){
    // on ninstancie la base de donées

$database = new Database();
$db = $database->getConnexion();

//on instancie l'objet article

$niveau=new Niveau($db);


// on recupere les infos envoyés
$data=json_decode(file_get_contents("php://input"));
if(!empty($data->id_niveau) && !empty($data->niveau)){
    //on hydrate l'objet étudiant
    $niveau->id_niveau=htmlspecialchars($data->id_niveau);
    $niveau->niveau=htmlspecialchars($data->niveau);
    

    $result=$niveau->update();
    if($result){
        http_response_code(201);
        echo json_encode(['message' =>"projet modifié avec succes"]);
    }else{
        http_response_code(503);
        echo json_encode(['message' =>"Modification projet a echoué"]);
    }
}else{
    echo json_encode(['message' => 'les Données ne sont pas au complet']);
}
}else{
    http_response_code(405);
    echo json_encode(['message'=>"la methode n'est pas autorisé"]);
}
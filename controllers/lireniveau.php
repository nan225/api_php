<?php
// Les entetes requises 

header("Access-Control-Origin:*");
header("Content-type:application/json; charset=UTF-8");
header("Access-Control-Allow-Methods:GET");
require_once('../config/database.php');
require_once('../models/Niveau.php');

if($_SERVER['REQUEST_METHOD']==="GET"){
    // on ninstancie la base de donées

$database = new Database();
$db = $database->getConnexion();

//on instancie l'objet underProgram

$projet=new Niveau($db);

// recupération des données

$statement= $projet->readAll();

if($statement->rowCount() > 0){
    $data=[];

    $data[]=$statement->fetchAll();
// on renvoie les données sous format json
http_response_code(200);
    echo json_encode($data);
}else{
    echo json_encode(["message"=>"Aucune données à renvoyé"]);
}
}else{
    http_response_code(405);
    echo json_encode(['message'=>"la methode n'est pas autorisé"]);
}
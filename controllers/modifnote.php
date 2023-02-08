<?php
// Les entetes requises 

header("Access-Control-Origin:*");
header("Content-type:application/json; charset=UTF-8");
header("Access-Control-Allow-Methods:PUT");
require_once('../config/database.php');
require_once('../models/Note.php');

if($_SERVER['REQUEST_METHOD']==="PUT"){
    // on ninstancie la base de donées

$database = new Database();
$db = $database->getConnexion();

//on instancie l'objet article

$note=new Note($db);


// on recupere les infos envoyés
$data=json_decode(file_get_contents("php://input"));
if(!empty($data->id_note)&& !empty($data->Id_module)&& !empty($data->noteTD) && !empty($data->noteTP) && !empty($data->noteEXAM) && !empty($data->$noteRTPG)  && !empty($data->$id_ay)){
    //on hydrate l'objet étudiant
    $note->Id_module=htmlspecialchars($data->Id_module);
    $note->Id_module=htmlspecialchars($data->Id_module);
    $note->noteTD=htmlspecialchars($data->noteTD);
    $note->noteTP=htmlspecialchars($data->noteTP);
    $note->noteEXAM=htmlspecialchars($data->noteEXAM);
    $note->noteRTPG=htmlspecialchars($data->noteRTPG);
    $note->id_ay=htmlspecialchars($data->id_ay);


    $result=$Note->update();
    if($result){
        http_response_code(201);
        echo json_encode(['message' =>"sous_programme modifié avec succes"]);
    }else{
        http_response_code(503);
        echo json_encode(['message' =>"Modification sous_programme a echoué"]);
    }
}else{
    echo json_encode(['message' => 'les Données ne sont pas au complet']);
}
}else{
    http_response_code(405);
    echo json_encode(['message'=>"la methode n'est pas autorisé"]);
}
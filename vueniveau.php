<?php
include("menu.php");
?>
<br><br>

<?php
$projets = json_decode(file_get_contents('http://localhost:8888/api_php/controllers/lireniveau.php'));
function CallAPI($method, $api, $data)
{
    $url = "http://localhost:8888/api_php/controllers/" . $api;
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    switch ($method) {
        case "GET":
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
            break;
        
        case "DELETE":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            break;
    }
    $response = curl_exec($curl);
    $data = json_decode($response);

    /* Check for 404 (file not found). */
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    // Check the HTTP Status code
    switch ($httpCode) {
        case 200:
            $error_status = "200: Success";
            return ($data);
            break;
        case 404:
            $error_status = "404: API introuvable";
            break;
        case 500:
            $error_status = "500: les serveurs ont répondu par une erreur.";
            break;
        case 502:
            $error_status = "502: les serveurs peuvent être en panne ou en cours de mise à niveau. Espérons qu'ils iront bien bientôt !";
            break;
        case 503:
            $error_status = "503: service non disponible. Espérons qu'ils iront bien bientôt !";
            break;
        default:
            $error_status = "Erreur non documentée: " . $httpCode . " : " . curl_error($curl);
            break;
    }
    curl_close($curl);
    echo $error_status;
}

if (isset($_POST['projets_id'])) {
    $projetID = htmlspecialchars(trim($_POST['codeL']));
    $data = array('id_niveau' => $projetID);
    $result = CallAPI('DELETE', "deleteniveau.php", $data);
    header('location: ./vueniveau.php');

}







?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style2.css">
    
</head>
<body>



<div  class="container-fluid">
    <table class="table" name="table">
        <thead>
          <tr>
            <th scope="col">N°</th>
            <th scope="col">id niveau</th>
            <th scope="col">niveau</th>
          </tr>
        </thead>
        <?php foreach ($projets[0] as $projet):?>
        <tbody>
          <tr>
            <th scope="row"><?= $projet -> $id_niveau ?></th>
            <td><?= $projet -> id_niveau ?></td>
            <td><?= $projet -> id_niveau ?></td>

            <td>
            <?php
                        echo ' <form action="./vueniveau.php" method="POST"><input type="hidden"
                          name="codeL" value=' . $projet->id_niveau . ' >
                                <input type="submit" class="btn btn-danger" name="projets_id" value="Supprimer">
                                </form> '
                        ?>
            </td>
          </tr> 
         
        </tbody>
        <?php endforeach; ?>
    </table>
  </div>
    
    
      
      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
</body>
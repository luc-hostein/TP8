<?php

include "connexpdo.php";

$idcon = connexpdo("citations","postgres","isen2020");
$query1 = "SELECT * from citation";
$query2 = "SELECT * from auteur";
$query3 = "SELECT * from siecle";
$result1 = $idcon->query($query1);
$result2 = $idcon->query($query2);
$result3 = $idcon->query($query3);

$listAuteur = "";
$listSiecele = "";

$listAuteur = "<select class=\"form-control\" id=\"exampleFormControlSelect1\" name=\"auteur\">";
foreach ($result2 as  $data){
    $auteurName = $data["nom"];
    $listAuteur = $listAuteur."<option>$auteurName</option>";
}
$listAuteur  = $listAuteur."</select>";

$listSiecele = "<select class=\"form-control\" id=\"exampleFormControlSelect1\" name=\"siecle\">";
foreach ($result3 as $data){
    $siecle = $data['numero'];
    $listSiecele = $listSiecele."<option>$siecle</option>";
}
$listSiecele  = $listSiecele."</select>";



echo "
<!DOCTYPE html>
<html>
  <head>
    <title>TP8 php</title>
    <!-- ajout de BS -->
    <link rel=\"stylesheet\" href=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css\" integrity=\"sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T\" crossorigin=\"anonymous\">
    <script src=\"https://code.jquery.com/jquery-3.3.1.slim.min.js\" integrity=\"sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo\" crossorigin=\"anonymous\"></script>
    <script src=\"https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js\" integrity=\"sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1\" crossorigin=\"anonymous\"></script>
    <script src=\"https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js\" integrity=\"sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM\" crossorigin=\"anonymous\"></script>
    <link href=\"https://fonts.googleapis.com/icon?family=Material+Icons\"rel=\"stylesheet\">
  </head>
  <body>
    <form action='recherche.php' method='post'>
    <h1 class=\"font-weight-bold\">Rechercher une citation</h1>
    <hr>
    <div><p>Auteur</p><br>$listAuteur</div><br>
    <div><p>Siècle</p>$listSiecele</div><br>
    <button type=\"button submit\" class=\"btn btn-primary\">Recherche</button><br><br>
    </form>
    
  </body>
</html>

";


$idAuteur=0;
$idSiecle=0;

foreach ($result2 as $data){
    if($data['nom'] == $_POST["auteur"]){
        $idAuteur = $data['id'];
    }
}





$citationToShow="<table class='table'><thead><tr>
                    <th scope='col'>Citation</th>
                    <th scope='col'>Auteur</th>     
                    <th scope='col'>Siècle</th>                              
                 </tr></thead><tbody>";

foreach ($result1 as $data){
    if($idAuteur == $data['auteurid']){
        $citation = $data['phrase'];
        $auteur = $_POST["auteur"];
        $siecle = $_POST["siecle"];
        $citationToShow = $citationToShow."
            <tr>
                <th scope='row'>$citation</th>
                <td>$auteur</td>
                <td>$siecle</td>
            </tr>
        ";
    }
}

$citationToShow = $citationToShow."</tbody></table>";

echo $citationToShow;


?>

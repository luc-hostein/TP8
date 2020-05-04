<?php

include "connexpdo.php";

$idcon = connexpdo("citations","postgres","isen2020");
$query1 = "SELECT * from citation";
$query2 = "SELECT * from auteur";
$query3 = "SELECT * from siecle";
$result1 = $idcon->query($query1);
$result2 = $idcon->query($query2);
$result3 = $idcon->query($query3);
$nbCitation = $result1->rowCount();
$randomCitation = rand(1,$nbCitation);
$citationToSHow = "";
$auteurCitation = "";
$siecleAuteur = 0;
$idAuteur = 0;
$idSiecle = 0;
$i = 1;
foreach($result1 as $data)
{
    if($i == $randomCitation){
        $citationToSHow = $data['phrase'];
        $idAuteur = $data['auteurid'];
        $idSiecle = $data['siecleid'];
    }
    $i++;
}

foreach ($result2 as $data){
    if($data['id'] == $idAuteur){
        $auteurCitation = $data['prenom']." ".$data['nom'];
    }
}

foreach ($result3 as $data){
    if($data['id'] == $idSiecle){
        $siecleAuteur = $data['numero'];
    }
}

if($siecleAuteur == 0){
    $siecleAuteur = "unknown";
}


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
  <h1 class=\"font-weight-bold\">Citation du jour</h1><br><hr><br>
  <p>Il y a $nbCitation citation</p><br><p>Voici la citation du jour écrite par $auteurCitation ($siecleAuteur ème siècle) : <a class=\"font-weight-bold\">$citationToSHow</a></p>
    

  </body>
</html>
 ";

?>

<?php
include "connexpdo.php";

$idcon =  connexpdo("citations","postgres","isen2020");
$auteurcon = connexpdo("auteur","postgres","isen2020");

$query1 = "SELECT * from citation";
$query2 = "SELECT * from auteur";
$result1 = $idcon->query($query1);
$result2 = $auteurcon->query($query2);
foreach($result1 as $data)
{
    echo $data['phrase'];
    echo"</br>";
}

foreach ($result2 as $data)
{
    echo $data['nom']." ".$data['prenom'];
}



?>

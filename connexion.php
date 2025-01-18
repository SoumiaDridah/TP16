<?php
$connexion=mysqli_connect('localhost','root','','gestion_avions');
if(!$connexion){
    die("Echec de la connexion".mysqli_connect_error());
}

?>
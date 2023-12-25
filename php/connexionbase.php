<?php
//Connexion à la base de données 
$server="localhost";
$user="root";
$pass="";
$base="entrepot_vintage";

$conn=mysqli_connect($server,$user,$pass,$base);

if(mysqli_error($conn)){
    echo "Echec de la connexion";
}
else{
    echo "Connexion réussie";
}
?>
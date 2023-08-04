<?php 
    //* Connexion :
    try {
        $connection = new PDO("mysql:host=localhost;dbname=e-souk","root","");
    } catch(PDOException $e){
        die ("Erreur ".$e->getMessage());
    }
?>
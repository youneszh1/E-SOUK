<?php 
    require_once 'dbconnection.php';
    $id = $_GET['id'];
    $etat = $_GET['etat'];
    $sql = $connection->prepare('UPDATE commande SET valide = ? WHERE id = ?');
    $sql->execute([$etat, $id]);
    header("location:commande.php?id=$id")


    //! Pour checker les erreurs on utilise la methode  var_dump(element->errorInfo()).
?>
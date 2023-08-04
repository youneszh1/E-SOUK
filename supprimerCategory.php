<?php
    require_once "dbconnection.php";
    $id = $_GET['id'];

    $sql = $connection->prepare('DELETE FROM category WHERE id=?');
    $sql->execute([$id]);

    header("location:listeCategories.php")
?>
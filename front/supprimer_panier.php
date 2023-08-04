<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("location:../connection.php");
    }

    $idUser = $_SESSION['user']['id'];
    $id = $_POST['id'];
    unset($_SESSION['panier'][$idUser][$id]);

    header("location:".$_SERVER['HTTP_REFERER']);


?>
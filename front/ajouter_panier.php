<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("location:../connection.php");
    }

    $id = $_POST['id'];
    $qte = $_POST['qte'];
    $idUser = $_SESSION['user']['id'];
        
        if(!isset($_SESSION['panier'][$idUser])){
            $_SESSION['panier'][$idUser] = [];
        } 
        if ($qte == 0){
            unset($_SESSION['panier'][$idUser][$id]);
        } else {
            $_SESSION['panier'][$idUser][$id] = $qte;
        }


    header("location:".$_SERVER['HTTP_REFERER']);

?>
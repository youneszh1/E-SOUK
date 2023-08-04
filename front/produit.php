<?php 
session_start();
    require_once "../dbconnection.php"; 
    $id = $_GET['id'];
    $sql = $connection->prepare("SELECT * FROM produit WHERE id=?");
    $sql->execute([$id]);
    $produit = $sql->fetch(PDO::FETCH_ASSOC);
    
        $prix = $produit['prix'];
        $discount = $produit['discount'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="stylesheet" href="../assets/css/produit.css">

    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <title>Produit | <?= $produit['libelle'] ?></title>
</head>
<body>
    <?php include "../include/nav_front.php";?>
    <div class="container py-2">
        <h4><?= $produit['libelle']?></h4>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <img class="img img-fluid w-75" src="../uploaded files/produits/<?=$produit['image']?>" alt="">
                </div>
                <div class="col-md-6">
                    <div class="d-flex align-items-center">
                        <h1 class="w-100"><?=$produit['libelle']?></h1>
                        <span class="badge text-bg-secondary">
                            - <?=$discount?> %
                        </span>     
                    </div>
                    <hr>
                    <p>
                        <?=$produit['description']?>
                    </p>
                    
                        
                        <?php
                                if (!empty($discount)){
                                    $prixfinal = $prix - (($prix*$discount)/100);
                        ?>
                                    <h2>
                                        <span class="badge text-bg-danger">
                                        <strike><?= $prix; ?>MAD</strike> 
                                        </span>
                                        <span class="badge text-bg-success">
                                            <?= $prixfinal ?> MAD
                                        </span>
                                    </h2>
                                    
                        <?php
                                } else {
                        ?>
                                <h2>
                                    <span class="badge text-bg-success">
                                        <?= $prix; ?> MAD
                                    </span>
                                </h2>
                        <?php 
                                }
                        ?>
                                
                    
                    
                    <hr>
                        <?php
                            $idProduit = $produit['id'];
                            include "../include/front/counter.php" 
                        ?>
                    <hr>
                    <a class="btn btn-primary" href="#">Ajouter au panier</a>
                </div>
            
            
            </div>
        </div>        
    </div>
            
</body>
<script src="../assets/js/produit/counter.js"></script>
</html>


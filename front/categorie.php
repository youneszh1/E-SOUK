<?php 
session_start();
    require_once "../dbconnection.php"; 
    $id = $_GET['id'];
    $sql = $connection->prepare("SELECT * FROM category WHERE id=?");
    $sql->execute([$id]);
    $categorie = $sql->fetch(PDO::FETCH_ASSOC);

    $sql = $connection->prepare("SELECT * from produit WHERE idCategory=?");
    $sql->execute([$id]);
    $produits = $sql->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Categorie | <?= $categorie['libelle'] ?></title>
</head>
<body>
    <?php include "../include/nav_front.php"; ?>
    <div class="container py-2" >
        <h4><i class="fa <?= $categorie['icon'] ?>"></i> <?= $categorie['libelle'] ?></h4>
        <div class="container">
            <div class="row">
            <?php
                foreach ($produits as $produit){
                    $idProduit = $produit['id'];
            ?>
                <div class="card mb-3 col-md-4 py-2">
                    <img src="../uploaded files/produits/<?= $produit['image'] ?>" alt="Card image cap" class="card-img-top w-75 mx-auto">
                    <div class="card-body">
                        <h5 class="card-title"><?= $produit['libelle'];?></h5>
                        <p class="card-text"><i class="fa <?= $categorie['icon'] ?>"></i> <?= $categorie['libelle'];?> : <?= $produit['description'] ?></p>
                        <p class="card-text"> <?= $produit['prix'];?> DH</p>
                        <p class="card-text"><small class="text-muted"> Ajoute le : <?= date_format(date_create($produit['dateCreation']), "Y-m-d") ;?></small></p>
                        <a href="produit.php?id=<?php echo $produit['id'] ?>" class="btn btn-primary stretched-link" >Details</a>
                    </div>
                    <div class="card-footer" style="z-index: 10;">
                        <?php include "../include/front/counter.php" ?>
                    </div>
                </div>
            <?php
                }
                if (empty($produits)){
                    echo "<div class='alert alert-warning' role='alert'>
                    Pas de produits pour l'instant. 
                            </div>";
                }
            ?>
            </div>
        </div>        
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="../assets/js/produit/counter.js"></script>
</body>
</html>


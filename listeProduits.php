<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Liste des produits</title>
</head>
<body>
    <?php include "include/nav.php"; ?>
    <div class="container py-2" >
        <h4>Liste des produits</h4>
        <a class="btn btn-primary my-1 float-end" href="produit.php">Ajouter un produit</a>   
        <table class="table table-striped table-hover text-center">
            <tr>
                <th>ID</th>
                <th>LIBELLE</th>
                <th>PRIX</th>
                <th>DISCOUNT</th>
                <th>PRIX AFTER DISCOUNT</th>
                <th>DESCRIPTION</th>
                <th>CATEGORIE</th>
                <th>IMAGE</th>
                <th>DATE DE CREATION</th>
                <th>OPERATIONS</th>
            </tr>
                <?php 
                    require_once "dbconnection.php";
                    $sql = $connection->query('SELECT produit.*, category.libelle as "category_libelle" FROM produit INNER JOIN category ON produit.idCategory = category.id');
                    $produits = $sql->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($produits as $produit){
                        $prix = $produit["prix"];
                        $discount = $produit["discount"];
                        $prixFinal = $prix - (($prix*$discount)/100) ;
                        ?>
            <tr> 
                <td><?= $produit["id"]?></td>
                <td><?= $produit["libelle"]?></td>
                <td><?= $produit["prix"]?> DH</td>
                <td><?= $produit["discount"]?> %</td>
                <td><?= $prixFinal ?> DH</td>
                <td><?= $produit["description"] ?></td>
                <td><?= $produit["category_libelle"]?></td>
                <td><img class="img img-fluid" width="100px" src="uploaded files/produits/<?= $produit["image"] ?>" alt="<?= $produit["image"] ?>"></td>
                <td><?= $produit["dateCreation"]?></td>
                <td>
                    <a href="modifierProduit.php?id=<?php echo $produit["id"] ?>" class="btn btn-warning">MODIFIER</a>
                    <a href="supprimerProduit.php?id=<?php echo $produit["id"] ?>" onclick="return confirm('Voulez vous vraiment supprimer le produit <?=$produit['libelle'] ?>.?')" class="btn btn-danger">SUPPRIMER</a>
                </td>
            </tr>
                <?php
                    }
                ?>
        </table>
    </div>
            
</body>
</html>

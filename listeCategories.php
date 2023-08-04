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
        <h4>Liste des categories</h4>
        <a class="btn btn-primary my-1 float-end" href="categorie.php">Ajouter une categorie</a>
        <table class="table table-striped table-hover">
            <tr>
                <!-- <th>ID</th> -->
                <th>LIBELLE</th>
                <th>DESCRIPTION</th>
                <th>ICONE</th>
                <th>DATE DE CREATION</th>
                <th>OPERATIONS</th>
            </tr>
                <?php 
                    require_once "dbconnection.php";
                    $sql = $connection->query("SELECT * FROM category");
                    $categories = $sql->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($categories as $categorie){
                        ?>
            <tr> 
                <!-- <td><?php // echo $categorie["id"]?></td> -->
                <td><?php echo $categorie["libelle"]?></td>
                <td><?php echo $categorie["description"]?></td>
                <td><i class="fa <?php echo $categorie["icon"]?>"></i></td>
                <td><?php echo $categorie["dateCreation"]?></td>
                <td>
                    <a href="modifierCategory.php?id=<?php echo $categorie["id"] ?>" class="btn btn-warning">MODIFIER</a>
                    <a href="supprimerCategory.php?id=<?php echo $categorie["id"]?>" onclick="return confirm('Voulez vous vraiment supprimer la categorie <?= $categorie['libelle'] ?>?')" class="btn btn-danger">SUPPRIMER</a>
                </td>
            </tr>
                <?php
                    }
                ?>
        </table>
        
    </div>
            
</body>
</html>

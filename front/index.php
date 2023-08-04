<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>E-SOUK</title>
</head>
<body>
    <?php include "../include/nav_front.php"; ?>
    <div class="container py-2" >
        <h4>Liste des categories</h4>
        <?php require_once "../dbconnection.php"; 
        $sql = $connection->query("SELECT * FROM category");
        $categories = $sql->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <ul class="list-group list-group-flush">
            <?php
                foreach ($categories as $categorie){

                    ?>
                <li class="list-group-item"><a href="categorie.php?id=<?= $categorie["id"] ?>" class="btn btn-light"><i class="fa <?= $categorie['icon'] ?>"></i> <?= $categorie["libelle"] ?></a></li>
                <?php 
            }
            ?>
        </ul>
        
    </div>
            
</body>
</html>

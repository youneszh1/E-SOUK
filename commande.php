<?php 
    require_once "dbconnection.php";
    $idCommande = $_GET['id'];
    $sql = $connection->prepare('SELECT commande.*,user.login as "login" FROM commande INNER JOIN user ON commande.id_client = user.id 
    WHERE commande.id = ?
    ORDER BY date_creation DESC');
    $sql->execute([$idCommande]);
    $commande = $sql->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Commande | <?= $commande['id']?> </title>
</head>
<body>
    <?php include "include/nav.php"; ?>
    <div class="container py-2" >
        <h4>Details de la commande numero <?= $commande['id']?></h4>
        <!-- ALERT -->
            <div>
            <?php 
            if($commande['valide']==1): ?>
                <div class='alert alert-success' role='alert'>
                    Votre commande a ete bien validee.
                </div>
            <?php else :?>
                <div class='alert alert-danger' role='alert'>
                    Votre commande a ete annulee.
                </div>
            <?php endif; ?>
            </div>
        <table class="table table-striped table-hover">
            <tr>
                <th>ID</th>
                <th>Client</th>
                <th>Total</th>
                <th>Date</th>
                <th>Operations</th>
                <th></th>
            </tr>
            <tr> 
                <?php
                    $sqlLigneCommandes = $connection->prepare('SELECT ligne_commande.*, produit.libelle, produit.image FROM ligne_commande INNER JOIN produit ON ligne_commande.id_produit = produit.id WHERE id_commande = ?');
                    $sqlLigneCommandes->execute([$idCommande]);
                    $lignesCommande = $sqlLigneCommandes->fetchAll(PDO::FETCH_ASSOC);


                ?>
                <td><?php echo $commande["id"]?></td>
                <td><?php echo $commande["login"]?></td>
                <td><?php echo $commande["total"]?> DH</td>
                <td><?php echo $commande["date_creation"]?></td>
                <td><?php if($commande["valide"]==0):?>
                        <a href="valider_commande.php?id=<?= $commande['id']?>&etat=1" class="btn btn-success btn-sm mx-1"><i class="bi bi-check-circle"></i> Valider la commande</a>
                    <?php else : ?>
                        <a href="valider_commande.php?id=<?= $commande['id']?>&etat=0" class="btn btn-danger btn-sm mx-1"><i class="bi bi-x-circle"></i> Annuler la commande</a>

                    <?php endif;?>

                </td>
                <td>
                    <a class="btn btn-primary btn-sm" href="listeCommandes.php"><i class="fa fa-list"></i> Liste des commandes</a>
                </td>
            </tr>
        </table>
        <hr>
        <h4>Les produits de la commande</h4>
        <table class="table table-striped table-hover">
            <tr>
                <th>ID</th>
                <th>Produit</th>
                <th>Image</th>
                <th>Prix</th>
                <th>Quantite</th>
                <th>Total</th>
            </tr>
            <tbody>
                <?php foreach ($lignesCommande as $ligneCommande) : 
                    ?>
                    <tr> 
                        <td><?=$ligneCommande['id']?></td>
                        <td><?=$ligneCommande['libelle']?></td>
                        <td><img class="img img-fluid" width="100px" src='uploaded files/produits/<?=$ligneCommande["image"]?>' alt=""></td>
                        <td><?=$ligneCommande['prix']?> DH</td>
                        <td><?=$ligneCommande['qte']?></td>
                        <td><?=$ligneCommande['total']?></td>
                        
                    </tr>
                    <?php endforeach; ?>
                </tbody>
        </table>
    </div>

            
</body>
</html>

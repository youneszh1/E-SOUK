<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Liste des commandes</title>
</head>
<body>
    <?php include "include/nav.php"; ?>
    <div class="container py-2" >
        <h4>Liste des commandes</h4>
        <table class="table table-striped table-hover">
            <tr>
                <!-- <th>ID</th> -->
                <th>ID</th>
                <th>Client</th>
                <th>Total</th>
                <th>Date</th>
                <th>Operations</th>
            </tr>
                <?php 
                    require_once "dbconnection.php";
                    $sql = $connection->query('SELECT commande.*,user.login as "login" FROM commande INNER JOIN user ON commande.id_client = user.id ORDER BY date_creation DESC');
                    $commandes = $sql->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($commandes as $commande){
                        ?>
            <tr> 
                <!-- <td><?php // echo $categorie["id"]?></td> -->
                <td><?php echo $commande["id"]?></td>
                <td><?php echo $commande["login"]?></td>
                <td><?php echo $commande["total"]?> DH</td>
                <td><?php echo $commande["date_creation"]?></td>
                <td>
                    <a class="btn btn-primary btn-sm" href="commande.php?id=<?= $commande['id']?>">Afficher Details</a>
                </td>
            </tr>
                <?php
                    }
                ?>
        </table>
    </div>
            
</body>
</html>

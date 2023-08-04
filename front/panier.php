<?php 
session_start();
    require_once "../dbconnection.php"; 
    
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
    <title>Panier</title>
</head>
<body>
    <?php include "../include/nav_front.php"; ?>
    <div class="container py-2" >
        <?php 
            if(isset($_POST['vider'])){
                $_SESSION['panier'][$idUser] = [];
                header('location: panier.php');
            }

            $idUser = $_SESSION['user']['id'];
            $panier = $_SESSION['panier'][$idUser];

            if(!empty($panier)){
                $idProduits = array_keys($panier);
                $idProduits = implode(",",$idProduits);

                $sql = $connection->query("SELECT * FROM produit WHERE id IN ($idProduits)");
                $produits = $sql->fetchAll((PDO::FETCH_ASSOC));
            }
            if(isset($_POST['valider'])){
                $sql = 'INSERT INTO ligne_commande(id_produit, id_commande, prix, qte, total) VALUES ';
                $total = 0;
                $prixProduits = [];
                foreach ($produits as $produit){
                    $idProduit = $produit['id'];
                    $qte = $panier[$idProduit];
                    $prix = $produit['prix'];

                    $total += $prix * $qte;

                    $prixProduits[$idProduit] = [
                        'id' => $idProduit,
                        'prix' => $prix,
                        'total' => $qte * $prix,
                        'qte' => $qte
                    ];
                    
                }
                $sqlCommande = $connection->prepare('INSERT INTO commande(id_client, total) VALUES (?,?)');
                $sqlCommande->execute([$idUser, $total]);

                //* Recuperation l'id de la commande:
                $idCommande = $connection->lastInsertId();

                //* Details de la commande (historic):
                foreach ($prixProduits as $produit){
                    $id = $produit['id'];
                    $sql .= "(:id$id,'$idCommande',:prix$id,:qte$id,:total$id),";
                }
                $sql=substr($sql, 0,-1);
                $sqlCommande = $connection->prepare($sql);
                foreach ($prixProduits as $produit){ 
                    $id = $produit['id'];
                    $sqlCommande->bindParam(':id'.$id, $produit['id']);
                    $sqlCommande->bindParam(':prix'.$id, $produit['prix']);
                    $sqlCommande->bindParam(':qte'.$id, $produit['qte']);
                    $sqlCommande->bindParam(':total'.$id, $produit['total']);
                }               
                $inserted = $sqlCommande->execute();

                if($inserted){
                    $_SESSION['panier'][$idUser]=[];
                    echo "<div class='alert alert-success' role='alert'>
                    Votre Commande avec le montant de $total DH a ete valider avec succes. 
                    </div>";
                }
                // v31 : 2"53
            }
        ?>
        <h4><i class="fa fa-cart-shopping"></i> Panier (<?php echo PRODUCTS_COUNT ?>)</h4>
        <div class="container">
            <div class="row">
            <?php
            
            

                if (empty($panier)){
                    echo "<div class='alert alert-warning' role='alert'>
                    Votre panier est vide. 
                            </div>";
                }else {
            
                    ?>
                    <table class="table text-center">
                        <thead>
                            <th scope="col">id</th>
                            <th scope="col">Image</th>
                            <th scope="col">Libelle</th>
                            <th scope="col">Quantite</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Total produit</th>
                        </thead>
                    <?php
                    $total=0;
                    foreach ($produits as $produit){
                        $idProduit = $produit['id'];
                        $totalProduit = $produit['prix']*$panier[$produit['id']];
                        $total += $totalProduit;
                        ?>
                        <tbody>
                            <td><?= $produit['id'] ?></td>
                            <td><img width="80px" src="../uploaded files//produits/<?= $produit['image'] ?>" alt=""></td>
                            <td><?= $produit['libelle'] ?> </td>
                            <td><?php include '../include/front/counter.php' ?></td>
                            <td><?= $produit['prix'] ?> DH </td>
                            <td><?= $totalProduit ?> DH </td>

                        </tbody>
                        <?php
                    }
                    ?>
                    <tfoot>
                        <tr>
                            <td colspan="5" align="right"><strong>TOTAL </strong></td>
                            <td><?= $total ?> DH</td>
                        </tr>
                        <tr>
                            <td colspan="6" align="right">
                                <form method="post">

                                    
                                    
                                    <button type="submit" class="btn btn-success" name="valider"><i class="bi bi-check-circle"></i> Valider la commande</button>
                                    <button onclick="return confirm('Voulez-vous vraiment vider le panier?')" type="submit" class="btn btn-danger" name="vider"><i class="bi bi-x-circle"></i> Vider le panier</button>
                                </form>
                            </td>    
                        </tr>
                            
                    </tfoot>
                    </table>
                    <?php
                }
            ?>
            </div>
        </div>        
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="../assets/js/produit/counter.js"></script>
</body>
</html>


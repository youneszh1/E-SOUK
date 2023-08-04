<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Ajouter Produit</title>
</head>
<body>
    <?php include "include/nav.php"; ?>
    <div class="container py-2">
        <h4>Ajouter Produit</h4>
        <?php 
            // * REMPLISSAGE DU SELECT LISTE CATEGORIES:
            require_once "dbconnection.php";
            $sql = $connection->query("SELECT * FROM category");
            $categories = $sql->fetchAll(PDO::FETCH_ASSOC);

            // * AJOUTE DU PRODUIT DANS LA BASE DE DONNEES
            if(isset($_POST["ajouter_produit"])){
                $libelle = $_POST['libelle'];
                $prix = $_POST['prix'];
                $discount = $_POST['discount'];
                $description = $_POST['description'];
                $categorie = $_POST['categories'];
                $filename = 'produit.png';
                if (!empty($_FILES['image']['name'])){
                    $image = $_FILES['image']['name'];
                    $filename = uniqid().$image;
                    move_uploaded_file($_FILES['image']['tmp_name'],'uploaded files/produits/'.$filename);

                };
                $dateCreation = date("Y-m-d");

                if(!empty($libelle) && !empty($prix) && !empty($categorie)){

                    $sql = $connection->prepare("INSERT INTO produit (libelle, prix, discount, idCategory,dateCreation,description, image) VALUES (?,?,?,?,?,?,?)");
                    $sql->execute([$libelle,$prix,$discount,$categorie,$dateCreation,$description,$filename]);
                    /* echo '<div class="alert alert-success" role="alert">
                                Le produit '. $libelle .' a ete bien ajoutee.
                            </div>'; */
                            header("location: listeProduits.php");
                }else {
                    echo '<div class="alert alert-danger" role="alert">
                                Champs obligatoires.
                            </div>';
                }
            }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <label for="libelle" class="form-label">Libelle</label><br>
            <input type="text" class="form-control" name="libelle"><br>
            <label for="description">Description</label><br>
            <textarea class="form-control" name="description"></textarea><br>
            <label for="prix" class="form-label">prix</label><br>
            <input type="number" min="0" class="form-control" step="0.1" name="prix"><br>
            <label for="discount" class="form-label">discount</label><br>
            <input type="number" step="0.1" min="0" max="99" class="form-control" name="discount"><br>
            <label for="categories" class="form-label">categorie</label><br>
            <select name="categories" class="form-control">
                <option value="">Choisissez la categorie</option>
                <?php
                foreach ($categories as $categorie){
                    ?>
                        <option value="<?php echo $categorie['id'] ?>"><?php echo $categorie['libelle'] ?></option>
                    <?php
                }
                ?>
            </select>
            <label for="image" class="form-label">image</label><br>
            <input class="form-control" type="file" name="image" accept="" id="">
            
            <input type="submit" class="btn btn-primary my-2" value="Ajouter produit" name="ajouter_produit">
        </form>
    </div>

</body>
</html>
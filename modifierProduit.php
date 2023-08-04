<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>modifier Produit</title>
</head>
<body>
    <?php include "include/nav.php"; ?>
    <div class="container py-2">
        <h4>Modifier Produit</h4>
        <?php 
            //* REMPLISSAGE DES INPUTS:
            require_once "dbconnection.php";
            $id= $_GET['id'];
            $sql = $connection->prepare("SELECT * FROM produit WHERE id=?");
            $sql->execute([$id]);
            $produit=$sql->fetch(PDO::FETCH_ASSOC);

            // * REMPLISSAGE DU SELECT LISTE CATEGORIES:
            $sql = $connection->query("SELECT * FROM category");
            $categories = $sql->fetchAll(PDO::FETCH_ASSOC);

            // * AJOUTE DU PRODUIT DANS LA BASE DE DONNEES
            if(isset($_POST["modifier_produit"])){
                $libelle = $_POST['libelle'];
                $prix = $_POST['prix'];
                $discount = $_POST['discount'];
                $description = $_POST["description"];
                $categorie = $_POST['categories'];
                $description = $_POST['description'];
                $filename = '';
                if (!empty($_FILES['image']['name'])){
                    $image = $_FILES['image']['name'];
                    $filename = uniqid().$image;
                    move_uploaded_file($_FILES['image']['tmp_name'],'uploaded files/produits/'.$filename);
                };
                if(!empty($libelle) && !empty($prix) && !empty($categorie)){
                    //* ila l user bdel tswira ghatst3lml if, ila mabdlch ghatst3ml else.
                    if(!empty($filename)){
                        $query = "UPDATE produit SET libelle=?, prix=?, discount=?, idCategory=?, description=?, image=? WHERE id=?";
                        $sql = $connection->prepare($query);
                        $sql->execute([$libelle,$prix,$discount,$categorie,$description,$filename,$id]);
                    } else {
                        $query = "UPDATE produit SET libelle=?, prix=?, discount=?, idCategory=?, description=? WHERE id=?";
                        $sql = $connection->prepare($query);
                        $sql->execute([$libelle,$prix,$discount,$categorie,$description,$id]);
                    }

                    
                    //! var_dump($sql->errorInfo());    pour determiner l'erreur.
                        if($sql){
                            header("location: listeProduits.php");
                        } else {
                            echo '<div class="alert alert-danger" role="alert">
                                Database Error (40023).
                            </div>';
                        }
                }else {
                    echo '<div class="alert alert-danger" role="alert">
                                Champs obligatoires.
                            </div>';
                }
            }
        ?>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="number"  class="form-control" name="id" value="<?= $produit['id'] ?>" hidden><br>
            <label for="libelle" class="form-label">Libelle</label><br>
            <input type="text" class="form-control" name="libelle" value="<?= $produit['libelle'] ?>"><br>
            <label for="description">Description</label><br>
            <textarea class="form-control" name="description"><?=$produit['description']?></textarea><br>
            <label for="prix" class="form-label">prix</label><br>
            <input type="number" min="0" class="form-control" step="0.1" name="prix" value="<?= $produit['prix'] ?>"><br>
            <label for="discount" class="form-label">discount</label><br>
            <input type="number" step="0.1" min="0" max="99" class="form-control" name="discount" value="<?= $produit['discount'] ?>"><br>
            <label for="categories" class="form-label">categorie</label><br>
            <select name="categories" class="form-control">
                <option value="">Choisissez la categorie</option>
                <?php
                foreach ($categories as $categorie){
                    // * Method 1: normal condition
                    /* if ($produit['idCategory'] == $categorie['id']){
                    ?>
                    <option selected value="<?php echo $categorie['id'] ?>"><?php echo $categorie['libelle'] ?></option>
                    <?php
                    } else {
                        ?>
                        <option value="<?php echo $categorie['id'] ?>"><?php echo $categorie['libelle'] ?></option>
                    <?php */
                    // * Method 2: Ternary condition
                    $selected = $produit['idCategory'] == $categorie['id']? " selected" : "";
                    ?>
                    <option <?=$selected?> value="<?php echo $categorie['id'] ?>"><?php echo $categorie['libelle'] ?></option>
                    <?php
                }
            
                ?>
            </select>
            <label for="image" class="form-label">image</label><br>
            <input class="form-control" type="file" name="image" value="<?= $produit['image']?>">
            <img class="img img-fluid my-2" src="uploaded files/produits/<?= $produit['image'] ?>" alt="" width="100"><br>
            
            <input type="submit" class="btn btn-primary my-2" value="Modifier produit" name="modifier_produit">
        </form>
    </div>

</body>
</html>
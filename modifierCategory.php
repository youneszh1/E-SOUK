<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Ajouter Categorie</title>
</head>
<body>
    <?php include "include/nav.php"; ?>
    <div class="container py-2">
        <h4>Modifier Categorie</h4>
        <?php 
            $id = $_GET['id'];
            require_once "dbconnection.php";
            $sql = $connection->prepare("SELECT * FROM category WHERE id=?");
            $sql->execute([$id]);
            $categorie=$sql->fetch(PDO::FETCH_ASSOC);

            if(isset($_POST["modifier_categorie"])){
                $libelle = $_POST['libelle'];
                $description = $_POST['description'];
                $icon = $_POST['icon'];
                if(!empty($libelle) && !empty($description)){
                    $sql = $connection->prepare("UPDATE category SET libelle=?, description=?, icon=? WHERE id=?");
                    $sql->execute([$libelle,$description,$icon,$id]);
                    header("location: listeCategories.php");
                }else {
                    echo '<div class="alert alert-danger" role="alert">
                                Champs obligatoires.
                            </div>';
                }
            }
        ?>
        <form action="" method="post"> 
            <input type="number" class="form-control" name="id" value="<?php echo $categorie['id'] ?>" hidden><br>
            <label for="libelle">Libelle</label><br>
            <input type="text" class="form-control" name="libelle" value="<?php echo $categorie['libelle'] ?>"><br>
            <label for="description">Description</label><br>
            <textarea class="form-control" name="description" ><?php echo $categorie['description'] ?></textarea><br>
            <label for="icon">icon</label><br>
            <input type="text" class="form-control" name="icon"  value="<?php echo $categorie['icon'] ?>"><br>
            <input type="submit" class="btn btn-primary my-2" value="Modifier categorie" name="modifier_categorie">
        </form>
        <a class="btn btn-success" href="listeCategories.php">Liste des categories</a>
    </div>
            

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
        <h4>Ajouter Categorie</h4>
        <?php 
            if(isset($_POST["ajouter_categorie"])){
                $libelle = $_POST['libelle'];
                $description = $_POST['description'];
                $icon = $_POST['icon'];
                if(!empty($libelle) && !empty($description)){
                    require_once "dbconnection.php";
                    $sql = $connection->prepare("INSERT INTO category (libelle, description, icon) VALUES (?,?,?)");
                    $sql->execute([$libelle,$description,$icon]);
                    /* echo '<div class="alert alert-success" role="alert">
                                La categorie '. $libelle .' a ete bien ajoutee.
                            </div>'; */
                    header("location: listeCategories.php");
                }else {
                    echo '<div class="alert alert-danger" role="alert">
                                Champs obligatoires.
                            </div>';
                }
            }
        ?>
        <form action="" method="post">
            <label for="libelle">Libelle</label><br>
            <input type="text" class="form-control" name="libelle"><br>
            <label for="description">Description</label><br>
            <textarea class="form-control" name="description"></textarea><br>
            <label for="icon">icon</label><br>
            <input type="text" class="form-control" name="icon"><br>
            <input type="submit" class="btn btn-primary my-2" value="Ajouter categorie" name="ajouter_categorie">
        </form>
        <a class="btn btn-success" href="listeCategories.php">Liste des categories</a>
    </div>
            

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Ajouter Utilisateur</title>
</head>
<body>
    <?php include "include/nav.php"; ?>
    <div class="container py-2" >
        <h4>Ajouter Utilisateur</h4>
        <?php 
            if(isset($_POST['ajouter'])){
                $login = $_POST['login'];
                $password = $_POST['password'];
                if(!empty($login) && !empty($password)){
                    require_once "dbconnection.php";
                    $dateCreation = date('Y-m-d');

                    $sql = $connection->prepare("INSERT INTO user VALUES (null,?,?,?)");
                    $sql->execute([$login,$password,$dateCreation]);
                    //! La redirection :
                    header('location:connection.php');

                    echo '<div class="alert alert-success" role="alert">
                                Bonjour '. $login.', votre mot de passe est : '.$password.'.
                            </div>';
                } else echo '<div class="alert alert-danger" role="alert">
                                Champs obligatoires.
                            </div>';


            }
        ?>
        <form action="" method="post">
            <label for="login">login</label><br>
            <input type="text" class="form-control" name="login"><br>
            <label for="password">password</label><br>
            <input type="password" class="form-control" name="password"><br>
            <input type="submit" class="btn btn-primary my-2" value="Ajouter Utilisateur" name="ajouter">
        </form>
    </div>
            
</body>
</html>

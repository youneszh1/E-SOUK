<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Document</title>
</head>
<body>
    <?php include "include/nav.php"; ?>
    <div class="container py-2">
        <h4>connection</h4>
        <?php 
            if(isset($_POST['connect'])){
                $login = $_POST['login'];
                $password = $_POST['password'];
                if(!empty($login) && !empty($password)){
                    require_once "dbconnection.php";
                    $sql = $connection->prepare("SELECT * FROM user WHERE login=? AND password=?");
                    $sql->execute([$login,$password]);
                    if($sql->rowCount()>=1){
                        $_SESSION["user"] = $sql->fetch();
                    } else {echo "Invalide user";}
                    //! La redirection :
                    header('location:admin.php');

                } else {echo '<div class="alert alert-danger" role="alert">
                                Champs obligatoires.
                            </div>';
                }


            }
        ?>
        <form action="" method="post">
            <label for="login">login</label><br>
            <input type="text" class="form-control" name="login"><br>
            <label for="password">password</label><br>
            <input type="password" class="form-control" name="password"><br>
            <input type="submit" class="btn btn-success my-2" value="Se connecter" name="connect">
        </form>
    </div>
            

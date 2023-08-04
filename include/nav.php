<?php 
    session_start();
    $connected = false;
    if(isset($_SESSION['user'])){
        $connected = true;
    };
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand " href="admin.php"><i class="fa fa-shop"></i> E-SOUK</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <?php
        //* recuperation du nom de la page actuelle:
        $current_page = $_SERVER['PHP_SELF'];
        // var_dump($current_page);
        

    ?>

    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item">
                <a class="nav-link <?php if($current_page == '/MVC/Mini-projet E-Commerce/index.php') echo 'active' ?>"  href="index.php" aria-current="page"><i class="fa-solid fa-house"></i> Accueil</a>
            </li>
            <?php 
                if($connected==true){
                    ?> 
                    <li class="nav-item">
                        <a class="nav-link <?php if($current_page == '/MVC/Mini-projet E-Commerce/listeCategories.php') echo 'active' ?>" href="listeCategories.php" aria-current="page" ><i class="fa fa-list"></i> Categories</a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link <?php if($current_page == '/MVC/Mini-projet E-Commerce/listeProduits.php') echo 'active' ?>" href="listeProduits.php" aria-current="page" ><i class="fa-solid fa-tag"></i> Produits</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link <?php if($current_page == '/MVC/Mini-projet E-Commerce/listeCommandes.php') echo 'active' ?>" href="listeCommandes.php" aria-current="page"><i class="fa-solid fa-box"></i> Commandes</a>
                    </li>  
                    <li class="nav-item">
                        <a class="nav-link" href="deconnection.php"><i class="fa-solid fa-right-from-bracket"></i> Deconnexion</a>
                    </li>  
                    <?php
                } else {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="connection.php">Connexion</a>
                    </li>  
                    <?php
                }
            ?>
        </ul>
    </div>
</nav>

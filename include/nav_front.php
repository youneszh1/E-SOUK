<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand " href="index.php"><i class="fa fa-shop"></i> E-SOUK</a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
            <li class="nav-item active">
                <a class="nav-link" href="index.php"><i class="fa fa-list"></i> Liste des categories</a>
            </li>
        </ul>
    </div>
    <?php
        $idUser = $_SESSION['user']['id'];
        if(empty($_SESSION['panier'][$idUser])){
            define('PRODUCTS_COUNT', 0);
        } else {
            define('PRODUCTS_COUNT', count($_SESSION['panier'][$idUser]));
        }

    ?>
    <a class="btn float-end" href="panier.php"><i class="fa-solid fa-cart-shopping"></i> Panier (<?php echo PRODUCTS_COUNT ?>)</a>
</nav>

<div >
    <?php 
        $idUser = $_SESSION['user']['id'];
        $qte = $_SESSION['panier'][$idUser][$idProduit] ?? 0;
        $btnLibelle = $qte == 0 ? '<i class="bi bi-cart-plus"></i>' : '<i class="bi bi-pencil-square"></i>';
        $afficherSupp = $qte == 0 ? "hidden" : "" ;

        if($idUser )
    ?>
    <form action="ajouter_panier.php" method="post" class="counter d-flex">
        <button onclick="return false" class="btn btn-primary mx-1 counter-minus">-</button>
        <input type="hidden" name="id" value="<?= $idProduit ?>">
        <input class="form-control" type="number" name="qte" id="qte" max="99"  value="<?= $qte ?>">
        <button onclick="return false" class="btn btn-primary mx-1 counter-plus">+</button><br>
        
        <button class="btn btn-success" type="submit" value="" name="ajouter"><?= $btnLibelle ?></button>
        <button onclick="return confirm('Voulez-vous vraiment supprimer ce produit?')" formaction="supprimer_panier.php" class="btn btn-danger mx-1" type="submit" <?= $afficherSupp ?> name="supprimer"><i class="bi bi-trash3"></i></button>
    </form>
    
</div>


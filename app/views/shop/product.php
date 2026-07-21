<?php require_once(__DIR__ . '/../../../includes/header.php');  ?>


<!-- BANNER -->
<div class="page-heading" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-content">
                    <h2><?php echo htmlspecialchars($produit['name'] ?? 'Produit'); ?></h2>
                    <span>Détail du produit</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PRODUIT -->
<section class="section" id="product">
    <div class="container">
        <div class="row">

            <!-- IMAGE -->
            <div class="col-lg-8">
                <div class="left-images">
                    <img src="<?= BASE_URL ?>/assets/images/<?php echo htmlspecialchars($produit['image'] ?? 'default.jpg'); ?>" alt="" style="max-width:400px;">
                </div>
            </div>

            <!-- INFOS -->
            <div class="col-lg-4">
                <div class="right-content">

                    <h4><?php echo htmlspecialchars($produit['name'] ?? 'Nom produit'); ?></h4>

                    <span class="price">
                        <?php echo number_format($produit['price'] ?? 0, 2, ',', ' '); ?> €
                    </span>

                    <ul class="stars">
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                        <li><i class="fa fa-star"></i></li>
                    </ul>

                    <span>
                        <?php echo htmlspecialchars($produit['description'] ?? ''); ?>
                    </span>


                    <!-- FORM -->
                    <form method="POST" style="margin-top:20px;">

                        <div class="quantity-content">
                            <div class="left-content">
                                <h6>Quantité</h6>
                            </div>

                            <div class="right-content">
                                <div class="quantity buttons_added">
                                    <input type="button" value="-" class="minus" style="color:#000;">

                                    <input type="number"
                                           step="1"
                                           min="1"
                                           name="quantite"
                                           value="1"
                                           class="input-text qty text" style="color:#000;">

                                    <input type="button" value="+" class="plus" style="color:#000;">
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="produit_id" value="<?php echo $produit['id']; ?>">

                        <div class="total" style="margin-top:20px;">
                            <div class="main-border-button" style="color:#000;">
                                <button type="submit" style="background:none; border:none;" >
                                    Ajouter au panier
                                </button>
                            </div>
                        </div>

                    </form>

                    <?php /* if ($_SERVER['REQUEST_METHOD'] === 'POST' && $produit['id'] > 0): ?>
                        <p style="color:green; margin-top:10px;">
                            Produit ajouté au panier ✅
                        </p>
                    <?php endif; */ ?>

                </div>
            </div>

        </div> <!-- row -->
    </div> <!-- container -->
</section>

<!-- SCRIPT + / - -->
<script>
document.querySelector('.plus')?.addEventListener('click', function() {
    let input = document.querySelector('.qty');
    input.value = parseInt(input.value) + 1;
});

document.querySelector('.minus')?.addEventListener('click', function() {
    let input = document.querySelector('.qty');
    if (input.value > 1) {
        input.value = parseInt(input.value) - 1;
    }
});
</script>

<?php require_once(__DIR__ . '/../../../includes/footer.php');  ?>
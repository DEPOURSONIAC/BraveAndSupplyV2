<?php include(INCLUDE_PATH . "/header.php"); ?>

<main class="pt-5">

<!-- BANNER -->
<div class="bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">

                <h2 class="fw-bold">
                    <?= htmlspecialchars($product['name'] ?? 'Produit') ?>
                </h2>

                <p class="text-muted mb-0">
                    Détail du produit
                </p>

            </div>
        </div>
    </div>
</div>

<!-- MESSAGE PANIER -->
<?php if (isset($_GET['OK'])): ?>

    <div class="container mt-4">

        <?php if ($_GET['OK'] === 'TRUE'): ?>

            <div class="alert alert-success text-center mb-0" role="alert">
                Le produit a bien été ajouté au panier.
            </div>

        <?php elseif ($_GET['OK'] === 'FALSE'): ?>

            <div class="alert alert-danger text-center mb-0" role="alert">
                Une erreur est survenue lors de l'ajout au panier.
            </div>

        <?php endif; ?>

    </div>

<?php endif; ?>


<!-- PRODUIT -->
<section class="py-5" id="product">

    <div class="container">

        <div class="row align-items-start g-5">


            <!-- IMAGE PRODUIT -->
            <div class="col-lg-7">

                <div class="text-center">

                    <img src="<?= BASE_URL ?>assets/images/products/<?= htmlspecialchars($product['image'] ?? 'default.jpg') ?>"  class="img-fluid rounded" alt="<?= htmlspecialchars($product['name'] ?? 'Produit') ?>">

                </div>

            </div>



            <!-- INFORMATIONS PRODUIT -->
            <div class="col-lg-5">

                <div>

                    <h1 class="fw-bold mb-3">
                        <?= htmlspecialchars($product['name'] ?? 'Nom produit') ?>
                    </h1>


                    <div class="mb-3">

                        <span class="fs-3 fw-bold">
                            <?= number_format($product['price'] ?? 0, 2, ',', ' ') ?> €
                        </span>

                    </div>



                    <!-- NOTES -->
                    <div class="mb-4 text-warning">

                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>

                    </div>



                    <!-- DESCRIPTION -->
                    <p class="text-secondary mb-4">

                        <?= htmlspecialchars($product['description'] ?? '') ?>

                    </p>



                <!-- PANIER -->
                <form action="<?= BASE_URL ?>?action=addToCart" method="POST">

                    <div class="mb-4">
                        <label for="quantity" class="form-label fw-bold">
                            Quantité
                        </label>

                        <input type="number" name="quantity" id="quantity" value="1" min="1" max="<?= (int) $product['stock'] ?>" class="form-control" required>
                    </div>

                    <input type="hidden" name="product_id" value="<?= (int) $product['id'] ?>">

                    <button type="submit" class="btn btn-dark w-100 py-3">
                        <i class="fa fa-shopping-cart me-2"></i>
                        Ajouter au panier
                    </button>

                </form>

                <!-- LISTES -->
                <div class="border-top mt-4 pt-4">

                    <h5 class="fw-bold mb-3">
                        Ajouter à une liste
                    </h5>

                    <?php if (!empty($lists)): ?>

                        <?php foreach ($lists as $list): ?>

                            <form action="<?= BASE_URL ?>?action=addToList" method="POST" class="add-to-list-form mb-2">

                                <input type="hidden" name="product_id" value="<?= (int) $product['id'] ?>">

                                <input type="hidden" name="list_id" value="<?= (int) $list['id'] ?>">

                                <button type="submit" class="btn btn-outline-dark w-100">
                                    Ajouter à << <?= htmlspecialchars($list['name'], ENT_QUOTES, 'UTF-8') ?> >>
                                </button>

                            </form>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <p class="text-muted mb-0">
                            Vous n'avez pas encore créé de liste.
                        </p>

                    <?php endif; ?>

                </div>

                    <!-- RETOUR -->
                    <a  href="<?= BASE_URL ?>?action=catalogue" class="btn btn-outline-dark w-100 mt-3 py-3">
                        Retour au catalogue
                    </a>

                    <!-- INFORMATIONS -->
                    <div class="border-top mt-5 pt-4">

                        <p class="mb-2">

                            <strong>Référence :</strong>
                                #<?= $product['id'] ?>

                        </p>

                        <p class="mb-0">

                            <strong>En stock :</strong>

                            <span class="text-success"> <?= $product['stock'] ?> </span>

                        </p>


                    </div>


                </div>


            </div>

        

        </div>


    </div>


</section>


</main>


<?php include(INCLUDE_PATH . "/footer.php"); ?>
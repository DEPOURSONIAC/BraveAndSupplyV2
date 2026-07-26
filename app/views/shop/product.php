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


<!-- PRODUIT -->
<section class="py-5" id="product">

    <div class="container">

        <div class="row align-items-start g-5">


            <!-- IMAGE PRODUIT -->
            <div class="col-lg-7">

                <div class="text-center">

                    <img 
                        src="<?= BASE_URL ?>assets/images/products/<?= htmlspecialchars($product['image'] ?? 'default.jpg') ?>"
                        class="img-fluid rounded"
                        alt="<?= htmlspecialchars($product['name'] ?? 'Produit') ?>"
                    >

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
                    <form action="<?= BASE_URL ?>?action=add&id=<?= $product['id'] ?>" method="POST">


                        <div class="mb-4">

                            <label class="form-label fw-bold">
                                Quantité
                            </label>


                            <input 
                                type="number"
                                name="quantite"
                                value="1"
                                min="1"
                                class="form-control"
                            >

                        </div>



                        <input 
                            type="hidden"
                            name="produit_id"
                            value="<?= $product['id'] ?>"
                        >



                        <button 
                            type="submit"
                            class="btn btn-dark w-100 py-3">

                            <i class="fa fa-shopping-cart me-2"></i>
                            Ajouter au panier

                        </button>


                    </form>



                    <!-- RETOUR -->
                    <a 
                        href="<?= BASE_URL ?>?action=catalogue"
                        class="btn btn-outline-dark w-100 mt-3 py-3">

                        Retour au catalogue

                    </a>



                    <!-- INFORMATIONS -->
                    <div class="border-top mt-5 pt-4">


                        <p class="mb-2">

                            <strong>Référence :</strong>
                            #<?= $product['id'] ?>

                        </p>



                        <p class="mb-0">

                            <strong>Disponibilité :</strong>

                            <span class="text-success">

                                En stock : <?= $product['stock'] ?>

                            </span>

                        </p>


                    </div>


                </div>


            </div>


        </div>


    </div>


</section>


</main>


<?php include(INCLUDE_PATH . "/footer.php"); ?>
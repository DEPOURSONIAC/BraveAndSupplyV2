<?php include( INCLUDE_PATH . "/header.php"); ?>

<main class="pt-5">
<!-- PRODUITS -->
<section class="ftco-section" id="catalogue">
  <div class="container">

    <!-- GRID -->
    <div class="row">
      <?php foreach ($products as $product): ?>

    <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
        <div class="product h-100">

            <!-- IMAGE -->
            <div class="img position-relative overflow-hidden">

                <!-- Overlay -->
                <div class="overlay d-flex justify-content-center align-items-center">
                    <a href="<?= BASE_URL ?>?action=product&id=<?= $product['id'] ?>" class="btn btn-light btn-sm">
                        Voir
                    </a>
                </div>

                <a href="<?= BASE_URL ?>?action=product&id=<?= $product['id'] ?>">
                    <img
                        src="<?= BASE_URL ?>assets/images/products/<?= htmlspecialchars($product['image']) ?>"
                        class="img-fluid w-100"
                        alt="<?= htmlspecialchars($product['name']) ?>">
                </a>

            </div>

            <!-- CONTENU -->
            <div class="text text-center p-3">

                <h5 class="mb-2">
                    <a href="<?= BASE_URL ?>?action=product&id=<?= $product['id'] ?>" class="text-decoration-none text-dark">
                        <?= htmlspecialchars($product['name']) ?>
                    </a>
                </h5>

                <span class="price d-block mb-3">
                    <?= number_format($product['price'], 2, ',', ' ') ?> €
                </span>

            </div>

        </div>
    </div>

<?php endforeach; ?>

    </div>

    <!-- PAGINATION 

    -->

  </div>
</section>
</main>
<?php include( INCLUDE_PATH . "/footer.php"); ?>
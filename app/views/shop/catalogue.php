<?php include(INCLUDE_PATH . "/header.php"); ?>

<main class="pt-5">
<!-- Banner -->
<div class="page-heading" id="top">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="inner-content">
                    <h2>Nos Produits</h2>
                    <span>Découvrez notre catalogue</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Products Area -->
<section class="section" id="products">

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Nos Produits</h2>
                    <span>Tous les produits disponibles</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">

            <?php foreach ($products as $product): ?>

                <div class="col-lg-4">
                    <div class="item">

                        <div class="thumb ratio ratio-4x3">

                            <div class="hover-content">
                                <ul>
                                    <li>
                                        <a href="<?= BASE_URL ?>?action=product&id=<?= $product['id'] ?>">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?= BASE_URL ?>?action=favorite&id=<?= $product['id'] ?>">
                                            <i class="fa fa-star"></i>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="<?= BASE_URL ?>?action=add&id=<?= $product['id'] ?>">
                                            <i class="fa fa-shopping-cart"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <a href="<?= BASE_URL ?>?action=product&id=<?= $product['id'] ?>">
                                <img
                                    src="<?= BASE_URL ?>assets/images/products/<?= htmlspecialchars($product['image']) ?>"
                                    id="imageProduct"
                                    alt="<?= htmlspecialchars($product['name']) ?>">
                            </a>

                        </div>

                        <div class="down-content">
                            <h4>
                                <a href="<?= BASE_URL ?>?action=product&id=<?= $product['id'] ?>">
                                    <?= htmlspecialchars($product['name']) ?>
                                </a>
                            </h4>

                            <span>
                                <?= number_format($product['price'], 2, ',', ' ') ?> €
                            </span>
                        </div>

                    </div>
                </div>

            <?php endforeach; ?>

        </div>

        <!-- A faire plus tard-->
        <!--
        <div class="col-lg-12">
            <div class="pagination">
                <ul>
                    <li><a href="#">1</a></li>
                    <li class="active"><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                </ul>
            </div>
        </div>
        -->

    </div>

</section>
</main>
<?php include(INCLUDE_PATH . "/footer.php"); ?>
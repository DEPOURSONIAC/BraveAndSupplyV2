<?php require_once INCLUDE_PATH . '/header.php'; ?>

<!-- ***** Bannière principale - Début ***** -->
<div class="main-banner" id="top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6">
                <div class="left-content">
                    <div class="thumb">
                        <div class="inner-content">
                            <h4>Brave & Supply — Maison Parisienne</h4>
                            <span>Costumes d’exception en matières 100% naturelles</span>
                            <div class="main-border-button">
                                <a href="?action=home">Acheter maintenant</a>
                            </div>
                        </div>
                        <img src="<?= BASE_URL ?>/assets/images/left-banner-image.jpg" alt="">
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="right-content">
                    <div class="row">

                        <div class="col-lg-6">
                            <div class="right-first-image">
                                <div class="thumb">
                                    <div class="inner-content">
                                        <h4>Femmes</h4>
                                        <span>Élégance naturelle & coupes contemporaines</span>
                                    </div>
                                    <div class="hover-content">
                                        <div class="inner">
                                            <h4>Femmes</h4>
                                            <p>Découvrez des pièces raffinées conçues à partir de matières naturelles, alliant confort, modernité et savoir-faire parisien.</p>
                                            <div class="main-border-button">
                                                <a href="?action=categorie&&categoryId=2">Découvrir</a>
                                            </div>
                                        </div>
                                    </div>
                                    <img src="<?= BASE_URL ?>/assets/images/baner-right-image-01.jpg">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="right-first-image">
                                <div class="thumb">
                                    <div class="inner-content">
                                        <h4>Hommes</h4>
                                        <span>Costumes intemporels & matières nobles</span>
                                    </div>
                                    <div class="hover-content">
                                        <div class="inner">
                                            <h4>Hommes</h4>
                                            <p>Explorez notre collection de costumes haut de gamme, confectionnés en laine, lin et coton pour une élégance durable.</p>
                                            <div class="main-border-button">
                                                <a href="?action=categorie&&categoryId=1">Découvrir</a>
                                            </div>
                                        </div>
                                    </div>
                                    <img src="<?= BASE_URL ?>/assets/images/baner-right-image-02.jpg">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="right-first-image">
                                <div class="thumb">
                                    <div class="inner-content">
                                       <h4>Sur mesure</h4>
                                        <span>Une élégance pensée pour vous</span>
                                    </div>
                                    <div class="hover-content">
                                        <div class="inner">
                                            <h4>Enfants</h4>
                                            <p>Créez un costume unique, adapté à votre silhouette et confectionné dans des matières naturelles d’exception.</p>
                                            <div class="main-border-button">
                                                <a href="?action=categorie&&categoryId=3">Découvrir</a>
                                            </div>
                                        </div>
                                    </div>
                                    <img src="<?= BASE_URL ?>/assets/images/baner-right-image-03.jpg">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="right-first-image">
                                <div class="thumb">
                                    <div class="inner-content">
                                        <h4>Accessoires</h4>
                                        <span>Détails raffinés & finitions haut de gamme</span>
                                    </div>
                                    <div class="hover-content">
                                        <div class="inner">
                                            <h4>Accessoires</h4>
                                            <p>Complétez votre tenue avec nos accessoires conçus à partir de matériaux nobles et durables.</p>
                                            <div class="main-border-button">
                                                <a href="?action=categorie&&categoryId=4">Découvrir</a>
                                            </div>
                                        </div>
                                    </div>
                                    <img src="<?= BASE_URL ?>/assets/images/baner-right-image-04.jpg">
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Bannière principale - Fin ***** -->
<!-- ***** Section Hommes - Début ***** -->
<section class="section" class="section men-section" id="men">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2>Collection Homme</h2>
                    <span>Des costumes conçus à Paris à partir de matières naturelles, pour une allure élégante et responsable.</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="men-item-carousel">
                    <div class="owl-men-item owl-carousel">

                        <?php foreach ($hommes as $produit): ?>
                        <div class="item">

                            <div class="thumb ratio ratio-4x3">

                                <div class="hover-content">
                                    <ul>
                                        <li>
                                            <a href="?action=product&id=<?= $produit['id'] ?>">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="?action=favorite&id=<?= $produit['id'] ?>">
                                                <i class="fa fa-star"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="?action=add&id=<?= $produit['id'] ?>">
                                                <i class="fa fa-shopping-cart"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                                <img src="<?= BASE_URL ?>/assets/images/<?= htmlspecialchars($produit['image']) ?>"
                                        style="width:100%; height:320px; object-fit:cover; display:block;"
                                        alt="<?= htmlspecialchars($produit['name']) ?>">

                            </div>

                            <div class="down-content">
                                <h4><?= htmlspecialchars($produit['name']) ?></h4>
                                <span><?= number_format($produit['price'], 2, ',', ' ') ?> €</span>
                            </div>

                        </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Section Hommes - Fin ***** -->


<!-- ***** Section Femmes - Début ***** -->
<section class="section" id="women">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2>Collection Femme</h2>
                    <span>Des silhouettes modernes et raffinées, pensées pour sublimer chaque mouvement.</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="women-item-carousel">
                    <div class="owl-women-item owl-carousel">
                        <?php foreach ($femmes as $produit): ?>
                        <div class="item">
                            <div class="thumb">
                                <div class="hover-content">
                                    <ul>
                                        <li><a href="?action=product&id=<?= $produit['id'] ?>"><i class="fa fa-eye"></i></a></li>
                                        <li><a href="?action=favorite&id=<?= $produit['id'] ?>"><i class="fa fa-star"></i></a></li>
                                        <li><a href="?action=add&id=<?= $produit['id'] ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <img src="<?= BASE_URL ?>/assets/images/<?= htmlspecialchars($produit['image']) ?>"
                                        style="width:100%; height:320px; object-fit:cover; display:block;"
                                        alt="<?= htmlspecialchars($produit['name']) ?>">
                            </div>
                            <div class="down-content">
                                <h4><?= htmlspecialchars($produit['name']) ?></h4>
                                <span><?= number_format($produit['price'], 2, ',', ' ') ?> €</span>
                            </div>
                        </div>

                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Section Femmes - Fin ***** -->
 <!-- ***** Section Enfants - Début ***** -->
<section class="section" id="kids">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2>Notre Savoir-Faire</h2>
                    <span>Chaque pièce est conçue avec exigence, dans le respect des matières et des traditions.</span>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="women-item-carousel">
                    <div class="owl-women-item owl-carousel">
                        <?php foreach ($kids as $produit): ?>
                        <div class="item">
                            <div class="thumb">
                                <div class="hover-content">
                                    <ul>
                                        <li><a href="?action=product&id=<?= $produit['id'] ?>"><i class="fa fa-eye"></i></a></li>
                                        <li><a href="?action=favorite&id=<?= $produit['id'] ?>"><i class="fa fa-star"></i></a></li>
                                        <li><a href="?action=add&id=<?= $produit['id'] ?>"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                 <img src="<?= BASE_URL ?>/assets/images/<?= htmlspecialchars($produit['image']) ?>"
                                        style="width:100%; height:320px; object-fit:cover; display:block;"
                                        alt="<?= htmlspecialchars($produit['name']) ?>">
                            </div>
                            <div class="down-content">
                                <h4><?= htmlspecialchars($produit['name']) ?></h4>
                                <span><?= number_format($produit['price'], 2, ',', ' ') ?> €</span>
                            </div>
                        </div>

                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Section Enfants - Fin ***** -->


<!-- ***** Section Explorer - Début ***** -->
<section class="section" id="explore">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="left-content">
                    <h2>L’élégance responsable</h2>
                    <span>Chez Brave & Supply, nous sélectionnons uniquement des matières naturelles pour concevoir des costumes durables et intemporels.</span>

                    <div class="quote">
                        <i class="fa fa-quote-left"></i>
                        <p>“L’élégance commence par le respect des matières.”</p>
                    </div>

                    <p>Nos pièces sont imaginées à Paris et confectionnées avec exigence, en privilégiant des circuits responsables et des tissus d’exception.</p>

                    <p>Chaque costume est pensé pour durer, traverser les saisons et accompagner chaque moment important de votre vie.</p>
                    <div class="main-border-button">
                        <a href="?action=catalogue">Découvrir plus</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="right-content">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="leather">
                                <h4>Sacs en cuir</h4>
                                <span>Dernière collection</span>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="first-image">
                                <img src="<?= BASE_URL ?>/assets/images/explore-image-01.jpg" alt="">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="second-image">
                                <img src="<?= BASE_URL ?>/assets/images/explore-image-02.jpg" alt="">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="types">
                                <h4>Différents types</h4>
                                <span>Plus de 304 produits</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- ***** Section Explorer - Fin ***** -->

<!-- ***** Zone Réseaux Sociaux - Début ***** -->
<section class="section" id="social">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h2>Suivez notre univers</h2>
                    <span>Découvrez nos créations, inspirations et coulisses de fabrication.</span>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row images">
            <div class="col-2">
                <div class="thumb">
                    <div class="icon">
                        <a href="http://instagram.com">
                            <h6>Mode</h6>
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>
                    <img src="<?= BASE_URL ?>/assets/images/instagram-01.jpg" alt="">
                </div>
            </div>
            <div class="col-2">
                <div class="thumb">
                    <div class="icon">
                        <a href="http://instagram.com">
                            <h6>Nouveautés</h6>
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>
                    <img src="<?= BASE_URL ?>/assets/images/instagram-02.jpg" alt="">
                </div>
            </div>
            <div class="col-2">
                <div class="thumb">
                    <div class="icon">
                        <a href="http://instagram.com">
                            <h6>Marque</h6>
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>
                    <img src="<?= BASE_URL ?>/assets/images/instagram-03.jpg" alt="">
                </div>
            </div>
            <div class="col-2">
                <div class="thumb">
                    <div class="icon">
                        <a href="http://instagram.com">
                            <h6>Maquillage</h6>
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>
                    <img src="<?= BASE_URL ?>/assets/images/instagram-04.jpg" alt="">
                </div>
            </div>
            <div class="col-2">
                <div class="thumb">
                    <div class="icon">
                        <a href="http://instagram.com">
                            <h6>Cuir</h6>
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>
                    <img src="<?= BASE_URL ?>/assets/images/instagram-05.jpg" alt="">
                </div>
            </div>
            <div class="col-2">
                <div class="thumb">
                    <div class="icon">
                        <a href="http://instagram.com">
                            <h6>Sacs</h6>
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>
                    <img src="<?= BASE_URL ?>/assets/images/instagram-06.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- ***** Zone Réseaux Sociaux - Fin ***** -->
<!-- ***** Zone d'abonnement - Début ***** -->
<div class="subscribe">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="section-heading">
                    <h2>En vous abonnant à notre newsletter, vous pouvez bénéficier de 30 % de réduction</h2>
                    <span>Le souci du détail est ce qui rend BraveAndSupply différent des autres magasins.</span>
                </div>
                <form id="subscribe" action="" method="get">
                    <div class="row">
                      <div class="col-lg-5">
                        <fieldset>
                          <input name="name" type="text" id="name" placeholder="Votre nom" required="">
                        </fieldset>
                      </div>
                      <div class="col-lg-5">
                        <fieldset>
                          <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*" placeholder="Votre adresse e-mail" required="">
                        </fieldset>
                      </div>
                      <div class="col-lg-2">
                        <fieldset>
                          <button type="submit" id="form-submit" class="main-dark-button">
                            <i class="fa fa-paper-plane"></i>
                          </button>
                        </fieldset>
                      </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-6">
                        <ul>
                            <li>Adresse :<br><span>Puteaux La Défense 92800 Paris</span></li>
                            <li>Téléphone :<br><span>+33 1 84 80 45 67</span></li>
                            <li>Adresse du studio :<br><span>Paris, France</span></li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul>
                            <li>Horaires de travail :<br><span>07:30 - 21:30 tous les jours</span></li>
                            <li>Email :<br><span>info@company.com</span></li>
                            <li>Réseaux sociaux :<br>
                                <span>
                                    <a href="#">Facebook</a>, 
                                    <a href="#">Instagram</a>, 
                                    <a href="#">LinkedIn</a>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Zone d'abonnement - Fin ***** -->
    

    <!-- jQuery -->
    <script src="<?= BASE_URL ?>/assets/js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="<?= BASE_URL ?>/assets/js/popper.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="<?= BASE_URL ?>assets/js/owl-carousel.js"></script>
    <script src="<?= BASE_URL ?>assets/js/accordions.js"></script>
    <script src="<?= BASE_URL ?>assets/js/datepicker.js"></script>
    <script src="<?= BASE_URL ?>assets/js/scrollreveal.min.js"></script>
    <script src="<?= BASE_URL ?>assets/js/waypoints.min.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/jquery.counterup.min.js"></script>
    <script src="<?= BASE_URL ?>/assets/js/imgfix.min.js"></script> 
    <script src="<?= BASE_URL ?>assets/js/slick.js"></script> 
    <script src="<?= BASE_URL ?>assets/js/lightbox.js"></script> 
    <script src="<?= BASE_URL ?>/assets/js/isotope.js"></script> 
    
    <!-- Global Init -->
    <script src="<?= BASE_URL ?>/assets/js/custom.js"></script>

    <script>

        $(function() {
            var selectedClass = "";
            $("p").click(function(){
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadeTo(50, 0.1);
                $("#portfolio div").not("."+selectedClass).fadeOut();
            setTimeout(function() {
              $("."+selectedClass).fadeIn();
              $("#portfolio").fadeTo(50, 1);
            }, 500);
                
            });
        });

    </script>

<?php require_once INCLUDE_PATH . '/footer.php'; ?>
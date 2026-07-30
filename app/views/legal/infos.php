<?php include( INCLUDE_PATH . "/header.php"); ?>

<main class="pt-5">

<!-- ***** Bannière de page - Début ***** -->
<div class="page-heading" id="top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading text-center">
                    <h2>Infos pratiques</h2>
                    <span>Contact, showroom, tailles et questions fréquentes.</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Bannière de page - Fin ***** -->

<!-- ***** Contact & showroom - Début ***** -->
<section class="section" id="contact-infos">
    <div class="container">
        <div class="row">

            <div class="col-lg-4">
                <div class="reglement-card">
                    <i class="fa fa-map-marker"></i>
                    <h4>Showroom</h4>
                    <p>12 avenue de la Défense<br>92800 Puteaux, France</p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="reglement-card">
                    <i class="fa fa-clock-o"></i>
                    <h4>Horaires</h4>
                    <p>Lundi au samedi<br>10h00 — 19h00</p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="reglement-card">
                    <i class="fa fa-phone"></i>
                    <h4>Contact</h4>
                    <p>+33 1 84 80 45 67<br>info@company.com</p>
                </div>
            </div>

        </div>
    </div>
</section>
<!-- ***** Contact & showroom - Fin ***** -->

<!-- ***** Guide des tailles - Début ***** -->
<section class="section" id="size-guide">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2>Guide des tailles</h2>
                    <span>Trouvez la coupe qui vous correspond.</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table size-table">
                        <thead>
                            <tr>
                                <th>Taille</th>
                                <th>Tour de poitrine (cm)</th>
                                <th>Tour de taille (cm)</th>
                                <th>Longueur de manche (cm)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td>S</td><td>92 – 96</td><td>76 – 80</td><td>63</td></tr>
                            <tr><td>M</td><td>97 – 101</td><td>81 – 85</td><td>64</td></tr>
                            <tr><td>L</td><td>102 – 106</td><td>86 – 90</td><td>65</td></tr>
                            <tr><td>XL</td><td>107 – 112</td><td>91 – 96</td><td>66</td></tr>
                        </tbody>
                    </table>
                </div>
                <p>Une hésitation entre deux tailles ? Nos conseillers en showroom réalisent des retouches sur mesure gratuites pour toute pièce achetée en boutique.</p>
            </div>
        </div>
    </div>
</section>
<!-- ***** Guide des tailles - Fin ***** -->

<!-- ***** FAQ - Début ***** -->
<section class="section" id="faq">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-heading">
                    <h2>Questions fréquentes</h2>
                    <span>Les réponses aux questions les plus posées par nos clients.</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-9">

                <div class="accordion" id="faqAccordion">

                    <div class="faq-item">
                        <h4 class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq1">
                            Combien de temps prend une commande sur mesure ?
                        </h4>
                        <div id="faq1" class="collapse faq-answer" data-bs-parent="#faqAccordion">
                            <p>Comptez en moyenne 3 à 4 semaines entre la prise de mesures et la livraison, selon la complexité du modèle et le tissu choisi.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <h4 class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq2">
                            Puis-je modifier ma commande après validation ?
                        </h4>
                        <div id="faq2" class="collapse faq-answer" data-bs-parent="#faqAccordion">
                            <p>Toute modification est possible dans l'heure suivant la commande en contactant notre service client. Passé ce délai, la commande est transmise à notre atelier.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <h4 class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq3">
                            Les tissus utilisés sont-ils vraiment 100 % naturels ?
                        </h4>
                        <div id="faq3" class="collapse faq-answer" data-bs-parent="#faqAccordion">
                            <p>Oui, l'ensemble de nos costumes est confectionné en laine, lin ou coton, issus de filatures sélectionnées pour leur savoir-faire et leurs pratiques responsables.</p>
                        </div>
                    </div>

                    <div class="faq-item">
                        <h4 class="faq-question" data-bs-toggle="collapse" data-bs-target="#faq4">
                            Comment suivre ma commande ?
                        </h4>
                        <div id="faq4" class="collapse faq-answer" data-bs-parent="#faqAccordion">
                            <p>Un lien de suivi vous est envoyé par email dès l'expédition. Vous pouvez également consulter le statut de votre commande dans votre espace client.</p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
<!-- ***** FAQ - Fin ***** -->

</main>

<?php include( INCLUDE_PATH . "/footer.php"); ?>

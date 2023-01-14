<?php
//TITULO PÁGINA
$page_title = 'Sobre -';

//HTML HEAD
include('./components/page-head.php');
?>

<body class="d-flex flex-column h-100">
    <main class="flex-shrink-0">
        <!-- Menu Topo -->
        <?php include('./components/landing/topnav-landing.php'); ?>

        <!-- Banner -->
        <header id="banner" class="bg-primary bg-gradient py-5">
            <div class="container px-5">
                <div class="row gx-5 align-items-center justify-content-center">
                    <div class="col-lg-12 col-xl-12 col-xxl-12">
                        <div class="my-5 text-center text-xl-start">
                            <h1 class="display-5 fw-bolder text-white mb-2">Sobre</h1>
                            <p class="lead fw-normal text-white-50 mb-4">Dados sobre o projecto</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- INICIO CONTEUDO -->

        <!-- SOBRE APP (BREVE) -->
        <section class="py-5">
            <div class="container px-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xxl-6">
                        <div class="text-center my-5">
                            <h1 class="fw-bolder mb-3">Objectivo do projecto</h1>
                            <p class="lead fw-normal text-muted mb-4">Planear e desenvolver uma Web App orientada ao apoio cliente introduzindo paineis de funcionalidades com base num sistema de Ticketing integrando uma Knowledge Base que responde de forma automática perante o formulário de apoio preenchido pelo cliente.</p>
                            <a class="btn btn-primary btn-lg" href="#">Saber mais</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About section one-->
        <section id="know-more" class="py-5 bg-light" >
            <div class="container px-5 my-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-5"><img class="img-fluid rounded mb-5 mb-lg-0 logo" src="./assets/img/landing/details-1.png" alt="..." /></div>
                    <!-- <div class="col-lg-6 align-items-stretch logo" style="background-image: url(&quot;./assets/img/landing/details-1.png&quot;);">&nbsp;</div> -->
                    <div class="col-lg-7">
                        <h2 class="fw-bolder">Our founding</h2>
                        <p class="lead fw-normal text-muted mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto est, ut esse a labore aliquam beatae expedita. Blanditiis impedit numquam libero molestiae et fugit cupiditate, quibusdam expedita, maiores eaque quisquam.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- About section two-->
        <section class="py-5">
            <div class="container px-5 my-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-5 order-first order-lg-last"><img class="img-fluid rounded mb-5 mb-lg-0" src="./assets/img/landing/hero-img.png" alt="..." /></div>
                    <div class="col-lg-7">
                        <h2 class="fw-bolder">Growth &amp; beyond</h2>
                        <p class="lead fw-normal text-muted mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto est, ut esse a labore aliquam beatae expedita. Blanditiis impedit numquam libero molestiae et fugit cupiditate, quibusdam expedita, maiores eaque quisquam.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- FIM CONTEUDO -->
    </main>

    <!-- Footer -->
    <?php include('./components/landing/footer-landing.php'); ?>

    <!-- PAGE BOTTOM -->
    <?php include('./components/page-bottom.php'); ?>
</body>

</html>
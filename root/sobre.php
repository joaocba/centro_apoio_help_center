<?php
//TITULO PÁGINA
$page_title = 'Sobre -';

//HTML HEAD
include('./components/page-head.php');

//LANGS
include('./components/landing/lang/settings.php');
?>

<body class="d-flex flex-column h-100">
<main class="flex-shrink-0">
        <!-- Animação Preloader -->
        <div id="loading">
                <div id="loading-image" class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
        </div>

        <!-- Menu Topo -->
        <?php include('./components/landing/topnav-landing.php'); ?>

        <!-- Banner -->
        <header id="banner" class="bg-primary bg-gradient py-5">
            <div class="container px-5">
                <div class="row gx-5 align-items-center justify-content-center">
                    <div class="col-lg-12 col-xl-12 col-xxl-12">
                        <div class="my-5 text-center text-xl-start">
                            <h1 class="display-5 fw-bolder text-white mb-2"><?php echo $lang['s_banner_title']; ?></h1>
                            <p class="lead fw-normal text-white-50 mb-4"><?php echo $lang['s_banner_subtitle']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- INICIO CONTEUDO -->

        <!-- FINALIDADE -->
        <section class="py-5">
            <div class="container px-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xxl-6">
                        <div class="text-center my-5">
                            <h1 class="fw-bolder mb-3"><?php echo $lang['s_finalidade_title']; ?></h1>
                            <p class="lead fw-normal text-muted mb-4"><?php echo $lang['s_finalidade_desc']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SOBRE PARTE 1 -->
        <section id="know-more" class="py-5 bg-light" >
            <div class="container px-5 my-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-5"><img class="img-fluid rounded mb-5 mb-lg-0 logo" src="./assets/img/landing/details-1.png" alt="..." /></div>
                    <div class="col-lg-7">
                        <h2 class="fw-bolder"><?php echo $lang['s_sobre_title1']; ?></h2>
                        <p class="lead fw-normal text-muted mb-0"><?php echo $lang['s_sobre_desc1']; ?></p>
                    </div>
                </div>
            </div>
        </section>
        <!-- SOBRE PARTE 2-->
        <section class="py-5">
            <div class="container px-5 my-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-5 order-first order-lg-last"><img class="img-fluid rounded mb-5 mb-lg-0" src="./assets/img/landing/hero-img.png" alt="..." /></div>
                    <div class="col-lg-7">
                        <h2 class="fw-bolder"><?php echo $lang['s_sobre_title1']; ?></h2>
                        <p class="lead fw-normal text-muted mb-0"><?php echo $lang['s_sobre_desc1']; ?></p>
                    </div>
                </div>
            </div>
        </section>

        <!-- FIM CONTEUDO -->

        <!-- Scroll To Top -->
        <?php include('components/scroll-to-top.php'); ?>
    </main>

    <!-- Footer -->
    <?php include('./components/landing/footer-landing.php'); ?>

    <!-- PAGE BOTTOM -->
    <?php include('./components/page-bottom.php'); ?>

    <!-- Page Preloader -->
    <?php include('./components/page-preloader.php'); ?>

</body>

</html>
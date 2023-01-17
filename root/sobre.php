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
        <!-- Menu Topo -->
        <?php include('./components/landing/topnav-landing.php'); ?>

        <!-- Banner -->
        <header id="banner" class="bg-primary bg-gradient py-5">
            <div class="container px-5">
                <div class="row gx-5 align-items-center justify-content-center">
                    <div class="col-lg-12 col-xl-12 col-xxl-12">
                        <div class="my-5 text-center text-xl-start">
                            <h1 class="display-5 fw-bolder text-white mb-2"><?php echo $lang['s_banner_title']; ?></h1>
                            <p class="lead fw-normal text-white-50 mb-4"><?php echo $lang['s-banner_subtitle']; ?></p>
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
                            <h1 class="fw-bolder mb-3"><?php echo $lang['s_finalidade_title']; ?></h1>
                            <p class="lead fw-normal text-muted mb-4"><?php echo $lang['s_finalidade_desc']; ?></p>
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
                        <h2 class="fw-bolder">Objectivo Do Projecto</h2>
                        <p class="lead fw-normal text-muted mb-0">Este Projeto teve como objetivo, dar apoio a empresas através de uma aplicação web. De modo a ajudar a equipa de IT a fazer toda a gestão de problemas existentes na empresa que por vezes vem de diversos meios. O grande objetivo é centralizar toda a informação em uma só plataforma.</p>
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
                        <h2 class="fw-bolder">Web App &amp; Funcionalidades</h2>
                        <p class="lead fw-normal text-muted mb-0">Esta Web App esta desenhada para ter três modos de gestão, como Administradores, Agentes e Clientes. Introduziu-se painéis de funcionalidades com base num sistema de Tickting integrando, uma Knowledge Base que responde de forma automática perante o formulário de apoio preenchido pelo cliente.</p>
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
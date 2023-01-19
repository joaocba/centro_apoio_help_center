<?php
//TITULO PÁGINA
$page_title = 'Politica de Privacidade -';

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

        <!-- INICIO CONTEUDO -->

        <!-- TERMOS -->
        <section class="py-5">
            <div class="container px-0 px-lg-5">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="m-5" style="text-align: justify; text-justify: inter-word;">
                            <?php echo $lang['termos_utilizacao']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FIM CONTEUDO -->

        <!-- Scroll To Top -->
        <?php include('components/scroll-to-top.php'); ?>
    </main>

    <!-- Footer -->
    <!-- FOOTER BOTTOM -->
    <footer id="footer-bottom" class="bg-dark py-4 mt-auto clearfix">
        <div class="container">
            <div class="row align-items-center justify-content-between flex-column flex-sm-row">
                <div class="col-auto">
                    <div class="small m-0 text-white">&copy; Copyright 2022-<script>document.write(new Date().getFullYear())</script>, Centro de Apoio</div>
                </div>
                <div class="col-auto">
                    <a class="link-light small" href="./privacidade.php<?= $_SESSION['lang_set'] ?>"><?php echo $lang['footer_privacy']; ?></a>
                    <span class="text-white mx-1">&middot;</span>
                    <a class="link-light small" href="./termos.php<?= $_SESSION['lang_set'] ?>"><?php echo $lang['footer_terms']; ?></a>
                    <span class="text-white mx-1">&middot;</span>
                    <a class="link-light small" href="contacto.php<?= $_SESSION['lang_set'] ?>"><?php echo $lang['footer_contacto']; ?></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- PAGE BOTTOM -->
    <?php include('./components/page-bottom.php'); ?>
</body>

</html>
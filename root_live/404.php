<?php
//TITULO PÁGINA
$page_title = 'Página não encontrada -';

//HTML HEAD
include('./components/page-head.php');

//LANGS
include('./components/landing/lang/settings.php');
?>

<body>
    <div id="layoutError">
        <div id="layoutError_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="text-center mt-4">
                                <h1 class="display-1">404</h1>
                                <p class="lead">Página não encontrada.</p>
                                <a href="../index.php">
                                    <i class="fas fa-arrow-left me-1"></i>
                                    Voltar à página inicial
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- PAGE BOTTOM -->
    <?php include('./components/page-bottom.php'); ?>

    <!-- Page Preloader -->
    <?php include('./components/page-preloader.php'); ?>

</body>

</html>
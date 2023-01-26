<?php
//TITULO PÁGINA
$page_title = 'Blog -';

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
                            <h1 class="display-5 fw-bolder text-white mb-2"><?php echo $lang['b_banner_title']; ?></h1>
                            <p class="lead fw-normal text-white-50 mb-4"><?php echo $lang['b_banner_subtitle']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- INICIO CONTEUDO -->

        <!-- BLOG HEADER -->
        <section id="blog-featured" class="py-5">
            <div class="container px-5">
                <h1 class="fw-bolder fs-5 mb-4">Blog Centro de Apoio</h1>
                <div class="card border-0 shadow rounded-3 overflow-hidden">
                    <div class="card-body p-0">
                        <div class="row gx-0">
                            <div class="col-lg-6 col-xl-5 py-lg-5">
                                <div class="p-4 p-md-5">
                                    <div class="badge bg-primary bg-gradient rounded-pill mb-2"><?php echo $lang['b_header_badge']; ?></div>
                                    <div class="h2 fw-bolder"><?php echo $lang['b_header_title']; ?></div>
                                    <p><?php echo $lang['b_header_desc']; ?></p>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-7">
                                <div class="bg-featured-blog p-3 rounded-3"><iframe width="100%" height="100%" style="border-radius:10px;" src="https://www.youtube.com/embed/m_kD9-JVWm4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5 bg-light">
            <div class="container px-5">
                <div class="row gx-5">
                <div class="col-xl-8">
                        <h2 class="fw-bolder fs-5 mb-4"><?php echo $lang['b_novidades_title']; ?></h2>
                        <div class="mb-4">
                            <div class="small text-muted"><?php echo $lang['b_novidades_date1']; ?></div>
                            <a class="link-dark" href="#!">
                                <h3><?php echo $lang['b_novidades_subtitle1']; ?></h3>
                            </a>
                        </div>
                        <div class="mb-5">
                            <div class="small text-muted"><?php echo $lang['b_novidades_date2']; ?></div>
                            <a class="link-dark" href="#!">
                                <h3><?php echo $lang['b_novidades_subtitle2']; ?></h3>
                            </a>
                        </div>
                        <div class="mb-5">
                            <div class="small text-muted"><?php echo $lang['b_novidades_date3']; ?></div>
                            <a class="link-dark" href="#!">
                                <h3><?php echo $lang['b_novidades_subtitle3']; ?></h3>
                            </a>
                        </div>
                        <div class="text-end mb-5 mb-xl-0">
                            <a class="text-decoration-none" href="#!">
                                Ler mais 
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card border-0 h-100">
                            <div class="card-body p-4">
                                <div class="d-flex h-100 align-items-center justify-content-center">
                                    <div class="text-center">
                                        <div class="h6 fw-bolder"><?php echo $lang['b_novidades_questions']; ?></div>
                                        <p class="text-muted mb-4">
                                            <a class="btn btn-dark px-4" href="contacto.php<?= $_SESSION['lang_set'] ?>"><?php echo $lang['b_novidades_questions_link']; ?></a>
                                        </p>
                                        <div class="h6 fw-bolder"><?php echo $lang['b_novidades_follow']; ?></div>
                                        <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-twitter"></i></a>
                                        <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-facebook"></i></a>
                                        <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-linkedin"></i></a>
                                        <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-youtube"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- BLOG PREVIEW -->
        <section class="py-5">
            <div class="container px-5 my-5">
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6">
                        <div class="text-center">
                            <h2 class="fw-bolder"><?php echo $lang['h_blog_title']; ?></h2>
                            <p class="lead fw-normal text-muted mb-5"><?php echo $lang['h_blog_subtitle']; ?></p>
                        </div>
                    </div>
                </div>
                <div class="row gx-5">
                    <div class="col-lg-4 mb-5">
                        <div class="card h-100 shadow border-0">
                            <img class="card-img-top" src="./assets/img/landing/blog1.jpg" alt="..." />
                            <div class="card-body p-4">
                                <div class="badge bg-primary bg-gradient rounded-pill mb-2"><?php echo $lang['h_blog_badge1']; ?></div>
                                <a class="text-decoration-none link-dark stretched-link" href="#!">
                                    <h5 class="card-title mb-3"><?php echo $lang['h_blog_title1']; ?></h5>
                                </a>
                                <p class="card-text mb-0"><?php echo $lang['h_blog_desc1']; ?></p>
                            </div>
                            <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                <div class="d-flex align-items-end justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle me-3" src="https://dummyimage.com/40x40/ced4da/6c757d" alt="..." />
                                        <div class="small">
                                            <div class="fw-bold"><?php echo $lang['h_blog_author1']; ?></div>
                                            <div class="text-muted"><?php echo $lang['h_blog_date1']; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-5">
                        <div class="card h-100 shadow border-0">
                            <img class="card-img-top" src="./assets/img/landing/blog2.gif" alt="..." />
                            <div class="card-body p-4">
                                <div class="badge bg-primary bg-gradient rounded-pill mb-2"><?php echo $lang['h_blog_badge2']; ?></div>
                                <a class="text-decoration-none link-dark stretched-link" href="#!">
                                    <h5 class="card-title mb-3"><?php echo $lang['h_blog_title2']; ?></h5>
                                </a>
                                <p class="card-text mb-0"><?php echo $lang['h_blog_desc2']; ?></p>
                            </div>
                            <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                <div class="d-flex align-items-end justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle me-3" src="https://dummyimage.com/40x40/ced4da/6c757d" alt="..." />
                                        <div class="small">
                                            <div class="fw-bold"><?php echo $lang['h_blog_author2']; ?></div>
                                            <div class="text-muted"><?php echo $lang['h_blog_date2']; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-5">
                        <div class="card h-100 shadow border-0">
                            <img class="card-img-top" src="./assets/img/landing/blog3.png" alt="..." />
                            <div class="card-body p-4">
                                <div class="badge bg-primary bg-gradient rounded-pill mb-2"><?php echo $lang['h_blog_badge3']; ?></div>
                                <a class="text-decoration-none link-dark stretched-link" href="#!">
                                    <h5 class="card-title mb-3"><?php echo $lang['h_blog_title3']; ?></h5>
                                </a>
                                <p class="card-text mb-0"><?php echo $lang['h_blog_desc3']; ?></p>
                            </div>
                            <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                <div class="d-flex align-items-end justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle me-3" src="https://dummyimage.com/40x40/ced4da/6c757d" alt="..." />
                                        <div class="small">
                                            <div class="fw-bold"><?php echo $lang['h_blog_author3']; ?></div>
                                            <div class="text-muted"><?php echo $lang['h_blog_date3']; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-end mb-5 mb-xl-0">
                    <a class="text-decoration-none" href="#!">
                        <?php echo $lang['b_preview_showmore']; ?>
                        <i class="bi bi-arrow-right"></i>
                    </a>
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
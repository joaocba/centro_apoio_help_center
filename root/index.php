<?php
//TITULO PÁGINA
$page_title = '';

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
                    <div class="col-lg-8 col-xl-7 col-xxl-6">
                        <div class="my-5 text-center text-xl-start">
                            <h1 class="display-5 fw-bolder text-white mb-2"><?php echo $lang['h_banner_title']; ?></h1>
                            <p class="lead fw-normal text-white-50 mb-4"><?php echo $lang['h_banner_subtitle']; ?></p>
                            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                                <a class="btn btn-outline-light btn-lg px-4 me-sm-3" href="./login.php"><?php echo $lang['h_banner_link']; ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"><img class="img-fluid rounded-3 my-5 animated" src="./assets/img/landing/support-client.png" alt="apoio" /></div>
                </div>
            </div>
        </header>

        <!-- INICIO CONTEUDO -->

        <!-- SOBRE APP (BREVE) -->
        <section class="py-5 bg-light">
            <div class="container px-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xxl-6">
                        <div class="text-center my-5">
                            <h1 class="fw-bolder mb-3"><?php echo $lang['h_sobre_title']; ?></h1>
                            <p class="lead fw-normal text-muted mb-4"><?php echo $lang['h_sobre_desc']; ?></p>
                            <a class="btn btn-primary btn-lg" href="./sobre.php<?= $_SESSION['lang_set'] ?>"><?php echo $lang['h_sobre_link']; ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- TEAM -->
        <section class="py-5">
            <div class="container px-5 my-5">
                <div class="text-center">
                    <h2 class="fw-bolder"><?php echo $lang['h_team_title']; ?></h2>
                    <p class="lead fw-normal text-muted mb-5"><?php echo $lang['h_team_subtitle']; ?></p>
                </div>
                <div class="row gx-5 row-cols-1 row-cols-sm-2 row-cols-xl-4 justify-content-center">
                    <div class="col mb-5 mb-5 mb-xl-0">
                        <div class="text-center">
                            <img class="img-fluid rounded-circle mb-4 px-4" src="./assets/img/landing/profile_daniel.jpg" alt="..." />
                            <h5 class="fw-bolder">Daniel Pereira</h5>
                            <div class="fst-italic text-muted">Founder, Gestor de Projecto &amp; Developer</div>
                        </div>
                    </div>
                    <div class="col mb-5 mb-5 mb-xl-0">
                        <div class="text-center">
                            <img class="img-fluid rounded-circle mb-4 px-4" src="./assets/img/landing/profile_joao_cut.jpg" alt="..." />
                            <h5 class="fw-bolder">João Bacalhau</h5>
                            <div class="fst-italic text-muted">Co-Founder, Developer &amp; Web Designer</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- BRANDING -->
        <div id="branding-section" class="py-5 bg-light">
            <div class="container px-5 my-1">
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-3 col-md-3 col-sm-12 d-flex align-items-center justify-content-center">
                        <img class="img-fluid me-3" src="./assets/img/landing/branding-fordtrucks-sm.png" alt="Ford Trucks" />
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 d-flex align-items-center justify-content-center">
                        <img class="me-3" src="./assets/img/landing/branding-oneshop.png" alt="OneShop SA" />
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 d-flex align-items-center justify-content-center">
                        <img class="me-3" src="./assets/img/landing/branding-hydraplan.png" alt="HydraPlan SA" />
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-12 d-flex align-items-center justify-content-center">
                        <img class="me-3" src="./assets/img/landing/branding-man-sm.png" alt="MAN" />
                    </div>
                </div>
            </div>
        </div>

        <!-- FUNCIONALIDADES -->
        <section id="features" class="py-5">
            <div class="container px-5 my-5">
                <div class="text-center mb-5">
                    <h1 class="fw-bolder"><?php echo $lang['h_features_title']; ?></h1>
                    <p class="lead fw-normal text-muted mb-0"><?php echo $lang['h_features_subtitle']; ?></p>
                </div>
                <div class="row gx-5">
                    <div id="feature_image" class="col-lg-6 align-items-stretch order-1 order-lg-2 logo">&nbsp;</div>
                    <div class="col-lg-6 align-items-stretch order-2 order-lg-2">
                        <div class="row gx-5 row-cols-1 row-cols-md-2">
                            <div class="col mb-5 h-100">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body p-4">
                                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-ticket-detailed"></i></div>
                                        <h2 class="h5 fw-bold"><?php echo $lang['h_features_feature1_title']; ?></h2>
                                        <p class="mb-0"><?php echo $lang['h_features_feature1_subtitle']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-5 h-100">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body p-4">
                                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-person-rolodex"></i></div>
                                        <h2 class="h5 fw-bold"><?php echo $lang['h_features_feature2_title']; ?></h2>
                                        <p class="mb-0"><?php echo $lang['h_features_feature2_subtitle']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-5 mb-md-0 h-100">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body p-4 text-justify">
                                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-cpu"></i></div>
                                        <h2 class="h5 fw-bold"><?php echo $lang['h_features_feature3_title']; ?></h2>
                                        <p class="mb-0"><?php echo $lang['h_features_feature3_subtitle']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col h-100">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body p-4">
                                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-info-circle"></i></div>
                                        <h2 class="h5 fw-bold"><?php echo $lang['h_features_feature4_title']; ?></h2>
                                        <p class="mb-0"><?php echo $lang['h_features_feature4_subtitle']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ -->
        <section class="py-5 bg-light">
            <div class="container px-5 my-5">
                <div class="text-center mb-5">
                    <h1 class="fw-bolder"><?php echo $lang['h_faq_title']; ?></h1>
                    <p class="lead fw-normal text-muted mb-0"><?php echo $lang['h_faq_subtitle']; ?></p>
                </div>
                <div class="row gx-5">
                    <div class="col-xl-8">
                        <h2 class="fw-bolder mb-3"><?php echo $lang['h_faq_category']; ?></h2>
                        <div class="accordion mb-5" id="accordionExample">
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingOne"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"><?php echo $lang['h_faq_faq1_title']; ?></button></h3>
                                <div class="accordion-collapse collapse show" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <?php echo $lang['h_faq_faq1_desc']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingTwo"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo"><?php echo $lang['h_faq_faq2_title']; ?></button></h3>
                                <div class="accordion-collapse collapse" id="collapseTwo" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body"><?php echo $lang['h_faq_faq2_desc']; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingThree"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree"><?php echo $lang['h_faq_faq3_title']; ?></button></h3>
                                <div class="accordion-collapse collapse" id="collapseThree" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body"><?php echo $lang['h_faq_faq3_desc']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4">
                        <div class="card border-0 bg-light mt-xl-5">
                            <div class="card-body p-4 py-lg-5">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="text-center">
                                        <div class="h6 fw-bolder"><?php echo $lang['h_faq_questions']; ?></div>
                                        <p class="text-muted mb-4">
                                            <a class="btn btn-dark px-4" href="contacto.php<?= $_SESSION['lang_set'] ?>"><?php echo $lang['h_faq_questions_link']; ?></a>
                                        </p>
                                        <div class="h6 fw-bolder"><?php echo $lang['h_faq_follow']; ?></div>
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

        <!-- MOSTRADOR DE ARTIGOS BLOG-->
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

                <!-- SUBSCREVER NEWSLETTER -->
                <aside class="bg-primary bg-gradient rounded-3 p-4 p-sm-5 mt-5">
                    <div class="d-flex align-items-center justify-content-between flex-column flex-xl-row text-center text-xl-start">
                        <div class="mb-4 mb-xl-0">
                            <div class="fs-3 fw-bold text-white"><?php echo $lang['h_newsletter_title']; ?></div>
                            <div class="text-white-50"><?php echo $lang['h_newsletter_subtitle']; ?></div>
                        </div>
                        <div class="ms-xl-4">
                            <div class="input-group mb-2">
                                <input class="form-control" type="text" placeholder="<?php echo $lang['h_newsletter_input_email']; ?>" aria-label="Insira o seu email" aria-describedby="button-newsletter" />
                                <button class="btn btn-outline-light" id="button-newsletter" type="button"><?php echo $lang['h_newsletter_input_btn']; ?></button>
                            </div>
                            <div class="small text-white-50"><?php echo $lang['h_newsletter_input_desc']; ?></div>
                        </div>
                    </div>
                </aside>
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
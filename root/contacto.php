<?php
//TITULO PÁGINA
$page_title = 'Contacto -';

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
                            <h1 class="display-5 fw-bolder text-white mb-2"><?php echo $lang['c_banner_title']; ?></h1>
                            <p class="lead fw-normal text-white-50 mb-4"><?php echo $lang['c_banner_subtitle']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- INICIO CONTEUDO -->

        <!-- FORMULARIO CONTACTO-->
        <section id="contacto_form" class="py-5">
            <div class="container px-5">
                <!-- Contact form-->
                <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
                    <div class="text-center mb-5">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-envelope"></i></div>
                        <h1 class="fw-bolder"><?php echo $lang['c_form_title']; ?></h1>
                        <p class="lead fw-normal text-muted mb-0"><?php echo $lang['c_form_subtitle']; ?></p>
                    </div>
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-8 col-xl-6">
                            <form id="contactForm" data-sb-form-api-token="API_TOKEN">
                                <!-- NOME -->
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="name" type="text" placeholder="Enter your name..." data-sb-validations="required" />
                                    <label for="name"><?php echo $lang['c_form_input_nome1']; ?></label>
                                    <div class="invalid-feedback" data-sb-feedback="name:required"><?php echo $lang['c_form_input_nome2']; ?></div>
                                </div>
                                <!-- EMAIL -->
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" />
                                    <label for="email"><?php echo $lang['c_form_input_email1']; ?></label>
                                    <div class="invalid-feedback" data-sb-feedback="email:required"><?php echo $lang['c_form_input_email2']; ?></div>
                                    <div class="invalid-feedback" data-sb-feedback="email:email"><?php echo $lang['c_form_input_email3']; ?></div>
                                </div>
                                <!-- TELEFONE -->
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="phone" type="tel" placeholder="(123) 456-7890" data-sb-validations="required" />
                                    <label for="phone"><?php echo $lang['c_form_input_telefone1']; ?></label>
                                    <div class="invalid-feedback" data-sb-feedback="phone:required"><?php echo $lang['c_form_input_telefone2']; ?></div>
                                </div>
                                <!-- MENSAGEM -->
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="message" type="text" placeholder="Enter your message here..." style="height: 10rem" data-sb-validations="required"></textarea>
                                    <label for="message"><?php echo $lang['c_form_input_mensagem1']; ?></label>
                                    <div class="invalid-feedback" data-sb-feedback="message:required"><?php echo $lang['c_form_input_mensagem2']; ?></div>
                                </div>
                                <div class="d-none" id="submitSuccessMessage">
                                    <div class="text-center mb-3">
                                        <div class="fw-bolder"><?php echo $lang['c_form_input_valid_ok']; ?></div>
                                        <br />
                                        <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                    </div>
                                </div>
                                <div class="d-none" id="submitErrorMessage">
                                    <div class="text-center text-danger mb-3"><?php echo $lang['c_form_input_valid_erro']; ?></div>
                                </div>
                                <!-- SUBMETER -->
                                <div class="d-grid"><button class="btn btn-primary btn-lg disabled" id="submitButton" type="submit"><?php echo $lang['c_form_input_button']; ?></button></div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- CARDS -->
                <div class="row gx-5 row-cols-2 row-cols-lg-4 py-5">
                    <div class="col">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-chat-dots"></i></div>
                        <div class="h5 mb-2"><?php echo $lang['c_cards_box1_title']; ?></div>
                        <p class="text-muted mb-0"><?php echo $lang['c_cards_box1_subtitle']; ?></p>
                    </div>
                    <div class="col">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-people"></i></div>
                        <div class="h5"><?php echo $lang['c_cards_box2_title']; ?></div>
                        <p class="text-muted mb-0"><?php echo $lang['c_cards_box2_subtitle']; ?></p>
                    </div>
                    <div class="col">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-question-circle"></i></div>
                        <div class="h5"><?php echo $lang['c_cards_box3_title']; ?></div>
                        <p class="text-muted mb-0"><?php echo $lang['c_cards_box3_subtitle']; ?></p>
                    </div>
                    <div class="col">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-telephone"></i></div>
                        <div class="h5"><?php echo $lang['c_cards_box4_title']; ?></div>
                        <p class="text-muted mb-0"><?php echo $lang['c_cards_box4_subtitle']; ?></p>
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
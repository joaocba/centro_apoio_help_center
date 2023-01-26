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
            <div class="container">
                <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
                    <div class="text-center mb-5">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-envelope"></i></div>
                        <h1 class="fw-bolder"><?php echo $lang['c_form_title']; ?></h1>
                        <p class="lead fw-normal text-muted mb-0"><?php echo $lang['c_form_subtitle']; ?></p>
                    </div>
                    <div class="row gx-5 justify-content-center">

                        <!-- CAIXA DE ALERTA -->
                        <?php
                        //mensagem de sucesso
                        if (!empty($_GET['status']) && ($_GET['status'] == "contactsent")) {
                            echo '<div class="alert alert-success text-center">Mensagem enviada com sucesso! Iremos responder com a maior brevidade possivel.</div>';
                        }
                        ?>
                        <?php
                        //mensagem de erro
                        if (!empty($_GET['status']) && ($_GET['status'] == "senderror")) {
                            echo '<div class="alert alert-danger text-center">Houve um problema ao enviar mensagem, por favor tente mais tarde</div>';
                        }
                        ?>

                        <!-- iFrame Google Maps -->
                        <div class="col-lg-6 col-xl-6 d-none d-xl-block">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12418.512483862733!2d-9.0270321!3d38.9096186!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x80178deaa067712!2sFord%20Trucks!5e0!3m2!1spt-PT!2spt!4v1674154771859!5m2!1spt-PT!2spt" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>

                        <!-- Campos de contacto -->
                        <div class="col-lg-6 col-xl-6">
                            <form id="contactForm" method="POST" action="./components/forms/contact.php" role="form">
                                <!-- NOME -->
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="form_name" type="text" name="name" required="required" data-error="Deve inserir o nome" placeholder="">
                                    <label for="form_name"><?php echo $lang['c_form_input_nome1']; ?></label>
                                </div>
                                <!-- EMAIL -->
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="form_email" type="email" name="email" required="required" data-error="Deve inserir um email válido" placeholder="">
                                    <label for="form_email"><?php echo $lang['c_form_input_email1']; ?></label>
                                </div>
                                <!-- TELEFONE -->
                                <div class="form-floating mb-3">
                                    <input class="form-control" id="form_tel" type="tel" name="tel" required="required" data-error="Deve inserir um número de telefone" placeholder="">
                                    <label for="form_tel"><?php echo $lang['c_form_input_telefone1']; ?></label>
                                </div>
                                <!-- MENSAGEM -->
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" id="form_message" type="text" name="message" style="height: 10rem" required="required" data-error="Deve inserir uma mensagem" placeholder=""></textarea>
                                    <label for="form_message"><?php echo $lang['c_form_input_mensagem1']; ?></label>
                                </div>


                                <!-- ?? -->
                                <div class="d-none" id="submitSuccessMessage">
                                    <div class="text-center mb-3">
                                        <div class="fw-bolder"><?php echo $lang['c_form_input_valid_ok']; ?></div>
                                    </div>
                                </div>
                                <div class="d-none" id="submitErrorMessage">
                                    <div class="text-center text-danger mb-3"><?php echo $lang['c_form_input_valid_erro']; ?></div>
                                </div>


                                <!-- Google reCAPTCHA V2 -->
                                <div class="col-md-12 my-3">
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="6LcQigckAAAAAJNuMFgj5WnDtW0MXkt40v2mW8y6"></div>
                                    </div>
                                </div>

                                <!-- SUBMETER -->
                                <div class="d-grid">
                                    <button class="btn btn-primary btn-lg" id="submitButton" type="submit"><?php echo $lang['c_form_input_button']; ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- CARDS -->
                <div class="row gx-5 row-cols-1 row-cols-lg-4 py-5">
                    <div class="col mb-4 mb-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-chat-dots"></i></div>
                        <div class="h5 mb-2"><?php echo $lang['c_cards_box1_title']; ?></div>
                        <p class="text-muted mb-0"><?php echo $lang['c_cards_box1_subtitle']; ?></p>
                    </div>
                    <div class="col mb-4 mb-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-people"></i></div>
                        <div class="h5"><?php echo $lang['c_cards_box2_title']; ?></div>
                        <p class="text-muted mb-0"><?php echo $lang['c_cards_box2_subtitle']; ?></p>
                    </div>
                    <div class="col mb-4 mb-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-question-circle"></i></div>
                        <div class="h5"><?php echo $lang['c_cards_box3_title']; ?></div>
                        <p class="text-muted mb-0"><?php echo $lang['c_cards_box3_subtitle']; ?></p>
                    </div>
                    <div class="col mb-4 mb-lg-0">
                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-telephone"></i></div>
                        <div class="h5"><?php echo $lang['c_cards_box4_title']; ?></div>
                        <p class="text-muted mb-0"><?php echo $lang['c_cards_box4_subtitle']; ?></p>
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


<!-- Form Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js" integrity="sha256-dHf/YjH1A4tewEsKUSmNnV05DDbfGN3g7NMq86xgGh8=" crossorigin="anonymous"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="./components/forms/contact.js"></script>
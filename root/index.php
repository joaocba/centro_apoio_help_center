<?php
//TITULO PÁGINA
$page_title = '';

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
                    <div class="col-lg-8 col-xl-7 col-xxl-6">
                        <div class="my-5 text-center text-xl-start">
                            <h1 class="display-5 fw-bolder text-white mb-2">Bem-vindo ao centro de apoio</h1>
                            <p class="lead fw-normal text-white-50 mb-4">Siga os seus pedidos de apoio no painel de cliente</p>
                            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                                <a class="btn btn-outline-light btn-lg px-4 me-sm-3" href="./login.php">Acesso ao Painel</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center"><img class="img-fluid rounded-3 my-5 animated" src="./assets/img/landing/support-client.png" alt="apoio" /></div>
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
                            <a class="btn btn-primary btn-lg" href="./sobre.php">Saber mais</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- TEAM -->
        <section class="py-5">
            <div class="container px-5 my-5">
                <div class="text-center">
                    <h2 class="fw-bolder">A Equipa</h2>
                    <p class="lead fw-normal text-muted mb-5">Dedicados à qualidade e sucesso</p>
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
                    <div class="col mb-5">
                        <div class="text-center">
                            <img class="img-fluid rounded-circle mb-4 px-4" src="./assets/img/landing/profile_leandro.jpg" alt="..." />
                            <h5 class="fw-bolder">Leandro Miranda</h5>
                            <div class="fst-italic text-muted">Developer &amp; Web Designer</div>
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
                    <h1 class="fw-bolder">Funcionalidades</h1>
                    <p class="lead fw-normal text-muted mb-0">da Web App Centro de Apoio</p>
                </div>
                <div class="row gx-5">
                    <div class="col-lg-6 align-items-stretch order-1 order-lg-2 logo" style="background-image: url(&quot;./assets/img/landing/features.png&quot;);">&nbsp;</div>
                    <div class="col-lg-6 align-items-stretch order-2 order-lg-2">
                        <!-- <h2 class="fw-bolder text-center text-muted my-3">Funcionalidades da Web App</h2> -->
                        <div class="row gx-5 row-cols-1 row-cols-md-2">
                            <div class="col mb-5 h-100">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body p-4">
                                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-ticket-detailed"></i></div>
                                        <h2 class="h5 fw-bold">Criação de pedidos de apoio</h2>
                                        <p class="mb-0">O cliente pode criar um pedido de apoio e interagir com o agente em formato de chat</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-5 h-100">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body p-4">
                                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-person-rolodex"></i></div>
                                        <h2 class="h5 fw-bold">Gestão de pedidos de apoio</h2>
                                        <p class="mb-0">O agente pode gerir e responder aos pedidos de apoio dos clientes</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col mb-5 mb-md-0 h-100">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body p-4 text-justify">
                                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-cpu"></i></div>
                                        <h2 class="h5 fw-bold">Administração do centro de apoio</h2>
                                        <p class="mb-0">O painel de administrador permite uma gestão de clientes, agentes e knowledge base</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col h-100">
                                <div class="card bg-light border-0 h-100">
                                    <div class="card-body p-4">
                                        <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-info-circle"></i></div>
                                        <h2 class="h5 fw-bold">Knowledge Base integrada</h2>
                                        <p class="mb-0">O cliente pode aceder aos artigos disponiveis na knowledge base para uma resolução mais eficiente dos problemas apresentados</p>
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
                    <h1 class="fw-bolder">Perguntas Frequentes</h1>
                    <p class="lead fw-normal text-muted mb-0">Como o podemos ajudar?</p>
                </div>
                <div class="row gx-5">
                    <div class="col-xl-8">
                        <h2 class="fw-bolder mb-3">Apoio Tecnico</h2>
                        <div class="accordion mb-5" id="accordionExample">
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingOne"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Como posso criar um pedido de apoio?</button></h3>
                                <div class="accordion-collapse collapse show" id="collapseOne" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Entre no Painel de Cliente (precisa ter uma conta registada) e escolha a opcao <strong>Criar Ticket</strong>, preencha os campos do formulario e a descricao do problema
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingTwo"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Quanto tempo devo aguardar após submeter um ticket? A resposta é automática?</button></h3>
                                <div class="accordion-collapse collapse" id="collapseTwo" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Dependendo do tipo de serviço solicitado, irá receber uma resposta automática com os detalhes do seu pedido e o tempo máximo previsto de resolução.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h3 class="accordion-header" id="headingThree"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Posso ver os pedidos que criei e o seu estado?</button></h3>
                                <div class="accordion-collapse collapse" id="collapseThree" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <strong>Sim!</strong>
                                        Atraves do Painel de Cliente pode criar e ver o estado dos seus pedidos de ajuda, pode tambem deixar as suas respostas e visualizar as respostas dos nossos agentes.
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
                                        <div class="h6 fw-bolder">Tem mais questoes?</div>
                                        <p class="text-muted mb-4">
                                            <a class="btn btn-dark px-4" href="contacto.php">Contacte-nos</a>
                                        </p>
                                        <div class="h6 fw-bolder">Siga-nos</div>
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
                            <h2 class="fw-bolder">Do nosso Blog</h2>
                            <p class="lead fw-normal text-muted mb-5">Últimas noticias inseridas no blog</p>
                        </div>
                    </div>
                </div>
                <div class="row gx-5">
                    <div class="col-lg-4 mb-5">
                        <div class="card h-100 shadow border-0">
                            <img class="card-img-top" src="https://dummyimage.com/600x350/ced4da/6c757d" alt="..." />
                            <div class="card-body p-4">
                                <div class="badge bg-primary bg-gradient rounded-pill mb-2">News</div>
                                <a class="text-decoration-none link-dark stretched-link" href="#!">
                                    <h5 class="card-title mb-3">Blog post title</h5>
                                </a>
                                <p class="card-text mb-0">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                            <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                <div class="d-flex align-items-end justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle me-3" src="https://dummyimage.com/40x40/ced4da/6c757d" alt="..." />
                                        <div class="small">
                                            <div class="fw-bold">Kelly Rowan</div>
                                            <div class="text-muted">March 12, 2022 &middot; 6 min read</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-5">
                        <div class="card h-100 shadow border-0">
                            <img class="card-img-top" src="https://dummyimage.com/600x350/adb5bd/495057" alt="..." />
                            <div class="card-body p-4">
                                <div class="badge bg-primary bg-gradient rounded-pill mb-2">Media</div>
                                <a class="text-decoration-none link-dark stretched-link" href="#!">
                                    <h5 class="card-title mb-3">Another blog post title</h5>
                                </a>
                                <p class="card-text mb-0">This text is a bit longer to illustrate the adaptive height of each card. Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                            <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                <div class="d-flex align-items-end justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle me-3" src="https://dummyimage.com/40x40/ced4da/6c757d" alt="..." />
                                        <div class="small">
                                            <div class="fw-bold">Josiah Barclay</div>
                                            <div class="text-muted">March 23, 2022 &middot; 4 min read</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-5">
                        <div class="card h-100 shadow border-0">
                            <img class="card-img-top" src="https://dummyimage.com/600x350/6c757d/343a40" alt="..." />
                            <div class="card-body p-4">
                                <div class="badge bg-primary bg-gradient rounded-pill mb-2">News</div>
                                <a class="text-decoration-none link-dark stretched-link" href="#!">
                                    <h5 class="card-title mb-3">The last blog post title is a little bit longer than the others</h5>
                                </a>
                                <p class="card-text mb-0">Some more quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                            <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                <div class="d-flex align-items-end justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <img class="rounded-circle me-3" src="https://dummyimage.com/40x40/ced4da/6c757d" alt="..." />
                                        <div class="small">
                                            <div class="fw-bold">Evelyn Martinez</div>
                                            <div class="text-muted">April 2, 2022 &middot; 10 min read</div>
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
                            <div class="fs-3 fw-bold text-white">Fique atento às novidades.</div>
                            <div class="text-white-50">Receba a newsletter com as últimas noticias e atualizações.</div>
                        </div>
                        <div class="ms-xl-4">
                            <div class="input-group mb-2">
                                <input class="form-control" type="text" placeholder="Insira o seu email" aria-label="Insira o seu email" aria-describedby="button-newsletter" />
                                <button class="btn btn-outline-light" id="button-newsletter" type="button">Subscrever</button>
                            </div>
                            <div class="small text-white-50">Ao subscrever concordo com as nossa politicas de privacidade.</div>
                        </div>
                    </div>
                </aside>
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
<?php
//TITULO PÁGINA
$page_title = 'Painel Administrador -';

//HTML HEAD
include('../components/page-head.php');
?>

<?php
//AUTO REFRESH PAGINA
$page = $_SERVER['PHP_SELF'];
$sec = "300";
header("Refresh: $sec; url=$page");

//VERIFICAR SESSAO
require_once('../int.php');

if (!isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] != true) {
    header('Location: ../login.php');
}

?>

<body class="sb-nav-fixed">

    <!-- TOP NAVBAR -->
    <?php include('../global-panel/components/topnav-painel.php'); ?>

    <!-- INICIO LAYOUT -->
    <div id="layoutSidenav">

        <!-- SIDEBAR -->
        <?php include('../global-panel/components/sidebar-painel.php'); ?>

        <!-- INICIO CONTEUDO DO LAYOUT -->
        <div id="layoutSidenav_content" class="bg-light">
            <main>
                <div class="container-fluid px-5">

                    <!-- Cabeçalho de Painel + Breadcrumbs -->
                    <h1 class="mt-4">Painel Administrador</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="./admin-panel/painel-admin.php">Dashboard</a></li>
                    </ol>

                    <!-- Card Boas Vindas -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3>Olá, <?php echo $_SESSION['nome'] . ' ' . $_SESSION['apelido']; ?></h3>
                                    <span>Última sessão inciada a <?php echo $_SESSION['last_login']; ?></span>
                                    <!-- <a href="./components/logout.php" class="btn btn-dark">Terminar Sessão</a> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cards de Acesso -->
                    <div class="row">
                        <!-- Gerir Clientes -->
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3>Gerir Clientes</h3>
                                    <p>Aceda ao gestor de clientes</p>
                                    <a href="./admin-panel/gerir-clientes.php" class="btn btn-success">Gerir Clientes</a>
                                </div>
                            </div>
                        </div>
                        <!-- Gerir Agentes -->
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3>Gerir Agentes</h3>
                                    <p>Aceda ao gestor de agentes</p>
                                    <a href="./admin-panel/gerir-agentes.php" class="btn btn-success">Gerir Agentes</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Gerir KB -->
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3>Gerir Knowledge Base</h3>
                                    <p>Aceda ao gestor de artigos e categorias da Knowledge Base</p>
                                    <a href="./admin-panel/gerir-kb.php" class="btn btn-success">Gerir Knowledge Base</a>
                                </div>
                            </div>
                        </div>
                        <!-- Gerir Contactos -->
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3>Gerir Contactos</h3>
                                    <p>Aceda ao gestor de contactos internos</p>
                                    <a href="./admin-panel/gerir-contactos.php" class="btn btn-success">Gerir Contactos</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Gerir Definições -->
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3>Definições</h3>
                                    <p>Aceda ás definições do Painel de Apoio</p>
                                    <a href="./admin-panel/definicoes-admin.php" class="btn btn-success">Definições</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            <!-- FOOTER PANEL -->
            <?php include('../components/panels/footer-panel.php'); ?>

        </div>
        <!-- FIM CONTEUDO LAYOUT -->
    </div>
    <!-- FIM CONTEUDO PAGINA -->



    <!-- PAGE BOTTOM -->
    <?php include('../components/page-bottom.php'); ?>

</body>

</html>
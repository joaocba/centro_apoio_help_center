<?php
//TITULO PÁGINA
$page_title = 'Painel Administrador -';

//HTML HEAD
include('../components/page-head.php');
?>

<?php
//AUTO REFRESH PAGINA
$page = $_SERVER['PHP_SELF'];
$sec = "30";
header("Refresh: $sec; url=$page");

//VERIFICAR SESSAO
require_once('../int.php');

if (!isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] != true) {
    header('Location: ../login.php');
}

?>

<body>
    <div class="d-flex" id="wrapper">
        <?php include('../global-panel/components/sidebar-painel.php'); ?>
        <div class="bg-light" id="page-content-wrapper">
            <?php include('../global-panel/components/topnav-painel.php'); ?>
            <div class="container-fluid">
                <!-- INICIO DE CONTEUDO DE PAGINA -->

                <div class="container mt-4">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <!-- LOGIN INFO -->
                            <h1 class="mb-3"><i class="bi bi-window"></i> Painel de Administrador</h1>
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h3>Olá, <?php echo $_SESSION['nome'] . ' ' . $_SESSION['apelido']; ?></h3>
                                    <p>Última sessão inciada a <?php echo $_SESSION['last_login']; ?></p>
                                    <a href="../components/logout.php" class="btn btn-dark">Terminar Sessão</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center mb-3">
                        <!-- GERIR CLIENTES -->
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Gerir Clientes</h3>
                                    <p>Aceda ao gestor de clientes</p>
                                    <a href="./admin-panel/gerir-clientes.php" class="btn btn-success">Gerir Clientes</a>
                                </div>
                            </div>
                        </div>

                        <!-- GERIR AGENTES -->
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Gerir Agentes</h3>
                                    <p>Aceda ao gestor de agentes</p>
                                    <a href="./admin-panel/gerir-agentes.php" class="btn btn-success">Gerir Agentes</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center mb-3">
                        <!-- GERIR ARTIGOS -->
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Gerir Knowledge Base</h3>
                                    <p>Aceda ao gestor de artigos e categorias da Knowledge Base</p>
                                    <a href="./admin-panel/gerir-kb.php" class="btn btn-success">Gerir Knowledge Base</a>
                                </div>
                            </div>
                        </div>

                        <!-- DEFINIÇÕES -->
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Definições</h3>
                                    <p>Aceda ás definições do Painel de Apoio</p>
                                    <a href="./admin-panel/definicoes-admin.php" class="btn btn-success">Definições</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FIM DE CONTEUDO DE PAGINA -->
            </div>
        </div>
    </div>

    <!-- PAGE BOTTOM -->
    <?php include('../components/page-bottom.php'); ?>
</body>

</html>
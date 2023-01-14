<?php
//TITULO PÁGINA
$page_title = 'Estatisticas -';

//HTML HEAD
include('../components/page-head.php');
?>

<?php
$success = false;
$error = false;
require_once('../int.php');
if (!isset($_SESSION['agent_logged']) && $_SESSION['agent_logged'] != true) {
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

                <!-- PAGINA PRINCIPAL -->
                <div class="container mt-4">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-12">

                            <!-- INFO -->
                            <h1 class="mb-3"><i class="bi bi-window"></i> Painel de Agente</h1>

                            <!-- PAINEL DE ESTATISTICAS -->
                            <form method="POST">
                                <div class="card mb-3">
                                    <div class="card-header">Estatisticas</div>
                                    <div class="card-body">

                                        <?php
                                        if (isset($error) && $error != false) {
                                            echo '<div class="alert alert-danger">' . $error . '</div>'; //box com mensagem de erro
                                        }
                                        ?>
                                        <?php
                                        if (isset($success) && $success != false) {
                                            echo '<div class="alert alert-success">' . $success . '</div>'; //box com mensagem de sucesso
                                        }
                                        ?>

                                        <div class="alert alert-info">Sem estatisticas disponiveis</div>

                                        <div class="">
                                            <a href="./agent-panel/painel-agente.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
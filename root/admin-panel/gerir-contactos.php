<?php
//TITULO PÁGINA
$page_title = 'Gerir Contactos -';

//HTML HEAD
include('../components/page-head.php');
?>

<?php
require_once('../int.php');

//VERIFICAR SESSAO
if (!isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] != true) {
    header('Location: ./login.php');
}


$db = new DB();
$dbconn = $db->conn;

$latest = [];
$sql = "SELECT * FROM phone_list ORDER BY departamento ASC";
$recodes = mysqli_query($dbconn, $sql);

if ($recodes->num_rows > 0) {
    while ($row = $recodes->fetch_assoc()) {
        $latest[] = $row;
    }
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
                    <h1 class="mt-4">Gestão Contactos</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="./admin-panel/painel-admin.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Gerir Contactos</li>
                    </ol>

                    <!-- Cards de Acesso -->
                    <div class="row">
                        <!-- Procurar Contacto -->
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3>Procurar Contacto</h3>
                                    <p>Pesquise contactos por email</p>
                                    <a href="./admin-panel/procurar-contacto.php" class="btn btn-success">Procurar</a>
                                </div>
                            </div>
                        </div>
                        <!-- Registar Contacto -->
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3>Registar Contacto</h3>
                                    <p>Registe um novo contacto</p>
                                    <a href="./admin-panel/registar-contacto.php" class="btn btn-success">Registar Contacto</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lista de Contactos Internos Registados -->
                    <h1 class="mt-2 mb-1">Contactos</h1>
                    <div class="text-muted">
                        Lista de contactos registados por departamento
                    </div>
                    <div class="bg-light my-3">
                        <ul class="list-group">

                            <!-- CAIXA DE ALERTA -->
                            <?php
                            //mensagem de registo criado
                            if (!empty($_GET['status']) && ($_GET['status'] == "contactcreated")) {
                                echo '<div class="alert alert-success text-center">Registo criado com sucesso</div>';
                            }
                            ?>
                            <?php
                            //mensagem de registo alterado
                            if (!empty($_GET['status']) && ($_GET['status'] == "contactdeleted")) {
                                echo '<div class="alert alert-success text-center">Registo removido com sucesso</div>';
                            }
                            ?>
                            <?php
                            //mensagem de registo removido
                            if (!empty($_GET['status']) && ($_GET['status'] == "contactupdated")) {
                                echo '<div class="alert alert-success text-center">Registo atualizado com sucesso</div>';
                            }
                            ?>

                            <!-- Cabeçalho da lista -->
                            <div class="d-none d-lg-block list-group-item bg-dark text-white mb-2">
                                <div class="container-fluid">
                                    <div class="row justify-content-between">
                                    <div class="col-lg-1 col-sm-12" style="width:4% !important;">
                                            <small>#</small>
                                        </div>
                                        <div class="col-lg-2 col-sm-12">
                                            <small>Colaborador</small>
                                        </div>
                                        <div class="col-lg-1 col-sm-12">
                                            <small>Departamento</small>
                                        </div>
                                        <div class="col-lg-2 col-sm-12">
                                            <small>Nº Directo Fixo</small>
                                        </div>
                                        <div class="col-lg-1 col-sm-12">
                                            <small>Nº Curto Fixo</small>
                                        </div>
                                        <div class="col-lg-1 col-sm-12">
                                            <small>Telemóvel</small>
                                        </div>
                                        <div class="col-lg-1 col-sm-12">
                                            <small>Nº Curto Móvel</small>
                                        </div>
                                        <div class="col-lg-2 col-sm-12">
                                            <small>Email</small>
                                        </div>
                                        <div class="col-lg-1 col-sm-12">
                                            <small>Ações</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Gerar Lista de Contactos -->
                            <?php if (count($latest) > 0) {
                                $contador = 1;
                                foreach ($latest as $k => $v) {
                                    echo '
                                    <li class="list-group-item list-group-item-action my-1" aria-current="true">
                                        <div class="container-fluid">
                                            <div class="row d-flex justify-content-between align-items-center py-2">
                                            <div class="col-lg-1 col-sm-12" style="width:4% !important;">
                                                <span class="text-muted"><small># ' . ($contador++) . '</small></span>
                                            </div>
                                            <div class="col-lg-2 col-sm-12">
                                                <small class="d-lg-none">Colaborador:</small>
                                                <span class="fw-bold">' . $v['colaborador'] . '</span>
                                            </div>
                                            <div class="col-lg-1 col-sm-12">
                                                <small class="d-lg-none">Departamento:</small>
                                                <span>' . $v['departamento'] . '</span>
                                            </div>
                                            <div class="col-lg-2 col-sm-12">
                                                <small class="d-lg-none">Nº Directo Fixo:</small>
                                                <span>' . $v['num_directo'] . '</span>
                                            </div>
                                            <div class="col-lg-1 col-sm-12">
                                                <small class="d-lg-none">Nº Curto Fixo:</small>
                                                <span>' . $v['curto_fixo'] . '</span>
                                            </div>
                                            <div class="col-lg-1 col-sm-12">
                                                <small class="d-lg-none">Telemóvel:</small>
                                                <span>' . $v['telemovel'] . '</span>
                                            </div>
                                            <div class="col-lg-1 col-sm-12">
                                                <small class="d-lg-none">Nº Curto Móvel:</small>
                                                <span>' . $v['curto_movel'] . '</span>
                                            </div>
                                            <div class="col-lg-2 col-sm-12">
                                                <small class="d-lg-none">Email:</small>
                                                <span>' . $v['email'] . '</span>
                                            </div>
                                                <div class="col-lg-1 col-sm-12">
                                                    <a class="btn btn-sm btn-primary px-3" href="./admin-panel/editar-contacto.php?id=' . $v['id'] . '"><i class="bi bi-pen"></i></a> 
                                                    <a class="btn btn-sm btn-danger px-3" href="./admin-panel/eliminar-contacto.php?id=' . $v['id'] . '"><i class="bi bi-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                ';
                                }
                            } else {
                                echo '<div class="alert alert-info">Não existem contactos registados</div>'; //caso não haja tickets
                            } ?>
                        </ul>
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
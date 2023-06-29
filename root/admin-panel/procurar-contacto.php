<?php
//TITULO PÁGINA
$page_title = 'Procurar Contacto -';

//HTML HEAD
include('../components/page-head.php');
?>

<?php
$success = false;
$error = false;
require_once('../int.php');

if (!isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] != true) {
    header('Location: ../login.php');
}

$db = new DB();
$dbconn = $db->conn;

//PROCURAR CONTACTO POR EMAIL
$latest = [];
if (isset($_POST['submit'])) {

    $sql = "SELECT * FROM phone_list WHERE email='" . $_POST['email'] . "'";
    $inset = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($dbconn), E_USER_ERROR);
    if ($inset->num_rows > 0) {
        while ($row = $inset->fetch_assoc()) {
            $latest[] = $row;
        }
    } else {
        $error = "Email invalido o inexistente"; //mensagem de erro
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
                        <li class="breadcrumb-item"><a href="./admin-panel/gerir-contactos.php">Gerir Contactos</a></li>
                        <li class="breadcrumb-item active">Procurar Contacto</li>
                    </ol>

                    <!-- PROCURAR CONTACTO -->
                    <form method="POST">
                        <div class="card mb-3">
                            <div class="card-header">Procurar Contacto</div>
                            <div class="card-body">
                                <?php
                                if (isset($error) && $error != false) {
                                    echo '<div class="alert alert-danger">' . $error . '</div>';
                                }
                                ?>
                                <?php
                                if (isset($success) && $success != false) {
                                    echo '<div class="alert alert-success">' . $success . '</div>';
                                }
                                ?>
                                <div class="mb-3">
                                    <label class="form-label">Insira o email do colaborador</label>
                                    <input type="email" name="email" id="email" placeholder="Exemplo: colaborador@oneshop.pt" class="form-control" required>
                                </div>
                                <div class="">
                                    <button class="btn btn-success" type="submit" name="submit">Submeter</button>
                                    <a href="./admin-panel/gerir-contactos.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- RESULTADOS DA PESQUISA -->
                    <!-- Lista de Contactos Internos Registados -->
                    <?php if (count($latest) > 0) { ?>
                        <div class="mt-2 text-muted">
                            Lista de contactos encontrados
                        </div>
                        <div class="bg-light my-3">
                            <ul class="list-group">

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
                                            <div class="row d-flex justify-content-between align-items-center py-3">
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
                    <?php
                    } else {
                        if (isset($error) && $error != false) {
                            //echo '<div class="alert alert-danger">' . $error . '</div>';
                            echo '<div class="alert alert-info">Inicie a pesquisa</div>';
                        } else {
                            echo '<div class="alert alert-info">Inicie a pesquisa</div>';
                        }
                    }
                    ?>

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
<?php
//TITULO PÁGINA
$page_title = 'Gerir Agentes -';

//HTML HEAD
include('../components/page-head.php');
?>

<?php
require_once('../int.php');

//VERIFICAR SESSAO
if (!isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] != true) {
    header('Location: ../login.php');
}


$db = new DB();
$dbconn = $db->conn;

//MOSTRAR CLIENTES
$latest = [];
$sql = "SELECT * FROM users WHERE role='1' ORDER BY id ASC LIMIT 15";
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
                    <h1 class="mt-4">Gestão Agentes</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="./admin-panel/painel-admin.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Gerir Agentes</li>
                    </ol>

                    <!-- Cards de Acesso -->
                    <div class="row">
                        <!-- Procurar Agente -->
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3>Procurar Agente</h3>
                                    <p>Pesquise agentes por email</p>
                                    <a href="./admin-panel/procurar-agente.php" class="btn btn-success">Procurar</a>
                                </div>
                            </div>
                        </div>
                        <!-- Registar Agente -->
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3>Registar Agente</h3>
                                    <p>Registe um novo agente</p>
                                    <a href="./admin-panel/registar-agente.php" class="btn btn-success">Registar Agente</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lista de Agentes Registados -->
                    <h1 class="mt-2 mb-1">Agentes</h1>
                    <div class="text-muted">
                        Lista de agentes registados
                    </div>
                    <div class="bg-light my-3">
                        <ul class="list-group">

                            <!-- CAIXA DE ALERTA -->
                            <?php
                            //mensagem de registo criado
                            if (!empty($_GET['status']) && ($_GET['status'] == "usercreated")) {
                                echo '<div class="alert alert-success text-center">Registo criado com sucesso</div>';
                            }
                            ?>
                            <?php
                            //mensagem de registo alterado
                            if (!empty($_GET['status']) && ($_GET['status'] == "userdeleted")) {
                                echo '<div class="alert alert-success text-center">Registo removido com sucesso</div>';
                            }
                            ?>
                            <?php
                            //mensagem de registo removido
                            if (!empty($_GET['status']) && ($_GET['status'] == "userupdated")) {
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
                                        <div class="col-lg-3 col-sm-12">
                                            <small>Nome</small>
                                        </div>
                                        <div class="col-lg-3 col-sm-12">
                                            <small>Email</small>
                                        </div>
                                        <div class="col-lg-1 col-sm-12">
                                            <small>Telefone</small>
                                        </div>
                                        <div class="col-lg-1 col-sm-12">
                                            <small>Empresa</small>
                                        </div>
                                        <div class="col-lg-1 col-sm-12">
                                            <small>Departamento</small>
                                        </div>
                                        <div class="col-lg-2 col-sm-12">
                                            <small>Ações</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Gerar Lista de Agentes -->
                            <?php if (count($latest) > 0) {
                                $contador = count($latest);
                                foreach ($latest as $k => $v) {
                                    echo '
                                    <li class="list-group-item list-group-item-action my-1" aria-current="true">
                                        <div class="container-fluid">
                                            <div class="row d-flex justify-content-between align-items-center py-3">
                                                <div class="col-lg-1 col-sm-12" style="width:4% !important;">
                                                    <span class="text-muted"><small># ' . ($contador > 0 ? $contador-- : $contador = 0) . '</small></span>
                                                </div>
                                                <div class="col-lg-3 col-sm-12">
                                                    <small class="d-lg-none">Nome:</small>
                                                    <span>' . $v['nome'] . ' ' . $v['apelido'] . '</span>
                                                </div>
                                                <div class="col-lg-3 col-sm-12">
                                                    <small class="d-lg-none">Email:</small>
                                                    <span>' . $v['email'] . '</span>
                                                </div>
                                                <div class="col-lg-1 col-sm-12">
                                                    <small class="d-lg-none">Telefone:</small>
                                                    <span>' . $v['telefone'] . '</span>
                                                </div>
                                                <div class="col-lg-1 col-sm-12">
                                                    <small class="d-lg-none">Empresa:</small>
                                                    <span>' . $v['nome_empresa'] . '</span>
                                                </div>
                                                <div class="col-lg-1 col-sm-12">
                                                    <small class="d-lg-none">Departamento:</small>
                                                    <span>' . $v['dep_empresa'] . '</span>
                                                </div>
                                                <div class="col-lg-2 col-sm-12">
                                                    <a class="btn btn-sm btn-success px-3" href="./admin-panel/agente.php?id=' . $v['id'] . '"><i class="bi bi-search"></i></a> 
                                                    <a class="btn btn-sm btn-primary px-3" href="./admin-panel/editar-agente.php?id=' . $v['id'] . '"><i class="bi bi-pen"></i></a> 
                                                    <a class="btn btn-sm btn-danger px-3" href="./admin-panel/eliminar-agente.php?id=' . $v['id'] . '"><i class="bi bi-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                ';
                                }
                            } else {
                                echo '<div class="alert alert-info">Não existem agentes registados</div>'; //caso não haja tickets
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
<?php
//TITULO PÁGINA
$page_title = 'Painel Cliente -';

//HTML HEAD
include('../components/page-head.php');
?>

<?php
//AUTO REFRESH PAGINA
$page = $_SERVER['PHP_SELF'];
$sec = "300";
header("Refresh: $sec; url=$page");

require_once('../int.php');

//VERIFICAR SESSAO
if (!isset($_SESSION['user_logged']) && $_SESSION['user_logged'] != true) {
    header('Location: ../login.php');
}

//VERIFICAR SE RETORNOU DE TICKET NAO RESOLVIDO
if (isset($_GET['tktunsolved'])) {
    if ($_GET['tktunsolved'] == true) {
        //Limpar variavel de sessao
        unset($_SESSION['ticket_id_criado']);
    }
}

//Vars estados de tickets:
$estado_0 = "Novo";
$estado_1 = "Aberto";
$estado_2 = "Fechado";

//Vars prioridades de tickets:
$prioridade_0 = "Normal";
$prioridade_1 = "Alta";

//Var User ID:
$userid = $_SESSION['id'];

$db = new DB();
$dbconn = $db->conn;

//MOSTRAR ULTIMOS TICKETS
$latest = [];
$sql = "SELECT * FROM tickets WHERE user_id='$userid' ORDER BY date DESC LIMIT 15";
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
                    <h1 class="mt-4">Painel Cliente</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="./user-panel/painel-cliente.php">Dashboard</a></li>
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
                        <!-- Procurar Ticket -->
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3>Procurar Ticket</h3>
                                    <p>Caso o seu ticket não apareça na lista procure aqui através do ID</p>
                                    <a href="./global-panel/procurar-ticket.php" class="btn btn-success">Procurar</a>
                                </div>
                            </div>
                        </div>
                        <!-- Criar Ticket -->
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3>Criar Novo Ticket</h3>
                                    <p>Se precisar de apoio técnico crie um novo ticket</p>
                                    <a href="./user-panel/criar-ticket.php" class="btn btn-success">Criar Ticket</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lista de Tickets do Utilizador -->
                    <h1 class="mt-2 mb-1">Tickets</h1>
                    <div class="text-muted">
                        Lista de tickets registados
                    </div>
                    <div class="bg-light my-3">
                        <div class="list-group">

                            <!-- Cabeçalho da lista -->
                            <div class="d-none d-lg-block list-group-item bg-dark text-white mb-2">
                                <div class="container-fluid">
                                    <div class="row justify-content-between">
                                        <div class="col-lg-1 col-sm-12" style="width:4% !important;">
                                            <small>#</small>
                                        </div>
                                        <div class="col-lg-1 col-sm-12">
                                            <small>ID</small>
                                        </div>
                                        <div class="col-lg-4 col-sm-12">
                                            <small>Assunto</small>
                                        </div>
                                        <div class="col-lg-2 col-sm-12">
                                            <small>Data Criação</small>
                                        </div>
                                        <div class="col-lg-1 col-sm-12">
                                            <small>Prioridade</small>
                                        </div>
                                        <div class="col-lg-2 col-sm-12">
                                            <small>Data Resposta</small>
                                        </div>
                                        <div class="col-lg-1 col-sm-12">
                                            <small>Estado</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Gerar Lista de Tickets -->
                            <?php if (count($latest) > 0) {
                                $contador = count($latest);
                                foreach ($latest as $k => $v) {
                                    echo '
                                    <a href="./user-panel/ticket.php?id=' . $v['id'] . '" class="list-group-item list-group-item-action my-1" aria-current="true">
                                        <div class="container-fluid">
                                            <div class="row d-flex justify-content-between align-items-center py-3">
                                                <div class="col-lg-1 col-sm-12" style="width:4% !important;">
                                                    <span class="text-muted"><small># '.($contador > 0 ? $contador-- : $contador=0).'</small></span>
                                                </div>
                                                <div class="col-lg-1 col-sm-12">
                                                    <small class="d-lg-none">ID:</small>
                                                    <span class="badge bg-primary">' . $v['ticket_id'] . '</span>
                                                </div>
                                                <div class="col-lg-4 col-sm-12">
                                                    <small class="d-lg-none">Assunto:</small>
                                                    <span>' . $v['assunto'] . '</span>
                                                </div>
                                                <div class="col-lg-2 col-sm-12">
                                                    <small class="d-lg-none">Data:</small>
                                                    <span>' . $v['date'] . '</span>
                                                </div>
                                                <div class="col-lg-1 col-sm-12">
                                                    <small class="d-lg-none">Prioridade:</small>
                                                    <span class="badge ' . (($v['prioridade'] == 0) ? "bg-success" : "bg-danger") . '">' . (($v['prioridade'] == 0) ? $prioridade_0 : $prioridade_1) . '</span>
                                                </div>
                                                <div class="col-lg-2 col-sm-12">
                                                    <small class="d-lg-none">Data Resposta:</small>
                                                    <span>' . (($v['date_reply'] == '0000-00-00 00:00:00') ? '-' : $v['date_reply']) . '</span>
                                                </div>
                                                <div class="col-lg-1 col-sm-12">
                                                    <small class="d-lg-none">Estado:</small>
                                                    <span class="badge ' . (($v['status'] == 0) ? "bg-info" : (($v['status'] == 1) ? "bg-warning" : "bg-dark")) . '">' . (($v['status'] == 0) ? $estado_0 : (($v['status'] == 1) ? $estado_1 : $estado_2)) . '</span>
                                                </div>
                                                <!--<div class="col-lg-1 col-sm-12">
                                                    <small class="d-lg-none">Prioridade:</small>
                                                    <span class="d-inline-flex px-2 py-1 fw-semibold ' . (($v['prioridade'] == 0) ? "text-success bg-success" : "text-danger bg-danger") . ' bg-opacity-10 border ' . (($v['prioridade'] == 0) ? "border-success" : "border-danger") . ' border-opacity-10 rounded-2">' . (($v['prioridade'] == 0) ? $prioridade_0 : $prioridade_1) . '</span>
                                                </div>
                                                <div class="col-lg-1 col-sm-12">
                                                    <small class="d-lg-none">Estado:</small>
                                                    <span class="d-inline-flex px-2 py-1 fw-semibold ' . (($v['status'] == 0) ? "text-info bg-info" : (($v['status'] == 1) ? "text-warning bg-warning" : "text-dark bg-dark")) . ' bg-opacity-10 border ' . (($v['status'] == 0) ? "border-info" : (($v['status'] == 1) ? "border-warning" : "border-dark")) . ' border-opacity-10 rounded-2">' . (($v['status'] == 0) ? $estado_0 : (($v['status'] == 1) ? $estado_1 : $estado_2)) . '</span>
                                                </div>-->
                                            </div>
                                        </div>
                                    </a>
                                ';}
                            } else {
                                echo '<div class="alert alert-info">Não existem tickets</div>'; //caso não haja tickets
                            } ?>
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
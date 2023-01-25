<?php
//TITULO PÁGINA
$page_title = 'Painel Agente -';

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

if (!isset($_SESSION['agent_logged']) && $_SESSION['agent_logged'] != true) {
    header('Location: ../login.php');
}

//PREPARAR ESTATISTICAS DE TICKETS
$new_status = 0; //definir vars de identificação de estado
$waiting_reply_status = 1;
$closed_status = 2;

$new_count = 0; //definir vars de contagem de tickets
$reply_count = 0;
$closed_count = 0;

//Vars estados de tickets:
$estado_0 = "Novo";
$estado_1 = "Aberto";
$estado_2 = "Fechado";

//Vars prioridades de tickets:
$prioridade_normal = 0;
$prioridade_alta = 1;

$prioridade_0 = "Normal";
$prioridade_1 = "Alta";

$priori_normal_count = 0;
$priori_alta_count = 0;

$db = new DB();
$dbconn = $db->conn;

//ESTATISTICAS: TICKETS NOVOS
$sql = "SELECT COUNT(*) AS new_tickets FROM tickets WHERE status=$new_status";
$ntr = mysqli_query($dbconn, $sql);
if ($ntr->num_rows > 0) {
    while ($row = $ntr->fetch_assoc()) {
        $new_count = $row['new_tickets'];
    }
}

//ESTATISTICAS: AGUARDAM RESPOSTA
$sql = "SELECT COUNT(*) AS new_tickets FROM tickets WHERE status=$waiting_reply_status";
$rtc = mysqli_query($dbconn, $sql);
if ($rtc->num_rows > 0) {
    while ($row = $rtc->fetch_assoc()) {
        $reply_count = $row['new_tickets'];
    }
}

//ESTATISTICAS: FECHADOS
$sql = "SELECT COUNT(*) AS new_tickets FROM tickets WHERE status=$closed_status";
$ctr = mysqli_query($dbconn, $sql);
if ($ctr->num_rows > 0) {
    while ($row = $ctr->fetch_assoc()) {
        $closed_count = $row['new_tickets'];
    }
}

//ESTATISTICAS: TICKETS PRIORIDADE NORMAL
$sql = "SELECT COUNT(*) AS prioridade_tickets FROM tickets WHERE prioridade=$prioridade_normal AND status!=$closed_status";
$ntr = mysqli_query($dbconn, $sql);
if ($ntr->num_rows > 0) {
    while ($row = $ntr->fetch_assoc()) {
        $priori_normal_count = $row['prioridade_tickets'];
    }
}

//ESTATISTICAS: TICKETS PRIORIDADE ALTA
$sql = "SELECT COUNT(*) AS prioridade_tickets FROM tickets WHERE prioridade=$prioridade_alta AND status!=$closed_status";
$rtc = mysqli_query($dbconn, $sql);
if ($rtc->num_rows > 0) {
    while ($row = $rtc->fetch_assoc()) {
        $priori_alta_count = $row['prioridade_tickets'];
    }
}

//MOSTRAR TICKETS ABERTOS
$latest = []; //definir array para guardar lista de tickets
$sql = "SELECT * FROM tickets WHERE status!=$closed_status ORDER BY prioridade DESC, date DESC";
$recodes = mysqli_query($dbconn, $sql);
if ($recodes->num_rows > 0) {
    while ($row = $recodes->fetch_assoc()) {
        $latest[] = $row;
    }
}

//MOSTRAR TICKETS FECHADOS
$latest_closed = [];
$sql = "SELECT * FROM tickets WHERE status=$closed_status ORDER BY date DESC LIMIT 99";
$recodes = mysqli_query($dbconn, $sql);
if ($recodes->num_rows > 0) {
    while ($row = $recodes->fetch_assoc()) {
        $latest_closed[] = $row;
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
                    <h1 class="mt-4">Painel Agente</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="./agent-panel/painel-agente.php">Dashboard</a></li>
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
                        <div class="col-xl-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3>Procurar Ticket</h3>
                                    <p>Procurar ticket através de ID</p>
                                    <a href="./global-panel/procurar-ticket.php" class="btn btn-success">Procurar</a>
                                </div>
                            </div>
                        </div>
                        <!-- Ver Estatisticas -->
                        <div class="col-xl-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3>Estatisticas</h3>
                                    <p>Visualizar estatisticas</p>
                                    <a href="./agent-panel/estatisticas-agente.php" class="btn btn-success">Aceder Estatisticas</a>
                                </div>
                            </div>
                        </div>
                        <!-- Contactos -->
                        <div class="col-xl-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3>Contactos</h3>
                                    <p>Lista telefónica interna</p>
                                    <a href="./global-panel/consultar-contactos.php" class="btn btn-success">Aceder</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ESTATISTICAS TICKETS -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <div class="list-group">
                                        <a href="./agent-panel/agente-tickets-novos.php" class="bg-primary bg-opacity-25 list-group-item list-group-item-action m-1" aria-current="true">
                                            <h4>Tickets Novos</h4>
                                            <h3><?php echo $new_count; ?></h3>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4">
                                    <div class="list-group">
                                        <a href="./agent-panel/agente-tickets-espera.php" class="bg-warning bg-opacity-25 list-group-item list-group-item-action m-1" aria-current="true">
                                            <h4>Tickets Em Espera</h4>
                                            <h3><?php echo $reply_count; ?></h2>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4">
                                    <div class="list-group">
                                        <a href="./agent-panel/agente-tickets-fechados.php" class="bg-secondary bg-opacity-25 list-group-item list-group-item-action m-1" aria-current="true">
                                            <h4>Tickets Fechados</h4>
                                            <h3><?php echo $closed_count; ?></h3>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4">
                                    <div class="list-group">
                                        <a href="./agent-panel/agente-tickets-prioridade-zero.php" class="bg-success bg-opacity-25 list-group-item list-group-item-action m-1" aria-current="true">
                                            <h4>Prioridade Normal</h4>
                                            <h3><?php echo $priori_normal_count; ?></h3>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-4">
                                    <div class="list-group">
                                        <a href="./agent-panel/agente-tickets-prioridade-um.php" class="bg-danger bg-opacity-25 list-group-item list-group-item-action m-1" aria-current="true">
                                            <h4>Prioridade Alta</h4>
                                            <h3><?php echo $priori_alta_count; ?></h3>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lista de Tickets Abertos (Global) -->
                    <h1 class="mt-2 mb-1">Tickets Abertos</h1>
                    <div class="text-muted">
                        Lista de tickets registados em resolução
                    </div>
                    <div class="bg-light my-3">
                        <ul class="list-group">

                            <!-- CAIXA DE ALERTA -->
                            <?php
                            //mensagem de ticket fechado
                            if (!empty($_GET['status']) && ($_GET['status'] == "ticketclosed")) {
                                echo '<div class="alert alert-success text-center">Ticket fechado com sucesso</div>';
                            }
                            ?>

                            <?php
                            //mensagem de prioridade de ticket alterada
                            if (!empty($_GET['status']) && ($_GET['status'] == "ticketprioritychange")) {
                                echo '<div class="alert alert-success text-center">Prioridade de ticket alterada com sucesso</div>';
                            }
                            ?>

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
                                        <div class="col-lg-3 col-sm-12">
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
                                        <div class="col-lg-1 col-sm-12">
                                            <small>Ações</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Gerar Lista de Tickets -->
                            <?php if (count($latest) > 0) {
                                $contador = count($latest);
                                foreach ($latest as $k => $v) {
                                    echo '
                                    <li href="./user-panel/ticket.php?id=' . $v['id'] . '" class="list-group-item list-group-item-action my-1" aria-current="true">
                                        <div class="container-fluid">
                                            <div class="row d-flex justify-content-between align-items-center py-3">
                                                <div class="col-lg-1 col-sm-12" style="width:4% !important;">
                                                    <span class="text-muted"><small># ' . ($contador > 0 ? $contador-- : $contador = 0) . '</small></span>
                                                </div>
                                                <div class="col-lg-1 col-sm-12">
                                                    <small class="d-lg-none">ID:</small>
                                                    <span style="width: 85px;" class="badge bg-primary">' . $v['ticket_id'] . '</span>
                                                </div>
                                                <div class="col-lg-3 col-sm-12">
                                                    <small class="d-lg-none">Assunto:</small>
                                                    <span>' . $v['assunto'] . '</span>
                                                </div>
                                                <div class="col-lg-2 col-sm-12">
                                                    <small class="d-lg-none">Data:</small>
                                                    <span>' . $v['date'] . '</span>
                                                </div>
                                                <div class="col-lg-1 col-sm-12">
                                                    <small class="d-lg-none">Prioridade:</small>
                                                    <span style="width: 60px; "class="badge ' . (($v['prioridade'] == 0) ? "bg-success" : "bg-danger") . '">' . (($v['prioridade'] == 0) ? $prioridade_0 : $prioridade_1) . '</span>
                                                </div>
                                                <div class="col-lg-2 col-sm-12">
                                                    <small class="d-lg-none">Data Resposta:</small>
                                                    <span>' . (($v['date_reply'] == '0000-00-00 00:00:00') ? '-' : $v['date_reply']) . '</span>
                                                </div>
                                                <div class="col-lg-1 col-sm-12">
                                                    <small class="d-lg-none">Estado:</small>
                                                    <span style="width: 65px;" class="badge ' . (($v['status'] == 0) ? "bg-info" : (($v['status'] == 1) ? "bg-warning" : "bg-dark")) . '">' . (($v['status'] == 0) ? $estado_0 : (($v['status'] == 1) ? $estado_1 : $estado_2)) . '</span>
                                                </div>
                                                <div class="col-lg-1 col-sm-12">
                                                    <a class="btn btn-sm btn-primary px-3" href="./agent-panel/ticket-agente.php?id=' . $v['id'] . '"><i class="bi bi-search"></i></a>
                                                    ' . (($v['status'] < 2) ? '<a href="./agent-panel/fechar-ticket.php?id=' . $v['id'] . '" class="btn btn-sm btn-secondary px-3"><i class="bi bi-lock"></i></a>' : '') . '
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                ';
                                }
                            } else {
                                echo '<div class="alert alert-info">Não existem tickets</div>'; //caso não haja tickets
                            } ?>
                        </ul>
                    </div>

                    <!-- Lista de Tickets Fechados (Global) -->
                    <h1 class="mt-5 mb-1">Tickets Resolvidos</h1>
                    <div class="text-muted">
                        Lista de tickets registados com estado Fechado
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
                                        <div class="col-lg-1 col-sm-12">
                                            <small>ID</small>
                                        </div>
                                        <div class="col-lg-3 col-sm-12">
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
                                        <div class="col-lg-1 col-sm-12">
                                            <small>Ações</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Gerar Lista de Tickets -->
                            <?php if (count($latest_closed) > 0) {
                                $contador = count($latest_closed);
                                foreach ($latest_closed as $k => $v) {
                                    echo '
                                    <li href="./user-panel/ticket.php?id=' . $v['id'] . '" class="list-group-item list-group-item-action my-1" aria-current="true">
                                        <div class="container-fluid">
                                            <div class="row d-flex justify-content-between align-items-center py-3">
                                                <div class="col-lg-1 col-sm-12" style="width:4% !important;">
                                                    <span class="text-muted"><small># ' . ($contador > 0 ? $contador-- : $contador = 0) . '</small></span>
                                                </div>
                                                <div class="col-lg-1 col-sm-12">
                                                    <small class="d-lg-none">ID:</small>
                                                    <span style="width: 85px;" class="badge bg-primary">' . $v['ticket_id'] . '</span>
                                                </div>
                                                <div class="col-lg-3 col-sm-12">
                                                    <small class="d-lg-none">Assunto:</small>
                                                    <span>' . $v['assunto'] . '</span>
                                                </div>
                                                <div class="col-lg-2 col-sm-12">
                                                    <small class="d-lg-none">Data:</small>
                                                    <span>' . $v['date'] . '</span>
                                                </div>
                                                <div class="col-lg-1 col-sm-12">
                                                    <small class="d-lg-none">Prioridade:</small>
                                                    <span style="width: 60px; "class="badge ' . (($v['prioridade'] == 0) ? "bg-success" : "bg-danger") . '">' . (($v['prioridade'] == 0) ? $prioridade_0 : $prioridade_1) . '</span>
                                                </div>
                                                <div class="col-lg-2 col-sm-12">
                                                    <small class="d-lg-none">Data Resposta:</small>
                                                    <span>' . (($v['date_reply'] == '0000-00-00 00:00:00') ? '-' : $v['date_reply']) . '</span>
                                                </div>
                                                <div class="col-lg-1 col-sm-12">
                                                    <small class="d-lg-none">Estado:</small>
                                                    <span style="width: 65px;" class="badge ' . (($v['status'] == 0) ? "bg-info" : (($v['status'] == 1) ? "bg-warning" : "bg-dark")) . '">' . (($v['status'] == 0) ? $estado_0 : (($v['status'] == 1) ? $estado_1 : $estado_2)) . '</span>
                                                </div>
                                                <div class="col-lg-1 col-sm-12">
                                                    <a class="btn btn-sm btn-primary px-3" href="./agent-panel/ticket-agente.php?id=' . $v['id'] . '"><i class="bi bi-search"></i></a>
                                                    ' . (($v['status'] < 2) ? '<a href="./agent-panel/fechar-ticket.php?id=' . $v['id'] . '" class="btn btn-sm btn-secondary px-3"><i class="bi bi-lock"></i></a>' : '') . '
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                ';
                                }
                            } else {
                                echo '<div class="alert alert-info">Sem tickets fechados</div>'; //caso não haja tickets
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
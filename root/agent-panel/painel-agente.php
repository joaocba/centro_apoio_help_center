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
$prioridade_0 = "Normal";
$prioridade_1 = "Alta";

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

//MOSTRAR ULTIMOS 10 TICKETS
$latest = []; //definir array para guardar lista de tickets
$sql = "SELECT * FROM tickets ORDER BY date DESC LIMIT 99";
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
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3>Procurar Ticket</h3>
                                    <p>Procurar ticket através de ID</p>
                                    <a href="./global-panel/procurar-ticket.php" class="btn btn-success">Procurar</a>
                                </div>
                            </div>
                        </div>
                        <!-- Criar Ticket -->
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3>Estatisticas</h3>
                                    <p>Visualizar estatisticas</p>
                                    <a href="./agent-panel/estatisticas-agente.php" class="btn btn-success">Aceder Estatisticas</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ESTATISTICAS TICKETS -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <div class="card bg-info bg-opacity-50">
                                        <div class="card-body text-dark">
                                            <h3>Tickets Novos</h3>
                                            <h2><?php echo $new_count; ?></h2> <!-- mostra o valor da var com a contagem de tickets -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="card bg-warning bg-opacity-50">
                                        <div class="card-body text-dark">
                                            <h3>Tickets Em Espera</h3>
                                            <h2><?php echo $reply_count; ?></h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4">
                                    <div class="card bg-secondary bg-opacity-50">
                                        <div class="card-body text-dark">
                                            <h3>Tickets Fechados</h3>
                                            <h2><?php echo $closed_count; ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MOSTRAR ULTIMOS 10 TICKETS EM TABELA -->
                    <div class="card mb-5">
                        <div class="card-header">
                            Últimos Tickets
                        </div>
                        <div class="card-body">
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

                            <!-- GERA TABELA -->
                            <?php if (count($latest) > 0) { ?>
                                <!-- caso haja tickets definir tabela com os campos abaixo -->
                                <table class="table table-striped align-middle css-serial">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>ID</th>
                                            <th>Assunto</th>
                                            <th>Data Criação</th>
                                            <th>Data Resposta</th>
                                            <th>Prioridade</th>
                                            <th>Estado</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($latest as $k => $v) { //popular a tabela com cada ticket disponivel
                                            echo '
                                        <tr>
                                            <td></td>
                                            <td>' . $v['ticket_id'] . '</td>
                                            <td>' . $v['assunto'] . '</td>
                                            <td>' . $v['date'] . '</td>
                                            <td>' . (($v['date_reply'] == '0000-00-00 00:00:00') ? '-' : $v['date_reply']) . '</td>
                                            <td>
                                                <small class="d-inline-flex px-2 py-1 fw-semibold 
                                                    ' . (($v['prioridade'] == 0) ? "text-success bg-success" : "text-danger bg-danger") . '
                                                    bg-opacity-10 border 
                                                    ' . (($v['prioridade'] == 0) ? "border-success" : "border-danger") . '
                                                    border-opacity-10 rounded-2">' . (($v['prioridade'] == 0) ? $prioridade_0 : $prioridade_1) . '
                                                </small>
                                            </td>
                                            <td>
                                                <small class="d-inline-flex px-2 py-1 fw-semibold 
                                                    ' . (($v['status'] == 0) ? "text-info bg-info" : (($v['status'] == 1) ? "text-warning bg-warning" : "text-dark bg-dark")) . '
                                                    bg-opacity-10 border 
                                                    ' . (($v['status'] == 0) ? "border-info" : (($v['status'] == 1) ? "border-warning" : "border-dark")) . '
                                                    border-opacity-10 rounded-2">' . (($v['status'] == 0) ? $estado_0 : (($v['status'] == 1) ? $estado_1 : $estado_2)) . '
                                                </small>
                                            </td>
                                            <td>
                                                <a href="./agent-panel/ticket-agente.php?id=' . $v['id'] . '" class="btn btn-sm btn-success"><i class="bi bi-search"></i><a/>
                                                ' . (($v['status'] < 2) ? '<a href="./agent-panel/fechar-ticket.php?id=' . $v['id'] . '" class="btn btn-sm btn-secondary"><i class="bi bi-lock"></i><a/>' : '') . '
                                            </td>
                                        </tr>
                                        ';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            <?php } else {
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
<?php
//TITULO PÁGINA
$page_title = 'Tickets Fechados -';

//HTML HEAD
include('../components/page-head.php');
?>

<?php
//VERIFICAR SESSAO
require_once('../int.php');

if (!isset($_SESSION['agent_logged']) && $_SESSION['agent_logged'] != true) {
    header('Location: ../login.php');
}


//Vars estados de tickets:
$estado_0 = "Novo";
$estado_1 = "Aberto";
$estado_2 = "Fechado";

//Vars prioridades de tickets:
$prioridade_0 = "Normal";
$prioridade_1 = "Alta";


$db = new DB();
$dbconn = $db->conn;

//MOSTRAR ULTIMOS TICKETS COM O ESTADO = 0 (novos)
$latest = [];
$sql = "SELECT * FROM tickets WHERE status=2 ORDER BY date DESC";
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
                        <li class="breadcrumb-item active">Tickets Fechados</li>
                    </ol>

                    <!-- Cards de Info -->
                    <div class="row">
                        <!-- Info -->
                        <div class="col-xl-12">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <p>Aqui pode verificar todos os tickets que estão em resolvidos ou fechados</p>
                                    <a href="./agent-panel/painel-agente.php" class="btn btn-dark">Voltar</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lista de Tickets do Utilizador -->
                    <h1 class="mt-2 mb-1">Tickets Fechados</h1>
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
                                echo '<div class="alert alert-info">Não existem tickets novos registados</div>'; //caso não haja tickets
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
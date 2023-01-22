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

<body>
    <div class="d-flex" id="wrapper">
        <?php include('../global-panel/components/sidebar-painel.php'); ?>
        <div class="bg-light" id="page-content-wrapper">
            <?php include('../global-panel/components/topnav-painel.php'); ?>
            <div class="container-fluid pt-2">
                <!-- INICIO DE CONTEUDO DE PAGINA -->

                <div class="container my-4 pt-5 sidebar-spacer">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <!-- LOGIN INFO -->
                            <h1 class="mb-3"><i class="bi bi-window"></i> Painel de Cliente</h1>

                            <!-- Breadcrumbs -->
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="./index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                </ol>
                            </nav>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <h3>Olá, <?php echo $_SESSION['nome'].' '.$_SESSION['apelido']; ?></h3>
                                    <span>Última sessão inciada a <?php echo $_SESSION['last_login']; ?></span>
                                    <!-- <a href="./components/logout.php" class="btn btn-dark">Terminar Sessão</a> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <!-- VISUALIZAR TICKETS -->
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Procurar Ticket</h3>
                                    <p>Caso o seu ticket não apareça na lista procure aqui através do ID</p>
                                    <a href="./global-panel/procurar-ticket.php" class="btn btn-success">Procurar</a>
                                </div>
                            </div>
                        </div>

                        <!-- SUBMETER TICKETS -->
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Criar Novo Ticket</h3>
                                    <p>Se precisar de apoio técnico crie um novo ticket</p>
                                    <a href="./user-panel/criar-ticket.php" class="btn btn-success">Criar Ticket</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MOSTRAR ULTIMOS 5 TICKETS EM TABELA -->
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-12">
                            <div class="card mt-3">
                                <div class="card-header">
                                    Últimos Tickets
                                </div>
                                <div class="card-body">
                                    <!-- GERA TABELA -->
                                    <?php if (count($latest) > 0) { ?>
                                        <!-- caso haja tickets definir tabela com os campos abaixo -->
                                        <table class="table table-striped align-middle">
                                            <thead class="table-dark">
                                                <tr>
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
                                                foreach ($latest as $k => $v) {
                                                    echo '
                                                <tr>
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
                                                        <a href="./user-panel/ticket.php?id=' . $v['id'] . '" class="btn btn-sm btn-success"><i class="bi bi-search"></i><a/> 
                                                    </td>
                                                </tr>
                                                ';}?>
                                            </tbody>
                                        </table>
                                    <?php } else {
                                        echo '<div class="alert alert-info">Não existem tickets</div>'; //caso não haja tickets
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FIM DE CONTEUDO DE PAGINA -->
            </div>

            <!-- Footer Panel -->
            <?php include('../components/panels/footer-panel.php'); ?>

        </div>
    </div>

    <!-- PAGE BOTTOM -->
    <?php include('../components/page-bottom.php'); ?>

</body>

</html>
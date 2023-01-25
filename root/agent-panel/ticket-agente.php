<?php
//TITULO PÁGINA
$page_title = 'Ticket -';

//HTML HEAD
include('../components/page-head.php');
?>

<?php
$success = false;
$error = false;

require_once('../int.php');
if (!isset($_GET['id'])) {
    if (!isset($_SESSION['agent_logged']) && $_SESSION['agent_logged'] != true) {
        header('Location: ./agent-panel/painel-agente.php');
    }
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

//Selecionar o ticket com base no ID
$ticket = '';
//$sql = "SELECT * FROM tickets WHERE id=" . $_GET['id'];
//$this_ticket_query = mysqli_query($dbconn, $sql);
$sql = "SELECT tickets.*, kb_categorias.nome_categoria FROM tickets LEFT JOIN kb_categorias ON kb_categorias.id = tickets.categoria WHERE tickets.id=" . $_GET['id'];
$this_ticket_query = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($dbconn), E_USER_ERROR);
if ($this_ticket_query->num_rows > 0) {
    while ($row = $this_ticket_query->fetch_assoc()) {
        $status = $row['status'];
        $prioridade = $row['prioridade'];
        $ticket = $row;
    }
} else {
    header('Location: ./agent-panel/painel-agente.php');
}

//Selecionar as respostas ao ticket com base no Ticket_ID
$ticket_id = $ticket['id'];
$reps = [];
$sql = "SELECT * FROM ticket_reply WHERE ticket_id=$ticket_id ORDER BY date DESC";
if ($ticket != '') {
    $replies = mysqli_query($dbconn, $sql);
    if ($replies->num_rows > 0) {
        while ($row = $replies->fetch_assoc()) {
            $reps[] = $row;
        }
    }
}

//Metodo Reply Send
if (isset($_POST['submit'])) {
    $message = $_POST['message'];
    $sql = "INSERT INTO ticket_reply (ticket_id,send_by,message) VALUES('$ticket_id','1','$message')";

    if (mysqli_query($dbconn, $sql)) {
        //$success = "Resposta enviada";
        //$sql = "UPDATE tickets SET status=1 WHERE id=$ticket_id";
        $sql = "UPDATE tickets SET status=1, date_reply=now() WHERE id=$ticket_id";
        mysqli_query($dbconn, $sql);
        echo "<meta http-equiv='refresh' content='0'>"; //atualiza pagina
    } else {
        $error = "Resposta não foi enviada";
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
                    <h1 class="mt-4">Ticket</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="./agent-panel/painel-agente.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Ticket ID <?php echo $ticket['ticket_id']; ?></li>
                    </ol>

                    <!-- MOSTRAR TICKET -->
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center">
                                    <span>Ticket ID</span>
                                    <span style="width: 85px;" class="badge bg-primary mx-2"><?php echo $ticket['ticket_id']; ?></span>
                                </div>
                                <div class="d-flex align-items-center">
                                    <span>Prioridade</span>
                                    <?php
                                    echo '
                                            <span style="width: 60px; "class="badge ' . (($prioridade == 0) ? "bg-success" : "bg-danger") . ' mx-2">' . (($prioridade == 0) ? $prioridade_0 : $prioridade_1) . '</span>
                                            ';
                                    //BOTAO ALTERAR PRIORIDADE TICKET
                                    if ($prioridade < 2) {
                                        echo '
                                                <a href="./agent-panel/ticket-prioridade.php?id=' . $_GET['id'] . '" target="_self" rel="noopener noreferrer" class="btn btn-secondary btn-sm me-3"><i class="bi bi-toggles"></i></a>
                                                ';
                                    } else if ($status >= 2) {
                                        echo '';
                                    } ?>
                                    <span>Estado</span>
                                    <?php
                                    echo '
                                            <span style="width: 65px;" class="badge ' . (($status == 0) ? "bg-info" : (($status == 1) ? "bg-warning" : "bg-dark")) . ' mx-2">' . (($status == 0) ? $estado_0 : (($status == 1) ? $estado_1 : $estado_2)) . '</span>
                                            ';
                                    //BOTAO FECHAR TICKET
                                    if ($status < 2) {
                                        echo '
                                                <a href="./agent-panel/fechar-ticket.php?id=' . $_GET['id'] . '" target="_self" rel="noopener noreferrer" class="btn btn-secondary btn-sm"><i class="bi bi-lock"></i></a>
                                                ';
                                    } else if ($status == 2) {
                                        echo '';
                                    } ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            if (isset($error) && $error != false) {
                                echo '<div class="alert alert-danger">' . $error . '</div>';
                            }
                            ?>
                            <?php
                            if (isset($success) && $success != false) {
                                //header("Location: ./user-panel/ticket.php?id=".$row['id']);
                                echo '<div class="alert alert-success">' . $success . '</div>';
                            }
                            ?>
                            <table class="table">
                                <tr>
                                    <th style="width:15% !important;">Nome</th>
                                    <td><?php echo $ticket['nome']; ?></td>
                                </tr>
                                <tr>
                                    <th>Telefone</th>
                                    <td><?php echo $ticket['telefone']; ?></td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td><?php echo $ticket['email']; ?></td>
                                </tr>
                                <tr>
                                    <th>Empresa</th>
                                    <td><?php echo $ticket['nome_empresa'] . ' -> ' . $ticket['dep_empresa']; ?></td>
                                </tr>
                                <tr>
                                    <th>Assunto</th>
                                    <td><?php echo $ticket['nome_categoria'] . ' -> ' . $ticket['assunto']; ?></td>
                                </tr>
                                <tr style="height: 100px;">
                                    <th>Descrição</th>
                                    <td>
                                        <p><?php echo $ticket['message']; ?></p>
                                    </td>
                                </tr>
                            </table>
                            <!-- <p><?php echo $ticket['message']; ?></p> -->
                            <div class="reply-area">
                                <ul>
                                    <?php if (count($reps) > 0) { ?>
                                        <?php foreach ($reps as $k => $v) {
                                            if ($v['send_by'] == 0) {
                                        ?>
                                                <li class="reply-user my-4">
                                                    <div class="card mb-3 bg-primary bg-opacity-25" style="border-radius: 0.80rem !important; width: 55%;">
                                                        <div class="card-body">
                                                            <p><?php echo $v['message']; ?></p>
                                                            <div class="text-end">
                                                                <small class="text-muted"><?php echo $v['date']; ?></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php
                                            } else {
                                            ?>
                                                <li class="reply-me my-4">
                                                    <div class="card mb-3 bg-secondary bg-opacity-25 float-end" style="border-radius: 0.80rem !important; width: 55%;">
                                                        <div class="card-body">
                                                            <p><?php echo $v['message']; ?></p>
                                                            <div class="text-end">
                                                                <small class="text-muted"><?php echo $v['date']; ?></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                        <?php
                                            }
                                        }
                                        ?>

                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="send-area">
                                <form method="POST">
                                    <div class="my-3">
                                        <textarea name="message" class="form-control" placeholder="Responder aqui" id="message" cols="30" rows="4"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <input type="hidden" name="submit" value="send">
                                        <button class="btn btn-success" type="submit">Enviar</button>
                                        <a href="./agent-panel/painel-agente.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>
                                    </div>
                                </form>
                            </div>
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
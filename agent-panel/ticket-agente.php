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
$sql = "SELECT * FROM ticket_reply WHERE ticket_id=$ticket_id";
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

<body>
    <div class="d-flex" id="wrapper">
        <?php include('../global-panel/components/sidebar-painel.php'); ?>
        <div class="bg-light" id="page-content-wrapper">
            <?php include('../global-panel/components/topnav-painel.php'); ?>
            <div class="container-fluid">
                <!-- INICIO DE CONTEUDO DE PAGINA -->

                <div class="container mt-4">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-12">

                            <!-- LOGIN INFO -->
                            <h1 class="mb-3"><i class="bi bi-window"></i> Visualizar Ticket</h1>

                            <!-- CRIAR TICKET FORM -->
                            <div class="card mb-3">
                                <div class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <span>ID Ticket : </span>
                                            <small class="d-inline-flex px-2 py-1 fw-semibold text-primary bg-primary bg-opacity-10 border border-primary border-opacity-10 rounded-2"><?php echo $ticket['ticket_id']; ?></small>
                                        </div>
                                        <div class="text-end">
                                            <span>Prioridade : </span>
                                            <?php
                                            echo '
                                            <small class="d-inline-flex px-2 py-1 fw-semibold 
                                                                ' . (($prioridade == 0) ? "text-success bg-success" : "text-danger bg-danger") . '
                                                                bg-opacity-10 border 
                                                                ' . (($prioridade == 0) ? "border-success" : "border-danger") . '
                                                                border-opacity-10 rounded-2 me-3">' . (($prioridade == 0) ? $prioridade_0 : $prioridade_1) . '
                                            </small>
                                            ';
                                            //BOTAO ALTERAR PRIORIDADE TICKET
                                            if ($prioridade < 2) {
                                                echo '
                                                <a href="./agent-panel/ticket-prioridade.php?id='.$_GET['id'].'" target="_self" rel="noopener noreferrer" class="btn btn-secondary btn-sm"><i class="bi bi-toggles"></i></a>
                                                ';
                                            } else if ($status >= 2) {
                                                echo '';
                                            }?>
                                            <span>  Estado : </span>
                                            <?php
                                            echo '
                                            <small class="d-inline-flex px-2 py-1 fw-semibold 
                                                                ' . (($status == 0) ? "text-info bg-info" : (($status == 1) ? "text-warning bg-warning" : "text-dark bg-dark")) . '
                                                                bg-opacity-10 border 
                                                                ' . (($status == 0) ? "border-info" : (($status == 1) ? "border-warning" : "border-dark")) . '
                                                                border-opacity-10 rounded-2">' . (($status == 0) ? $estado_0 : (($status == 1) ? $estado_1 : $estado_2)) . '
                                            </small>
                                            ';
                                            //BOTAO FECHAR TICKET
                                            if ($status < 2) {
                                                echo '
                                                <a href="./agent-panel/fechar-ticket.php?id='.$_GET['id'].'" target="_self" rel="noopener noreferrer" class="btn btn-secondary btn-sm"><i class="bi bi-lock"></i></a>
                                                ';
                                            } else if ($status == 2) {
                                                echo '';
                                            }?>
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
                                            <th>Nome</th>
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
                                            <td><?php echo $ticket['nome_empresa'].' -> '.$ticket['dep_empresa']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Assunto</th>
                                            <td><?php echo $ticket['nome_categoria'].' -> '.$ticket['assunto']; ?></td>
                                        </tr>
                                        <tr>
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
                                                        <li class="reply-user">
                                                            <div class="card mb-3 bg-primary bg-opacity-25 w-75">
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
                                                        <li class="reply-me">
                                                            <div class="card mb-3 bg-secondary bg-opacity-25 w-75 float-end">
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
                                    <!-- TODO: Resolver problema com linha separadora -->
                                    <hr class="my-3 form-control">
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
<?php
/* ###

COMPONENTE: PRIORIDADE TICKET
DESCRIÇÃO: Altera a prioridade do ticket para "Normal" ou "Alto"

### */

require_once('../int.php');
if (!isset($_SESSION['agent_logged']) && $_SESSION['agent_logged'] != true) {
    header('Location: ../login.php');
}

$db = new DB();
$dbconn = $db->conn;

//Selecionar o ticket com base no ID
$ticket = '';
$sql = "SELECT * FROM tickets WHERE id=" . $_GET['id'];
$this_ticket_query = mysqli_query($dbconn, $sql);
if ($this_ticket_query->num_rows > 0) {
    while ($row = $this_ticket_query->fetch_assoc()) {
        $prioridade = $row['prioridade'];
        $ticket = $row;
    }
} else {
    header('Location: ./agent-panel/painel-agente.php');
}

if ($prioridade == 0) {
    //Subir prioridade
    $sql = "UPDATE tickets SET prioridade=1 WHERE id=" . $_GET['id'];
    $inset = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($dbconn), E_USER_ERROR);

    if ($inset) {
        $success = 'Prioridade de ticket alterada com sucesso';
        //header('Location: ./agent-panel/painel-agente.php?status=ticketprioritychange');
        header("Location: ../agent-panel/ticket-agente.php?id=".$_GET['id']);
    } else {
        $error = 'Não foi possivel alterar a prioridade do ticket, por favor tente mais tarde';
        echo $error;
    }
} else if ($prioridade == 1) {
    //Descer prioridade
    $sql = "UPDATE tickets SET prioridade=0 WHERE id=" . $_GET['id'];
    $inset = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($dbconn), E_USER_ERROR);

    if ($inset) {
        $success = 'Prioridade de ticket alterada com sucesso';
        //header('Location: ./agent-panel/painel-agente.php?status=ticketprioritychange');
        header("Location: ../agent-panel/ticket-agente.php?id=".$_GET['id']);
    } else {
        $error = 'Não foi possivel alterar a prioridade do ticket, por favor tente mais tarde';
        echo $error;
    }
}

?>
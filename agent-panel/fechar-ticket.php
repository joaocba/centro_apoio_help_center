<?php
/* ###

COMPONENTE: FECHAR TICKET
DESCRIÇÃO: Altera o estado do ticket para "Fechado"

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
        $ticket = $row;
    }
} else {
    header('Location: ../agent-panel/painel-agente.php');
}

//Fechar Ticket
$sql = "UPDATE tickets SET status=2 WHERE id=" . $_GET['id'];
$inset = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($dbconn), E_USER_ERROR);

if ($inset) {
    $success = 'Ticket fechado com sucesso';
    header('Location: ../agent-panel/painel-agente.php?status=ticketclosed');
} else {
    $error = 'Não foi possivel fechar o ticket, por favor tente mais tarde';
    echo $error;
    //header('Location: ./painel-agent.php?status=ticketclosed');
}
?>
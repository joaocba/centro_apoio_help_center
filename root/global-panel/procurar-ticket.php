<?php
//TITULO PÁGINA
$page_title = 'Procurar Ticket -';

//HTML HEAD
include('../components/page-head.php');
?>

<?php
$success = false;
$error = false;
require_once('../int.php');

if(!isset($_SESSION['role'])){
    if(!isset($_SESSION['user_logged']) && $_SESSION['user_logged'] != true){
        header('Location: ../login.php');
    }elseif(!isset($_SESSION['agent_logged']) && $_SESSION['agent_logged'] != true){
        header('Location: ../login.php');
    }elseif(!isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] != true){
        header('Location: ../login.php');
    }
}

//Pesquisa tickets tendo em conta o id do user
if(isset($_SESSION['role']) && $_SESSION['role'] < 1){
    if (isset($_POST['id'])) {
        $db = new DB();
        $dbconn = $db->conn;
        $sql = "SELECT * FROM tickets WHERE ticket_id='" . $_POST['id'] . "' AND user_id='" . $_SESSION['id'] . "'";

        $ticket_q = mysqli_query($dbconn, $sql);
        if ($ticket_q->num_rows > 0) {
            while ($row  = $ticket_q->fetch_assoc()) {
                header("Location: ../user-panel/ticket.php?id=" . $row['id']);
            }
        } else {
            $error = "ID do ticket inválido ou inexistente"; //mensagem de erro
        }
    }
//Pesquisa tickets sem verificar id do user (para Painel Agente/Admin)
}elseif(isset($_SESSION['role']) && $_SESSION['role'] > 0){
    if (isset($_POST['id'])) {
        $db = new DB();
        $dbconn = $db->conn;
        $sql = "SELECT * FROM tickets WHERE ticket_id='" . $_POST['id'] . "'";

        $ticket_q = mysqli_query($dbconn, $sql);
        if ($ticket_q->num_rows > 0) {
            while ($row  = $ticket_q->fetch_assoc()) {
                header("Location: ../user-panel/ticket.php?id=" . $row['id']);
            }
        } else {
            $error = "ID do ticket inválido ou inexistente"; //mensagem de erro
        }
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

                            <!-- INFO -->
                            <?php
                            if(isset($_SESSION['role'])){
                                if(isset($_SESSION['user_logged']) && $_SESSION['user_logged'] == true){
                                    echo '<h1 class="mb-3"><i class="bi bi-window"></i> Painel de Cliente</h1>';
                                }elseif(isset($_SESSION['agent_logged']) && $_SESSION['agent_logged'] == true){
                                    echo '<h1 class="mb-3"><i class="bi bi-window"></i> Painel de Agente</h1>';
                                }elseif(isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] == true){
                                    echo '<h1 class="mb-3"><i class="bi bi-window"></i> Painel de Administrador</h1>';
                                }
                            }
                            ?>

                            <!-- PROCURAR TICKET -->
                            <form method="POST">
                                <div class="card mb-3">
                                    <div class="card-header">Procurar Ticket</div>
                                    <div class="card-body">
                                        <?php
                                        if (isset($error) && $error != false) {
                                            echo '<div class="alert alert-danger">' . $error . '</div>';
                                        }
                                        ?>
                                        <?php
                                        if (isset($success) && $success != false) {
                                            echo '<div class="alert alert-success">' . $success . '</div>';
                                        }
                                        ?>
                                        <div class="mb-3">
                                            <label class="form-label">Insira o ID do Ticket</label>
                                            <input type="text" name="id" id="id" placeholder="Exemplo: 20e95376c1" class="form-control" required >
                                        </div>
                                        <div class="">
                                            <button class="btn btn-success">Submeter</button>
                                            <a href="./user-panel/painel-cliente.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
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

if (!isset($_SESSION['role'])) {
    if (!isset($_SESSION['user_logged']) && $_SESSION['user_logged'] != true) {
        header('Location: ../login.php');
    } elseif (!isset($_SESSION['agent_logged']) && $_SESSION['agent_logged'] != true) {
        header('Location: ../login.php');
    } elseif (!isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] != true) {
        header('Location: ../login.php');
    }
}

//Pesquisa tickets tendo em conta o id do user
if (isset($_SESSION['role']) && $_SESSION['role'] < 1) {
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
} elseif (isset($_SESSION['role']) && $_SESSION['role'] > 0) {
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
                    <?php
                    if (isset($_SESSION['role'])) {
                        if (isset($_SESSION['user_logged']) && $_SESSION['user_logged'] == true) {
                            echo '
                                <h1 class="mt-4">Ticket</h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="../user-panel/painel-cliente.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Procurar Ticket</li>
                                </ol>
                                ';
                        } elseif (isset($_SESSION['agent_logged']) && $_SESSION['agent_logged'] == true) {
                            echo '
                                <h1 class="mt-4">Ticket</h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="../agent-panel/painel-agente.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Procurar Ticket</li>
                                </ol>
                                ';
                        } elseif (isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] == true) {
                            echo '
                                <h1 class="mt-4">Ticket</h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="../admin-panel/painel-admin.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Procurar Ticket</li>
                                </ol>
                                ';
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
                                    <input type="text" name="id" id="id" placeholder="Exemplo: 20e95376c1" class="form-control" required>
                                </div>
                                <div class="">
                                    <button class="btn btn-success">Submeter</button>
                                    <a href="../user-panel/painel-cliente.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>
                                </div>
                            </div>
                        </div>
                    </form>

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
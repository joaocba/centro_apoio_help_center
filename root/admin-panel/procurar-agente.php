<?php
//TITULO PÁGINA
$page_title = 'Procurar Agente -';

//HTML HEAD
include('../components/page-head.php');
?>

<?php
$success = false;
$error = false;
require_once('../int.php');

if (!isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] != true) {
    header('Location: ../login.php');
}

$db = new DB();
$dbconn = $db->conn;

//PROCURAR UTILIZADOR POR EMAIL
if (isset($_POST['submit'])) {

    $sql = "SELECT * FROM users WHERE role=1 AND email='" . $_POST['email'] . "'";

    //$inset = mysqli_query($dbconn, $sql);
    $inset = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($dbconn), E_USER_ERROR);
    if ($inset->num_rows > 0) {
        while ($row = $inset->fetch_assoc()) {
            //$userid = $row['id'];
            //header("Location: ./admin-panel/cliente.php?id=' . $userid.'");
            header("Location: ../admin-panel/agente.php?id=" . $row['id']);
        }
        //header("Location: ./admin-panel/cliente.php?id=' . $userid.'");
    } else {
        $error = "Email invalido ou inexistente"; //mensagem de erro
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
                            <h1 class="mb-3"><i class="bi bi-window"></i> Painel de Administrador</h1>

                            <!-- PROCURAR AGENTE -->
                            <form method="POST">
                                <div class="card mb-3">
                                    <div class="card-header">Procurar Agente</div>
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
                                            <label class="form-label">Insira o email do cliente</label>
                                            <input type="email" name="email" id="email" placeholder="Exemplo: utilizador@mail.com" class="form-control" required >
                                        </div>
                                        <div class="">
                                            <button class="btn btn-success" type="submit" name="submit">Submeter</button>
                                            <a href="./admin-panel/gerir-agentes.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>
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
<?php
//TITULO PÁGINA
$page_title = 'Procurar Cliente -';

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

    $sql = "SELECT * FROM users WHERE role=0 AND email='" . $_POST['email'] . "'";

    //$inset = mysqli_query($dbconn, $sql);
    $inset = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($dbconn), E_USER_ERROR);
    if ($inset->num_rows > 0) {
        while ($row = $inset->fetch_assoc()) {
            //$userid = $row['id'];
            //header("Location: ./admin-panel/cliente.php?id=' . $userid.'");
            header("Location: ../admin-panel/cliente.php?id=" . $row['id']);
        }
        //header("Location: ./admin-panel/cliente.php?id=' . $userid.'");
    } else {
        $error = "Email invalido o inexistente"; //mensagem de erro
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
                    <h1 class="mt-4">Gestão Clientes</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="./admin-panel/painel-admin.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="./admin-panel/gerir-clientes.php">Gerir Clientes</a></li>
                        <li class="breadcrumb-item active">Procurar Cliente</li>
                    </ol>

                    <!-- PROCURAR CLIENTE -->
                    <form method="POST">
                        <div class="card mb-3">
                            <div class="card-header">Procurar Cliente</div>
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
                                    <input type="email" name="email" id="email" placeholder="Exemplo: utilizador@mail.com" class="form-control" required>
                                </div>
                                <div class="">
                                    <button class="btn btn-success" type="submit" name="submit">Submeter</button>
                                    <a href="./admin-panel/gerir-clientes.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>
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
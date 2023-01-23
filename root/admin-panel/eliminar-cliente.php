<?php
//TITULO PÁGINA
$page_title = 'Eliminar Cliente -';

//HTML HEAD
include('../components/page-head.php');
?>

<?php
require_once('../int.php');
if (!isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] != true) {
    header('Location: ./login.php');
}

$db = new DB();
$dbconn = $db->conn;

//Selecionar o cliente com base no ID
$user = '';
$sql = "SELECT * FROM users WHERE role=0 AND id=" . $_GET['id'];
$this_user_query = mysqli_query($dbconn, $sql);
if ($this_user_query->num_rows > 0) {
    while ($row = $this_user_query->fetch_assoc()) {
        $user_id = $row['id'];
        $nome = $row['nome'];
        $apelido = $row['apelido'];
        $email = $row['email'];
    }
} else {
    header('Location: ./admin-panel/painel-admin.php');
}

//Eliminar registo de cliente
if (isset($_POST['submit'])) {

    $sql = "DELETE FROM users WHERE role=0 AND id=" . $_GET['id'];
    $inset = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($dbconn), E_USER_ERROR);

    if ($inset) {
        $success = 'Registo eliminado com sucesso';
        header('Location: ../admin-panel/gerir-clientes.php?status=userdeleted');
    } else {
        $error = 'Não foi possivel eliminar o registo, por favor tente mais tarde';
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
                        <li class="breadcrumb-item active">Eliminar Cliente <?php echo $nome . ' ' . $apelido; ?></li>
                    </ol>

                    <!-- MOSTRAR PERFIL -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <form method="POST">
                                <h4>Pretende eliminar o registo do cliente <?php echo $nome . ' ' . $apelido; ?> (ID: <?php echo $user_id; ?>) com o Email: <?php echo $email; ?></h4>
                                <div class="">
                                    <button class="btn btn-danger" type="submit" name="submit">Confimar</button>
                                    <a href="./admin-panel/gerir-clientes.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>
                                </div>
                            </form>
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
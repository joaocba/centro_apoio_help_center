<?php
//TITULO PÁGINA
$page_title = 'Eliminar Agente -';

//HTML HEAD
include('../components/page-head.php');
?>

<?php
require_once('../int.php');
if (!isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] != true) {
    header('Location: ../login.php');
}

$db = new DB();
$dbconn = $db->conn;

//Selecionar o agente com base no ID
$user = '';
$sql = "SELECT * FROM users WHERE role=1 AND id=" . $_GET['id'];
$this_user_query = mysqli_query($dbconn, $sql);
if ($this_user_query->num_rows > 0) {
    while ($row = $this_user_query->fetch_assoc()) {
        $user_id = $row['id'];
        $nome = $row['nome'];
        $apelido = $row['apelido'];
        $email = $row['email'];
    }
} else {
    header('Location: ../admin-panel/painel-admin.php');
}

//Eliminar registo de agente
if (isset($_POST['submit'])) {

    $sql = "DELETE FROM users WHERE role=1 AND id=" . $_GET['id'];
    $inset = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($dbconn), E_USER_ERROR);

    if ($inset) {
        $success = 'Registo eliminado com sucesso';
        header('Location: ../admin-panel/gerir-agentes.php?status=userdeleted');
    } else {
        $error = 'Não foi possivel eliminar o registo, por favor tente mais tarde';
    }
}
?>

<body>
    <div class="d-flex" id="wrapper">
        <?php include('./global-panel/components/sidebar-painel.php'); ?>
        <div class="bg-light" id="page-content-wrapper">
            <?php include('./global-panel/components/topnav-painel.php'); ?>
            <div class="container-fluid">
                <!-- INICIO DE CONTEUDO DE PAGINA -->

                <!-- PAGINA PRINCIPAL - UTILIZADOR -->
                <div class="container mt-4">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-12">

                            <!-- INFO -->
                            <h1 class="mb-3"><i class="bi bi-window"></i> Painel de Administrador</h1>

                            <!-- MOSTRAR PERFIL -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <form method="POST">
                                        <h4>Pretende eliminar o registo do agente <?php echo $nome. ' ' .$apelido; ?> (ID: <?php echo $user_id; ?>) com o Email: <?php echo $email; ?></h4>
                                        <div class="">
                                            <button class="btn btn-danger" type="submit" name="submit">Confimar</button> 
                                            <a href="./admin-panel/gerir-agentes.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>
                                        </div>
                                    </form>
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
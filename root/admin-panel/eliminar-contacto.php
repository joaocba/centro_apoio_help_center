<?php
//TITULO PÁGINA
$page_title = 'Eliminar Contacto -';

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

//Selecionar o contacto com base no ID
$contact = '';
$sql = "SELECT * FROM phone_list WHERE id=" . $_GET['id'];
$this_contact_query = mysqli_query($dbconn, $sql);
if ($this_contact_query->num_rows > 0) {
    while ($row = $this_contact_query->fetch_assoc()) {
        $id = $row['id'];
        $colaborador = $row['colaborador'];
        $email = $row['email'];
    }
} else {
    header('Location: ./admin-panel/painel-admin.php');
}

//Eliminar registo de contacto
if (isset($_POST['submit'])) {

    $sql = "DELETE FROM phone_list WHERE id=" . $_GET['id'];
    $inset = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($dbconn), E_USER_ERROR);

    if ($inset) {
        $success = 'Registo eliminado com sucesso';
        header('Location: ../admin-panel/gerir-contactos.php?status=contactdeleted');
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
                    <h1 class="mt-4">Gestão Contactos</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="./admin-panel/painel-admin.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="./admin-panel/gerir-contactos.php">Gerir Contactos</a></li>
                        <li class="breadcrumb-item active">Eliminar Contacto <?php echo $colaborador; ?></li>
                    </ol>

                    <!-- MENSAGEM CONFIRMA ELIMINAR -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <form method="POST">
                                <h4>Pretende eliminar o registo do contacto <?php echo $colaborador; ?> (Email: <?php echo $email; ?>)</h4>
                                <div class="">
                                    <button class="btn btn-danger" type="submit" name="submit">Confimar</button>
                                    <a href="./admin-panel/gerir-contactos.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>
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
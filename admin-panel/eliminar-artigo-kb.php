<?php
//TITULO PÁGINA
$page_title = 'Eliminar Artigo -';

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

//Selecionar o artigo com base no ID
$sql = "SELECT * FROM kb_artigos WHERE id=" . $_GET['id'];
$this_art_query = mysqli_query($dbconn, $sql);
if ($this_art_query->num_rows > 0) {
    while ($row = $this_art_query->fetch_assoc()) {
        $art_id = $row['id'];
        $art_cat_id = $row['cat_id'];
        $art_assunto = $row['assunto'];
        $art_descricao = $row['descricao'];
        $art_keywords = $row['keywords'];
    }
} else {
    header('Location: ../admin-panel/painel-admin.php');
}

//Eliminar artigo
if (isset($_POST['submit'])) {

    $sql = "DELETE FROM kb_artigos WHERE id=" . $_GET['id'];
    $inset = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($dbconn), E_USER_ERROR);

    if ($inset) {
        $success = 'Artigo eliminado com sucesso';
        header('Location: ../admin-panel/gerir-kb.php?status=artdeleted');
    } else {
        $error = 'Não foi possivel eliminar o artigo, por favor tente mais tarde';
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
                                        <h4>Pretende eliminar o artigo <?php echo $art_assunto; ?>?</h4>
                                        <div class="">
                                            <button class="btn btn-danger" type="submit" name="submit">Confimar</button> 
                                            <a href="./admin-panel/gerir-kb.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>
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
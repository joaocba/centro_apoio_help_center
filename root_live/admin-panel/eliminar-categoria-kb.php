<?php
//TITULO PÁGINA
$page_title = 'Eliminar Categoria -';

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

//Selecionar o categoria com base no ID
$sql = "SELECT * FROM kb_categorias WHERE id=" . $_GET['id'];
$this_cat_query = mysqli_query($dbconn, $sql);
if ($this_cat_query->num_rows > 0) {
    while ($row = $this_cat_query->fetch_assoc()) {
        $cat_id = $row['id'];
        $cat_nome = $row['nome_categoria'];
        $cat_desc = $row['descricao_categoria'];
    }
} else {
    header('Location: ../admin-panel/painel-admin.php');
}

//Eliminar categoria
if (isset($_POST['submit'])) {

    $sql = "DELETE FROM kb_categorias WHERE id=" . $_GET['id'];
    $inset = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($dbconn), E_USER_ERROR);

    if ($inset) {
        $success = 'Categoria eliminada com sucesso';
        header('Location: ../admin-panel/gerir-kb.php?status=catdeleted');
    } else {
        $error = 'Não foi possivel eliminar a categoria, por favor tente mais tarde';
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
                    <h1 class="mt-4">Gestão Knowledge Base</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="../admin-panel/painel-admin.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="../admin-panel/gerir-kb.php">Gerir KB</a></li>
                        <li class="breadcrumb-item active">Eliminar Categoria > <?php echo $cat_nome; ?></li>
                    </ol>

                    <!-- ELIMINAR CATEGORIA -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <form method="POST">
                                <h4>Pretende eliminar a categoria <?php echo $cat_nome; ?>? Atenção que irá também remover todos os artigos associados à categoria</h4>
                                <div class="">
                                    <button class="btn btn-danger" type="submit" name="submit">Confimar</button>
                                    <a href="../admin-panel/gerir-kb.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>
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
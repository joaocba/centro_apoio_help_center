<?php
//TITULO PÁGINA
$page_title = 'Knowledge Base -';

//HTML HEAD
include('../components/page-head.php');
?>

<?php
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

//LISTAR CATEGORIAS
$categorias = [];

$db = new DB();
$dbconn = $db->conn;

$sql = "SELECT * FROM kb_categorias";
$result = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($dbconn), E_USER_ERROR);
if ($result->num_rows > 0) {
    while ($row_cat = $result->fetch_assoc()) {
        $categorias[] = $row_cat;
    }
} else {
    $error = "Não foram encontrados categorias";
}


//LISTAR ARTIGOS
/*
$artigos = [];

$sql = "SELECT * FROM kb_artigos";
$result = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($dbconn), E_USER_ERROR);
if ($result->num_rows > 0) {
    while ($row_art = $result->fetch_assoc()) {
        //echo "<script>alert('".$row['categoria'] . '  ' . $row['assunto'] . '  ' . $row['descricao'] . '<br>'."');</script>";
        $artigos[] = $row_art;
    }
} else {
    $error = "Não foram encontrados artigos";
}
*/
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
                            <h1 class="mb-3"><i class="bi bi-info-circle"></i> Knowledge Base</h1>

                            <!-- LISTA DE ARTIGOS -->
                            <div class="card">
                                <div class="card-header"> Consulta de artigos de apoio</div>
                                <div class="card-body">

                                    <!-- CAIXA DE ALERTAS -->
                                    <?php
                                    if (isset($error) && $error != false) {
                                        echo '<div class="alert alert-danger">' . $error . '</div>';
                                    }
                                    ?>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-12">
                                            <?php include('../global-panel/components/kb/kb-nav-scroll.php'); ?>
                                        </div>
                                        <div class="col-lg-9 col-md-9 col-sm-12" style="height: 70vh; overflow-y: auto;">
                                            <?php include('../global-panel/components/kb/kb-artigos-scroll.php'); ?>
                                        </div>
                                    </div>

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
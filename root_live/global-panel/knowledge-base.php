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
                                <h1 class="mt-4">Knowledge Base</h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="../user-panel/painel-cliente.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Knowledge Base</li>
                                </ol>
                                ';
                        } elseif (isset($_SESSION['agent_logged']) && $_SESSION['agent_logged'] == true) {
                            echo '
                                <h1 class="mt-4">Knowledge Base</h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="../agent-panel/painel-agente.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Knowledge Base</li>
                                </ol>
                                ';
                        } elseif (isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] == true) {
                            echo '
                                <h1 class="mt-4">Knowledge Base</h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="../admin-panel/painel-admin.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Knowledge Base</li>
                                </ol>
                                ';
                        }
                    }
                    ?>

                    <!-- LISTA DE ARTIGOS -->
                    <div class="card mb-3">
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
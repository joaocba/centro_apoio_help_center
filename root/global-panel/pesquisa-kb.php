<?php
//TITULO PÁGINA
$page_title = 'Pesquisar KB -';

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

//SEARCH KEYWORD ENGINE
$artigos = [];
if (isset($_POST['submit'])) {

    $db = new DB();
    $dbconn = $db->conn;

    $aKeyword = explode(" ", $_POST['search']);
    $sql = "SELECT * FROM kb_artigos INNER JOIN kb_categorias ON kb_artigos.cat_id = kb_categorias.id WHERE keywords LIKE '%" . $aKeyword[0] . "%'";

    for ($i = 1; $i < count($aKeyword); $i++) {
        if (!empty($aKeyword[$i])) {
            $sql .= " OR keywords LIKE '%" . $aKeyword[$i] . "%'";
        }
    }


    $result = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($dbconn), E_USER_ERROR);

    //Contagem de artigos encontrados
    $contar_artigos = mysqli_num_rows($result);

    if ($result->num_rows > 0) {
        $success = "Foram encontrados " . $contar_artigos . " artigo(s) para a sua pesquisa";
        while ($row = $result->fetch_assoc()) {
            //echo "<script>alert('".$row['categoria'] . '  ' . $row['assunto'] . '  ' . $row['descricao'] . '<br>'."');</script>";
            $artigos[] = $row;
        }
    } else {
        $error = "Não foram encontrados artigos para a sua pesquisa";
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
                                <h1 class="mt-4">Knowledge Base</h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="./user-panel/painel-cliente.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Procurar Artigos</li>
                                </ol>
                                ';
                        } elseif (isset($_SESSION['agent_logged']) && $_SESSION['agent_logged'] == true) {
                            echo '
                                <h1 class="mt-4">Knowledge Base</h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="./agent-panel/painel-agente.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Procurar Artigos</li>
                                </ol>
                                ';
                        } elseif (isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] == true) {
                            echo '
                                <h1 class="mt-4">Knowledge Base</h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="./admin-panel/painel-admin.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Procurar Artigos</li>
                                </ol>
                                ';
                        }
                    }
                    ?>

                    <!-- PESQUISAR NA KB -->
                    <form method="POST">
                        <div class="card mb-3">
                            <div class="card-header"> Pesquisar na Knowledge Base</div>
                            <div class="card-body">

                                <!-- SEARCH BOX -->
                                <div class="row mb-3">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label class="form-label">Palavras chave<span class="text-danger"></span></label>
                                        <input class="form-control" type="text" name="search" id="search" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-12 col-md-12">
                                        <div class="text-right">
                                            <input type="hidden" name="submit" value="form">
                                            <button class="btn btn-success" type="submit">Pesquisar</button>
                                            <a href="./user-panel/painel-cliente.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- RESULTADOS DA PESQUISA -->
                    <div class="card mb-3">
                        <div class="card-header"> Resultado da pesquisa</div>
                        <div class="card-body">

                            <!-- CAIXA DE ALERTAS -->
                            <?php
                            if (isset($success) && $success != false) {
                                echo '<div class="alert alert-success">' . $success . '</div>';
                            }
                            ?>

                            <!-- DISPLAY BOX COM CARD -->
                            <?php if (count($artigos) > 0) { ?>
                                <div class="row row-cols-1 row-cols-md-1 g-4">
                                    <?php foreach ($artigos as $k => $v) { ?>
                                        <div class="col">
                                            <div class="card h-100">
                                                <h5 class="card-header"><?php echo $v['nome_categoria']; ?></h5>
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo $v['assunto']; ?></h5>
                                                    <p class="card-text"><?php echo $v['descricao']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            <?php
                            } else {
                                if (isset($error) && $error != false) {
                                    echo '<div class="alert alert-danger">' . $error . '</div>';
                                } else {
                                    echo '<div class="alert alert-info">Inicie a pesquisa</div>';
                                }
                            }
                            ?>

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
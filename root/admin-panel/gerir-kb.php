<?php
//TITULO PÁGINA
$page_title = 'Gerir Knowledge Base -';

//HTML HEAD
include('../components/page-head.php');
?>

<?php
require_once('../int.php');

//VERIFICAR SESSAO
if (!isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] != true) {
    header('Location: ../login.php');
}


$db = new DB();
$dbconn = $db->conn;

//MOSTRAR CATEGORIAS
$latest_cat = [];
$sql = "SELECT * FROM kb_categorias ORDER BY id ASC LIMIT 15";
$recodes = mysqli_query($dbconn, $sql);

if ($recodes->num_rows > 0) {
    while ($row = $recodes->fetch_assoc()) {
        $latest_cat[] = $row;
    }
}


//MOSTRAR ARTIGOS
$latest_art = [];
$sql = "SELECT kb_artigos.*, kb_categorias.nome_categoria FROM kb_artigos LEFT JOIN kb_categorias ON kb_categorias.id = kb_artigos.cat_id ORDER BY kb_artigos.id ASC LIMIT 15";
$recodes = mysqli_query($dbconn, $sql);

if ($recodes->num_rows > 0) {
    while ($row = $recodes->fetch_assoc()) {
        $latest_art[] = $row;
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
                        <li class="breadcrumb-item"><a href="./admin-panel/painel-admin.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Gerir Knowledge Base</li>
                    </ol>

                    <!-- Cards de Acesso -->
                    <div class="row">
                        <!-- Criar Categoria -->
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3>Criar Categoria</h3>
                                    <p>Crie nova categoria de artigos</p>
                                    <a href="./admin-panel/criar-categoria-kb.php" class="btn btn-success">Criar Categoria</a>
                                </div>
                            </div>
                        </div>
                        <!-- Criar Artigo -->
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3>Criar Artigo</h3>
                                    <p>Crie novo artigo</p>
                                    <a href="./admin-panel/criar-artigo-kb.php" class="btn btn-success">Criar Artigo</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lista de Categorias Registados -->
                    <h1 class="mt-2 mb-1">Categorias</h1>
                    <div class="text-muted">
                        Lista de categorias disponiveis
                    </div>
                    <div class="bg-light my-3">
                        <ul class="list-group">

                            <!-- CAIXA DE ALERTA -->
                            <?php
                            //mensagem de categoria criada
                            if (!empty($_GET['status']) && ($_GET['status'] == "catcreated")) {
                                echo '<div class="alert alert-success text-center">Categoria criada com sucesso</div>';
                            }
                            ?>

                            <?php
                            //mensagem de categoria alterada
                            if (!empty($_GET['status']) && ($_GET['status'] == "catupdated")) {
                                echo '<div class="alert alert-success text-center">Categoria alterada com sucesso</div>';
                            }
                            ?>

                            <?php
                            //mensagem de categoria removida
                            if (!empty($_GET['status']) && ($_GET['status'] == "catdeleted")) {
                                echo '<div class="alert alert-success text-center">Categoria removida com sucesso</div>';
                            }
                            ?>

                            <!-- Cabeçalho da lista -->
                            <div class="d-none d-lg-block list-group-item bg-dark text-white mb-2">
                                <div class="container-fluid">
                                    <div class="row justify-content-between">
                                        <div class="col-lg-1 col-sm-12" style="width:4% !important;">
                                            <small>#</small>
                                        </div>
                                        <div class="col-lg-3 col-sm-12">
                                            <small>Nome</small>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <small>Descrição</small>
                                        </div>
                                        <div class="col-lg-2 col-sm-12">
                                            <small>Ações</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Gerar Lista de Categorias -->
                            <?php if (count($latest_cat) > 0) {
                                $contador = count($latest_cat);
                                foreach ($latest_cat as $k => $v) {
                                    echo '
                                    <li class="list-group-item list-group-item-action my-1" aria-current="true">
                                        <div class="container-fluid">
                                            <div class="row d-flex justify-content-between align-items-center py-3">
                                                <div class="col-lg-1 col-sm-12" style="width:4% !important;">
                                                    <span class="text-muted"><small># ' . ($contador > 0 ? $contador-- : $contador = 0) . '</small></span>
                                                </div>
                                                <div class="col-lg-3 col-sm-12">
                                                    <small class="d-lg-none">Nome:</small>
                                                    <span>' . $v['nome_categoria'] . '</span>
                                                </div>
                                                <div class="col-lg-6 col-sm-12">
                                                    <small class="d-lg-none">Descrição:</small>
                                                    <span>' . $v['descricao_categoria'] . '</span>
                                                </div>
                                                <div class="col-lg-2 col-sm-12">
                                                    <a class="btn btn-sm btn-primary px-3" href="./admin-panel/editar-categoria-kb.php?id=' . $v['id'] . '"><i class="bi bi-pen"></i></a> 
                                                    <a class="btn btn-sm btn-danger px-3" href="./admin-panel/eliminar-categoria-kb.php?id=' . $v['id'] . '"><i class="bi bi-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                ';
                                }
                            } else {
                                echo '<div class="alert alert-info">Não existem categorias criadas</div>'; //caso não haja tickets
                            } ?>
                        </ul>
                    </div>

                    <!-- Lista de Artigos Registados -->
                    <h1 class="mt-2 mb-1">Artigos</h1>
                    <div class="text-muted">
                        Lista de artigos disponiveis
                    </div>
                    <div class="bg-light my-3">
                        <ul class="list-group">

                            <!-- CAIXA DE ALERTA -->
                            <?php
                            //mensagem de categoria criada
                            if (!empty($_GET['status']) && ($_GET['status'] == "catcreated")) {
                                echo '<div class="alert alert-success text-center">Artigo criado com sucesso</div>';
                            }
                            ?>

                            <?php
                            //mensagem de categoria alterada
                            if (!empty($_GET['status']) && ($_GET['status'] == "catupdated")) {
                                echo '<div class="alert alert-success text-center">Artigo alterado com sucesso</div>';
                            }
                            ?>

                            <?php
                            //mensagem de categoria removida
                            if (!empty($_GET['status']) && ($_GET['status'] == "catdeleted")) {
                                echo '<div class="alert alert-success text-center">Artigo removido com sucesso</div>';
                            }
                            ?>

                            <!-- Cabeçalho da lista -->
                            <div class="d-none d-lg-block list-group-item bg-dark text-white mb-2">
                                <div class="container-fluid">
                                    <div class="row justify-content-between">
                                        <div class="col-lg-1 col-sm-12" style="width:4% !important;">
                                            <small>#</small>
                                        </div>
                                        <div class="col-lg-1 col-sm-12">
                                            <small>Categoria</small>
                                        </div>
                                        <div class="col-lg-2 col-sm-12">
                                            <small>Assunto</small>
                                        </div>
                                        <div class="col-lg-6 col-sm-12">
                                            <small>Descrição</small>
                                        </div>
                                        <div class="col-lg-2 col-sm-12">
                                            <small>Ações</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Gerar Lista de Artigos -->
                            <?php if (count($latest_art) > 0) {
                                $contador = count($latest_art);
                                foreach ($latest_art as $k => $v) {
                                    echo '
                                    <li class="list-group-item list-group-item-action my-1" aria-current="true">
                                        <div class="container-fluid">
                                            <div class="row d-flex justify-content-between align-items-center py-3">
                                                <div class="col-lg-1 col-sm-12" style="width:4% !important;">
                                                    <span class="text-muted"><small># ' . ($contador > 0 ? $contador-- : $contador = 0) . '</small></span>
                                                </div>
                                                <div class="col-lg-1 col-sm-12">
                                                    <small class="d-lg-none">Categoria:</small>
                                                    <span>' . $v['nome_categoria'] . '</span>
                                                </div>
                                                <div class="col-lg-2 col-sm-12">
                                                    <small class="d-lg-none">Assunto:</small>
                                                    <span>' . $v['assunto'] . '</span>
                                                </div>
                                                <div class="col-lg-6 col-sm-12">
                                                    <small class="d-lg-none">Descrição:</small>
                                                    <!--<span>' . $v['descricao'] . '</span>-->
                                                    <span>' . substr($v['descricao'], 0, 80) .((strlen($v['descricao']) > 80) ? '...' : '') . '</span>
                                                </div>
                                                <div class="col-lg-2 col-sm-12">
                                                    <a class="btn btn-sm btn-primary px-3" href="./admin-panel/editar-artigo-kb.php?id=' . $v['id'] . '"><i class="bi bi-pen"></i></a> 
                                                    <a class="btn btn-sm btn-danger px-3" href="./admin-panel/eliminar-artigo-kb.php?id=' . $v['id'] . '"><i class="bi bi-trash"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                ';
                                }
                            } else {
                                echo '<div class="alert alert-info">Não existem artigos disponiveis</div>'; //caso não haja tickets
                            } ?>
                        </ul>
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
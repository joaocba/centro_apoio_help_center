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

<body>
    <div class="d-flex" id="wrapper">
        <?php include('../global-panel/components/sidebar-painel.php'); ?>
        <div class="bg-light" id="page-content-wrapper">
            <?php include('../global-panel/components/topnav-painel.php'); ?>
            <div class="container-fluid">
                <!-- INICIO DE CONTEUDO DE PAGINA -->

                <div class="container my-4">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <!-- LOGIN INFO -->
                            <h1 class="mb-3"><i class="bi bi-window"></i> Painel de Administrador</h1>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <!-- CRIAR CATEGORIA -->
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Criar Categoria</h3>
                                    <p>Crie nova categoria de artigos</p>
                                    <a href="./admin-panel/criar-categoria-kb.php" class="btn btn-success">Criar Categoria</a>
                                </div>
                            </div>
                        </div>

                        <!-- CRIAR ARTIGO -->
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Criar Artigo</h3>
                                    <p>Crie novo artigo</p>
                                    <a href="./admin-panel/criar-artigo-kb.php" class="btn btn-success">Criar Artigo</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MOSTRAR ULTIMOS 5 TICKETS EM TABELA -->
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-12">
                            <div class="card mt-3">
                                <div class="card-header">
                                    Categorias
                                </div>
                                <div class="card-body">
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

                                    <!-- GERA TABELA CATEGORIAS -->
                                    <?php if (count($latest_cat) > 0) { ?>
                                        <table class="table table-striped align-middle css-serial" id="component_id2">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nome</th>
                                                    <th class="w-50">Descrição</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($latest_cat as $k => $v) {
                                                    echo '
                                                <tr>
                                                    <td></td>
                                                    <td>' . $v['nome_categoria'] . '</td>
                                                    <td>' . $v['descricao_categoria'] . '</td>
                                                    <td>
                                                        <a href="./admin-panel/editar-categoria-kb.php?id=' . $v['id'] . '" class="btn btn-sm btn-primary"><i class="bi bi-pen"></i><a/> 
                                                        <a href="./admin-panel/eliminar-categoria-kb.php?id=' . $v['id'] . '" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i><a/>
                                                    </td>
                                                </tr>
                                                ';}?>
                                            </tbody>
                                        </table>
                                    <?php } else {
                                        echo '<div class="alert alert-info">Não existem categorias</div>';
                                    } ?>
                                </div>
                            </div>

                            <div class="card mt-3">
                                <div class="card-header">
                                    Artigos
                                </div>
                                <div class="card-body">
                                    <!-- CAIXA DE ALERTA -->
                                    <?php
                                    //mensagem de artigo criado
                                    if (!empty($_GET['status']) && ($_GET['status'] == "artcreated")) {
                                        echo '<div class="alert alert-success text-center">Artigo criado com sucesso</div>';
                                    }
                                    ?>

                                    <?php
                                    //mensagem de artigo alterado
                                    if (!empty($_GET['status']) && ($_GET['status'] == "artupdated")) {
                                        echo '<div class="alert alert-success text-center">Artigo alterado com sucesso</div>';
                                    }
                                    ?>

                                    <?php
                                    //mensagem de artigo removido
                                    if (!empty($_GET['status']) && ($_GET['status'] == "artdeleted")) {
                                        echo '<div class="alert alert-success text-center">Artigo removido com sucesso</div>';
                                    }
                                    ?>

                                    <!-- GERA TABELA ARTIGOS -->
                                    <?php if (count($latest_art) > 0) { ?>
                                        <table class="table table-striped align-middle css-serial" id="component_id">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Categoria</th>
                                                    <th class="w-25">Assunto</th>
                                                    <th class="w-50">Descrição</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($latest_art as $k => $v) {
                                                    echo '
                                                <tr>
                                                    <td></td>
                                                    <td>' . $v['nome_categoria'] . '</td>
                                                    <td>' . $v['assunto'] . '</td>
                                                    <td>' . $v['descricao'] . '</td>
                                                    <td>
                                                        <a href="./admin-panel/editar-artigo-kb.php?id=' . $v['id'] . '" class="btn btn-sm btn-primary"><i class="bi bi-pen"></i><a/> 
                                                        <a href="./admin-panel/eliminar-artigo-kb.php?id=' . $v['id'] . '" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i><a/>
                                                    </td>
                                                </tr>
                                                ';}?>
                                            </tbody>
                                        </table>
                                    <?php } else {
                                        echo '<div class="alert alert-info">Não existem artigos</div>';
                                    } ?>
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
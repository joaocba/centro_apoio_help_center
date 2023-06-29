<?php
//TITULO PÁGINA
$page_title = 'Criar Artigo -';

//HTML HEAD
include('../components/page-head.php');
?>

<?php
$success = false;
$error = false;
require_once('../int.php');
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

//CRIAR ARTIGO
if (isset($_POST['submit'])) {

    //vars associadas ao formulario
    $art_cat_id_novo = $_POST['art_cat_id'];
    $art_assunto_novo = $_POST['art_assunto'];
    $art_descricao_novo = $_POST['art_descricao'];
    $art_keywords_novo = $_POST['art_keywords'];

    $sql = "INSERT INTO kb_artigos (cat_id,assunto,descricao,keywords) VALUES ('$art_cat_id_novo','$art_assunto_novo','$art_descricao_novo','$art_keywords_novo')";

    $result = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($dbconn), E_USER_ERROR);
    if ($result) {
        $success = 'Artigo criado com sucesso';

        header('Location: ../admin-panel/gerir-kb.php?status=artcreated');
    } else {
        $error = 'Não foi possivel criar o artigo, por favor tente mais tarde';
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
                        <li class="breadcrumb-item active">Novo Artigo</li>
                    </ol>

                    <!-- CRIAR ARTIGO FORMULARIO -->
                    <form method="POST">
                        <div class="card mb-3">
                            <div class="card-body">

                                <?php
                                if (isset($error) && $error != false) {
                                    echo '<div class="alert alert-danger">' . $error . '</div>'; //box com mensagem de erro
                                }
                                ?>
                                <?php
                                if (isset($success) && $success != false) {
                                    echo '<div class="alert alert-success">' . $success . '</div>'; //box com mensagem de sucesso
                                }
                                ?>

                                <div class="profile-input-field">
                                    <h3>Criar Artigo</h3>
                                    <form method="post" onSubmit="return validate();">
                                        <h5>Informações Artigo</h5>
                                        <div class="row mb-3">
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <label for="art_cat_id" class="form-label">Categoria:<span class="text-danger">*</span></label>
                                                <?php if (count($latest_cat) > 0) { ?>
                                                    <select class="form-select" name="art_cat_id" id="art_cat_id" required>
                                                        <option selected>Escolha uma categoria</option>
                                                        <?php
                                                        foreach ($latest_cat as $k => $v) {
                                                            echo '
                                                                    <option value="' . $v['id'] . '">' . $v['nome_categoria'] . '</option>
                                                                    ';
                                                        } ?>
                                                    </select>
                                                <?php } else {
                                                    echo '<div class="alert alert-info">Não existem categorias</div>';
                                                } ?>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <label for="art_assunto" class="form-label">Assunto:<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="art_assunto" name="art_assunto" required>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col col-lg-6 col-md-6 col-sm-12">
                                                <label for="art_descricao" class="form-label">Descrição:<span class="text-danger">*</span></label><br>
                                                <span class="text-muted">Edição suporta tags de HTML</span>
                                                <textarea name="art_descricao" class="form-control" id="art_descricao" cols="30" rows="5" required></textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-lg-4 col-md-4 col-sm-12">
                                                <label for="art_keywords" class="form-label">Palavras-chave:<span class="text-danger">*</span></label>
                                                <span class="text-muted">Separar cada palavra-chave por virgulas</span>
                                                <input type="text" class="form-control" id="art_keywords" name="art_keywords" required>
                                            </div>
                                        </div>

                                        <div class="">
                                            <button class="btn btn-success" type="submit" name="submit">Submeter</button>
                                            <a href="../admin-panel/gerir-kb.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </form>

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
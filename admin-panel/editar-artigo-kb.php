<?php
//TITULO PÁGINA
$page_title = 'Editar Artigo -';

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

//Selecionar o artigo com base no ID
//$sql = "SELECT * FROM kb_artigos WHERE id=" . $_GET['id'];
$sql = "SELECT kb_artigos.*, kb_categorias.nome_categoria FROM kb_artigos LEFT JOIN kb_categorias ON kb_categorias.id = kb_artigos.cat_id WHERE kb_artigos.id=" . $_GET['id'];
$this_art_query = mysqli_query($dbconn, $sql);
if ($this_art_query->num_rows > 0) {
    while ($row = $this_art_query->fetch_assoc()) {
        $art_id = $row['id'];
        $art_cat_id = $row['cat_id'];
        $art_cat_nome = $row['nome_categoria'];
        $art_assunto = $row['assunto'];
        $art_descricao = $row['descricao'];
        $art_keywords = $row['keywords'];
    }
} else {
    header('Location: ../admin-panel/painel-admin.php');
}

if (isset($_POST['submit'])) {

    //vars associadas ao formulario
    $art_cat_id_novo = $_POST['art_cat_id'];
    $art_assunto_novo = $_POST['art_assunto'];
    $art_descricao_novo = $_POST['art_descricao'];
    $art_keywords_novo = $_POST['art_keywords'];

    //$sql = "UPDATE kb_categorias SET nome_categoria='$cat_nome_novo', descricao_categoria='$cat_descricao_novo' WHERE id=" . $_GET['id'];
    $sql = "UPDATE kb_artigos SET cat_id='$art_cat_id_novo', assunto='$art_assunto_novo', descricao='$art_descricao_novo', keywords='$art_keywords_novo' WHERE id=" . $_GET['id'];

    //$inset = mysqli_query($dbconn, $sql);
    //para detetar erros
    $inset = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($dbconn), E_USER_ERROR);

    if ($inset) {
        $success = 'Artigo atualizado com sucesso';

        header('Location: ../admin-panel/gerir-kb.php?status=artupdated');
    } else {
        $error = 'Não foi possivel atualizar o artigo, por favor tente mais tarde';
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

                            <!-- EDITAR PERFIL FORMULARIO -->
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
                                            <h3>Editar Artigo</h3>
                                            <form method="post" onSubmit="return validate();">
                                                <h5>Informações Artigo > <?php echo $art_assunto; ?></h5>

                                                <div class="row mb-3">
                                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                                        <label for="art_cat_id" class="form-label">Categoria:<span class="text-danger">*</span></label>
                                                            <?php if (count($latest_cat) > 0) { ?>
                                                            <select class="form-select" name="art_cat_id" id="art_cat_id" required>
                                                                <option value="<?php echo $art_cat_id; ?>" selected><?php echo $art_cat_nome; ?></option>
                                                                <?php
                                                                foreach ($latest_cat as $k => $v) {
                                                                    echo '
                                                                    <option value="'. $v['id'] .'">'.$v['nome_categoria'].'</option>
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
                                                        <input type="text" class="form-control" id="art_assunto" name="art_assunto" value="<?php echo $art_assunto; ?>" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col col-lg-6 col-md-6 col-sm-12">
                                                        <label for="art_descricao" class="form-label">Descrição:<span class="text-danger">*</span></label><br>
                                                        <span class="text-muted">Edição suporta tags de HTML</span>
                                                        <textarea name="art_descricao" class="form-control" id="art_descricao" cols="30" rows="5" required><?php echo $art_descricao; ?></textarea>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                                        <label for="art_keywords" class="form-label">Palavras-chave:<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="art_keywords" name="art_keywords" value="<?php echo $art_keywords; ?>" required>
                                                    </div>
                                                </div>

                                                <div class="">
                                                    <button class="btn btn-success" type="submit" name="submit">Submeter</button>
                                                    <a href="./admin-panel/gerir-kb.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </form>
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
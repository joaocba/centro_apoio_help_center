<?php
//TITULO PÁGINA
$page_title = 'Editar Categoria -';

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
    header('Location: ./admin-panel/painel-admin.php');
}

if (isset($_POST['submit'])) {

    //vars associadas ao formulario
    $cat_nome_novo = $_POST['cat_nome'];
    $cat_descricao_novo = $_POST['cat_desc'];

    $sql = "UPDATE kb_categorias SET nome_categoria='$cat_nome_novo', descricao_categoria='$cat_descricao_novo' WHERE id=" . $_GET['id'];
    //$inset = mysqli_query($dbconn, $sql);
    //para detetar erros
    $inset = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($dbconn), E_USER_ERROR);

    if ($inset) {
        $success = 'Categoria atualizada com sucesso';

        header('Location: ../admin-panel/gerir-kb.php?status=catupdated');
    } else {
        $error = 'Não foi possivel atualizar a categoria, por favor tente mais tarde';
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
                                            <h3>Editar Categoria</h3>
                                            <form method="post" onSubmit="return validate();">
                                                <h5>Informações Categoria > <?php echo $cat_nome; ?></h5>
                                                <div class="row mb-3">
                                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                                        <label for="cat_nome" class="form-label">Nome:<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="cat_nome" name="cat_nome" value="<?php echo $cat_nome; ?>" required>

                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col col-lg-6 col-md-6 col-sm-12">
                                                        <label for="cat_desc" class="form-label">Descrição:<span class="text-danger">*</span></label>
                                                        <textarea name="cat_desc" class="form-control" id="cat_desc" cols="30" rows="5" required><?php echo $cat_desc; ?></textarea>
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
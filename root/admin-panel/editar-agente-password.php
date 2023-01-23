<?php
//TITULO PÁGINA
$page_title = 'Alterar Password -';

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
$userid = $_GET['id'];

if (isset($_POST['submit'])) {

    //vars associadas ao formulario
    $password_novo = sha1($_POST['password']);

    $sql = "UPDATE users SET password='$password_novo' WHERE id='$userid'";
    //$inset = mysqli_query($dbconn, $sql);
    //para detetar erros
    $inset = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($dbconn), E_USER_ERROR);

    if ($inset) {
        $success = 'Perfil atualizado com sucesso para o agente ' . $nome . ' ' . $apelido;

        header('Location: ../admin-panel/agente.php?id=' . $userid . '&status=updated');
    } else {
        $error = 'Não foi possivel atualizar o perfil, por favor tente mais tarde';
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
                    <h1 class="mt-4">Gestão Agentes</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="./admin-panel/painel-admin.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="./admin-panel/gerir-agentes.php">Gerir Agentes</a></li>
                        <li class="breadcrumb-item active">Editar Perfil Agente</li>
                    </ol>

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
                                    <h3>Editar Perfil</h3>
                                    <form method="post" onSubmit="return validate();">
                                        <h5>Alterar Password</h5>
                                        <div class="row mb-3">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <label for="password" class="form-label">Nova Password:<span class="text-danger">*</span></label>
                                                <input type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Deve conter pelo menos um número, uma letra maiuscula e minuscula, e 8 ou mais caracteres" placeholder="Insira a nova password" aria-label="Password" id="password" name="password" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <label for="confirm_password" class="form-label"> Confirma Nova Password:<span class="text-danger">*</span></label>
                                                <input type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Deve conter pelo menos um número, uma letra maiuscula e minuscula, e 8 ou mais caracteres" placeholder="Confirme a nova password" aria-label="confirm_password" id="confirm_password" name="confirm_password" required>
                                            </div>
                                        </div>

                                        <div class="">
                                            <button class="btn btn-danger" type="submit" name="submit">Alterar Password</button>
                                            <a href="./admin-panel/cliente.php?id=<?php echo $userid; ?>" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>
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
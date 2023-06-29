<?php
//TITULO PÁGINA
$page_title = 'Registar Contacto -';

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

if (isset($_POST['submit'])) {

    //dados de registo de contacto:
    $colaborador = $_POST['colaborador'];
    $departamento = $_POST['departamento'];
    $num_directo = $_POST['num_directo'];
    $curto_fixo = $_POST['curto_fixo'];
    $telemovel = $_POST['telemovel'];
    $curto_movel = $_POST['curto_movel'];
    $email = $_POST['email'];


    $db = new DB();
    $dbconn = $db->conn;

    $sql = "INSERT INTO phone_list (colaborador,departamento,num_directo,curto_fixo,telemovel,curto_movel,email) VALUES ('$colaborador','$departamento','$num_directo','$curto_fixo','$telemovel','$curto_movel','$email')";

    $result = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($dbconn), E_USER_ERROR);
    if ($result) {
        $success = 'Registo de contacto criado com sucesso';

        header('Location: ../admin-panel/gerir-contactos.php?status=contactcreated');
    } else {
        $error = 'Não foi possivel registar contacto, por favor tente mais tarde';
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
                    <h1 class="mt-4">Gestão Contactos</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="./admin-panel/painel-admin.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="./admin-panel/gerir-contactos.php">Gerir Contactos</a></li>
                        <li class="breadcrumb-item active">Registar Novo Contacto</li>
                    </ol>

                    <!-- REGISTAR CONTACTO FORMULARIO -->
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
                                    <h3>Registar Contacto</h3>
                                    <form method="post" onSubmit="return validate();">
                                    <h5>Dados Colaborador</h5>
                                        <div class="row mb-3">
                                            <div class="col-lg-3 col-sm-12">
                                                <label for="colaborador" class="form-label">Nome:<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="colaborador" name="colaborador" required>

                                            </div>
                                            <div class="col col-lg-3 col-sm-12">
                                                <label for="departamento" class="form-label">Departamento<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="departamento" name="departamento" required>
                                            </div>
                                        </div>

                                        <h5>Dados Contacto</h5>
                                        <div class="row mb-3">
                                            <div class="col-lg-3 col-sm-12">
                                                <label for="num_directo" class="form-label">Nº Direto Fixo:</label>
                                                <input type="text" class="form-control" id="num_directo" name="num_directo">
                                            </div>
                                            <div class="col-lg-2 col-sm-12">
                                                <label for="curto_fixo" class="form-label">Nº Curto Fixo:</label>
                                                <input type="text" class="form-control" id="curto_fixo" name="curto_fixo">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                        <div class="col-lg-3 col-sm-12">
                                                <label for="telemovel" class="form-label">Nº Direto Móvel:</label>
                                                <input type="text" class="form-control" id="telemovel" name="telemovel">
                                            </div>
                                            <div class="col-lg-2 col-sm-12">
                                                <label for="curto_movel" class="form-label">Nº Curto Móvel:</label>
                                                <input type="text" class="form-control" id="curto_movel" name="curto_movel">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-6 col-sm-12">
                                                <label for="email" class="form-label">Email:<span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" id="email" name="email" required>
                                            </div>
                                        </div>

                                        <div class="">
                                            <button class="btn btn-success" type="submit" name="submit">Submeter Registo</button>
                                            <a href="./admin-panel/gerir-contactos.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>
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
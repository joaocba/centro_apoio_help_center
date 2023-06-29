<?php
//TITULO PÁGINA
$page_title = 'Editar Contacto -';

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

//Selecionar o contacto com base no ID
$contact = '';
$sql = "SELECT * FROM phone_list WHERE id=" . $_GET['id'];
$this_contact_query = mysqli_query($dbconn, $sql);
if ($this_contact_query->num_rows > 0) {
    while ($row = $this_contact_query->fetch_assoc()) {
        $id = $row['id'];
        $colaborador = $row['colaborador'];
        $departamento = $row['departamento'];
        $num_directo = $row['num_directo'];
        $curto_fixo = $row['curto_fixo'];
        $telemovel = $row['telemovel'];
        $curto_movel = $row['curto_movel'];
        $email = $row['email'];
    }
} else {
    header('Location: ./admin-panel/painel-admin.php');
}

if (isset($_POST['submit'])) {

    //vars associadas ao formulario
    $colaborador_novo = $_POST['colaborador'];
    $departamento_novo = $_POST['departamento'];
    $num_directo_novo = $_POST['num_directo'];
    $curto_fixo_novo = $_POST['curto_fixo'];
    $telemovel_novo = $_POST['telemovel'];
    $curto_movel_novo = $_POST['curto_movel'];
    $email_novo = $_POST['email'];

    $sql = "UPDATE phone_list SET colaborador='$colaborador_novo', departamento='$departamento_novo', num_directo='$num_directo_novo', curto_fixo='$curto_fixo_novo', telemovel='$telemovel_novo', curto_movel='$curto_movel_novo', email='$email_novo' WHERE id=" . $_GET['id'];
    $inset = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($dbconn), E_USER_ERROR);

    if ($inset) {
        $success = 'Registo atualizado com sucesso para o colaborador ' . $colaborador;

        header('Location: ../admin-panel/gerir-contactos.php?status=contactupdated');
    } else {
        $error = 'Não foi possivel atualizar o contacto, por favor tente mais tarde';
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
                        <li class="breadcrumb-item"><a href="../admin-panel/painel-admin.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="../admin-panel/gerir-contactos.php">Gerir Contactos</a></li>
                        <li class="breadcrumb-item active">Editar Contacto <?php echo $colaborador; ?></li>
                    </ol>

                    <!-- EDITAR CONTACTO FORMULARIO -->
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
                                    <h3>Editar Contacto</h3>
                                    <form method="post" onSubmit="return validate();">
                                        <h5>Dados Colaborador</h5>
                                        <div class="row mb-3">
                                            <div class="col-lg-3 col-sm-12">
                                                <label for="colaborador" class="form-label">Nome:<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="colaborador" name="colaborador" value="<?php echo $colaborador; ?>" required>

                                            </div>
                                            <div class="col col-lg-3 col-sm-12">
                                                <label for="departamento" class="form-label">Departamento<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="departamento" name="departamento" value="<?php echo $departamento; ?>" required>
                                            </div>
                                        </div>

                                        <h5>Dados Contacto</h5>
                                        <div class="row mb-3">
                                            <div class="col-lg-3 col-sm-12">
                                                <label for="num_directo" class="form-label">Nº Direto Fixo:<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="num_directo" name="num_directo" value="<?php echo $num_directo; ?>" required>
                                            </div>
                                            <div class="col-lg-2 col-sm-12">
                                                <label for="curto_fixo" class="form-label">Nº Curto Fixo:<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="curto_fixo" name="curto_fixo" value="<?php echo $curto_fixo; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                        <div class="col-lg-3 col-sm-12">
                                                <label for="telemovel" class="form-label">Nº Direto Móvel:<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="telemovel" name="telemovel" value="<?php echo $telemovel; ?>" required>
                                            </div>
                                            <div class="col-lg-2 col-sm-12">
                                                <label for="curto_movel" class="form-label">Nº Curto Móvel:<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="curto_movel" name="curto_movel" value="<?php echo $curto_movel; ?>" required>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-6 col-sm-12">
                                                <label for="email" class="form-label">Email:<span class="text-danger">*</span></label>
                                                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                                            </div>
                                        </div>

                                        <div class="">
                                            <button class="btn btn-success" type="submit" name="submit">Submeter</button>
                                            <a href="../admin-panel/gerir-contactos.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>
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
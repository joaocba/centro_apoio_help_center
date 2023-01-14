<?php
//TITULO PÁGINA
$page_title = 'Perfil Cliente -';

//HTML HEAD
include('../components/page-head.php');
?>

<?php
require_once('../int.php');
if (!isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] != true) {
    header('Location: ../login.php');
}

$db = new DB();
$dbconn = $db->conn;

//Selecionar o cliente com base no ID
//$user = '';
$sql = "SELECT * FROM users WHERE role=0 AND id=" . $_GET['id'];
$this_user_query = mysqli_query($dbconn, $sql);
if ($this_user_query->num_rows > 0) {
    while ($row = $this_user_query->fetch_assoc()) {
        //$user = $row;

        $user_id = $row['id'];
        $nome = $row['nome'];
        $apelido = $row['apelido'];
        $data_nascimento = $row['data_nascimento'];
        $telefone = $row['telefone'];
        $morada = $row['morada'];
        $cod_postal = $row['cod_postal'];
        $cidade = $row['cidade'];
        $email = $row['email'];
        $nome_empresa = $row['nome_empresa'];
        $local_empresa = $row['local_empresa'];
        $dep_empresa = $row['dep_empresa'];
    }
} else {
    header('Location: ../admin-panel/painel-admin.php');
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

                            <!-- MOSTRAR PERFIL -->
                            <div class="card mb-3">
                                <div class="card-body">

                                    <!-- CAIXA DE ALERTA -->
                                    <?php
                                    //mensagem de conta criada com sucesso
                                    if (!empty($_GET['status']) && ($_GET['status'] == "updated")) {
                                        echo '<div class="alert alert-success text-center">Perfil atualizado com sucesso</div>';
                                    }
                                    ?>

                                    <h3>Perfil</h3>
                                    <div class="row mb-3">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label class="text-muted fs-6">Nome Completo</label>
                                            <p class="fs-5"><?php echo $nome . ' ' . $apelido; ?></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label class="text-muted fs-6">Data Nascimento</label>
                                            <p class="fs-5"><?php echo $data_nascimento; ?></p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label class="text-muted fs-6">Telefone</label>
                                            <p class="fs-5"><?php echo $telefone; ?></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label class="text-muted fs-6">Morada</label>
                                            <p class="fs-5"><?php echo $morada . ' ' . $cod_postal . ' ' . $cidade; ?></p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label class="text-muted fs-6">Email</label>
                                            <p class="fs-5"><?php echo $email; ?></p>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label class="text-muted fs-6">Empresa</label>
                                            <p class="fs-5"><?php echo $nome_empresa . ' (' . $local_empresa . ')'; ?></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label class="text-muted fs-6">Departamento</label>
                                            <p class="fs-5"><?php echo $dep_empresa; ?></p>
                                        </div>
                                    </div>
                                    <div class="">
                                        <a href="./admin-panel/editar-cliente.php?id=<?php echo $user_id; ?>" target="_self" rel="noopener noreferrer" class="btn btn-success">Editar Perfil</a>
                                        <a href="./admin-panel/editar-cliente-password.php?id=<?php echo $user_id; ?>" target="_self" rel="noopener noreferrer" class="btn btn-danger">Alterar Password</a>
                                        <a href="./admin-panel/eliminar-cliente.php?id=<?php echo $user_id; ?>" target="_self" rel="noopener noreferrer" class="btn btn-danger">Eliminar Registo</a>
                                        <a href="./admin-panel/gerir-clientes.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>
                                    </div>
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
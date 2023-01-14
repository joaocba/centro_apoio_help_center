<?php
//TITULO PÁGINA
$page_title = 'Editar Cliente -';

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

//Selecionar o cliente com base no ID
$user = '';
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
    header('Location: ./admin-panel/painel-admin.php');
}

if (isset($_POST['submit'])) {

    //vars associadas ao formulario
    $email_novo = $_POST['email'];
    //$password_novo = sha1($_POST['password']);
    $nome_novo = $_POST['nome'];
    $apelido_novo = $_POST['apelido'];
    $telefone_novo = $_POST['telefone'];
    $morada_novo = $_POST['morada'];
    $cod_postal_novo = $_POST['cod_postal'];
    $cidade_novo = $_POST['cidade'];
    $nome_empresa_novo = $_POST['nome_empresa'];
    $local_empresa_novo = $_POST['local_empresa'];
    $dep_empresa_novo = $_POST['dep_empresa'];

    $sql = "UPDATE users SET email='$email_novo', nome='$nome_novo', apelido='$apelido_novo', telefone='$telefone_novo', morada='$morada_novo', cod_postal='$cod_postal_novo', cidade='$cidade_novo', nome_empresa='$nome_empresa_novo', local_empresa='$local_empresa_novo', dep_empresa='$dep_empresa_novo' WHERE role=0 AND id=" . $_GET['id'];
    //$inset = mysqli_query($dbconn, $sql);
    //para detetar erros
    $inset = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($dbconn), E_USER_ERROR);

    if ($inset) {
        $success = 'Perfil atualizado com sucesso para o cliente ' . $nome . ' ' . $apelido;

        header('Location: ../admin-panel/gerir-clientes.php?status=userupdated');
    } else {
        $error = 'Não foi possivel atualizar o perfil, por favor tente mais tarde';
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
                                            <h3>Editar Perfil Cliente</h3>
                                            <form method="post" onSubmit="return validate();">
                                                <h5>Dados Pessoais</h5>
                                                <div class="row mb-3">
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <label for="nome" class="form-label">Nome:<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $nome; ?>" required>

                                                    </div>
                                                    <div class="col col-lg-6 col-md-6 col-sm-12">
                                                        <label for="apelido" class="form-label">Apelido<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="apelido" name="apelido" value="<?php echo $apelido; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <label for="data_nascimento" class="form-label">Data Nascimento:<span class="text-danger">*</span></label>
                                                        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="<?php echo $data_nascimento; ?>"required>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <label for="telefone" class="form-label">Telefone:<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="telefone" name="telefone" pattern="[0-9]{9}" value="<?php echo $telefone; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <label for="morada" class="form-label">Morada:<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="morada" name="morada" value="<?php echo $morada; ?>" required>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                        <label for="cod_postal" class="form-label">Codigo Postal:<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="cod_postal" name="cod_postal" value="<?php echo $cod_postal; ?>" required>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-2">
                                                        <label for="cidade" class="form-label">Localidade:<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="cidade" name="cidade" value="<?php echo $cidade; ?>" required>
                                                    </div>
                                                </div>

                                                <h5>Dados Conta Cliente</h5>
                                                <div class="row mb-3">
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <label for="email" class="form-label">Email:<span class="text-danger">*</span></label>
                                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                                                    </div>
                                                </div>

                                                <h5>Dados Empresa</h5>
                                                <div class="row mb-3">
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <label for="nome_empresa" class="form-label">Nome Empresa:<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="nome_empresa" name="nome_empresa" value="<?php echo $nome_empresa; ?>" required>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                                        <label for="local_empresa" class="form-label">Localização:<span class="text-danger">*</span></label>
                                                        <select class="form-select" id="local_empresa" name="local_empresa" required>
                                                            <option selected value="<?php echo $local_empresa; ?>"><?php echo $local_empresa; ?></option>
                                                            <option valeu='Aveiro'>Aveiro</option>
                                                            <option valeu='Braga'>Braga</option>
                                                            <option valeu='Faro'>Faro</option>
                                                            <option valeu='Leiria'>Leiria</option>
                                                            <option valeu='Lisboa'>Lisboa</option>
                                                            <option valeu='Porto'>Porto</option>
                                                            <option valeu='Santarém'>Mérida(Espanha)</option>
                                                            <option valeu='Viseu'>Viseu</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                                        <label for="dep_empresa" class="form-label">Departamento:<span class="text-danger">*</span></label>
                                                        <select class="form-select" id="dep_empresa" name="dep_empresa" required>
                                                            <option selected value="<?php echo $dep_empresa; ?>"><?php echo $dep_empresa; ?></option>
                                                            <option valeu='Aveiro'>Oficina</option>
                                                            <option valeu='Braga'>Financeiro</option>
                                                            <option valeu='Faro'>Contabilidade</option>
                                                            <option valeu='Leiria'>Técnico</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="">
                                                    <button class="btn btn-success" type="submit" name="submit">Submeter</button>
                                                    <a href="./admin-panel/cliente.php?id=<?php echo $user_id; ?>" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>
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
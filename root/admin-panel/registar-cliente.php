<?php
//TITULO PÁGINA
$page_title = 'Registar Cliente -';

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

    //dados pessoais cliente:
    $nome = $_POST['nome'];
    $apelido = $_POST['apelido'];
    $data_nascimento = $_POST['data_nascimento'];
    $telefone = $_POST['telefone'];
    $morada = $_POST['morada'];
    $cod_postal = $_POST['cod_postal'];
    $cidade = $_POST['cidade'];

    //dados acesso conta:
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    //dados empresa:
    $nome_empresa = $_POST['nome_empresa'];
    $local_empresa = $_POST['local_empresa'];
    $dep_empresa = $_POST['dep_empresa'];

    //iniciar comunicação à BD
    $db = new DB();
    $dbconn = $db->conn;

    $sql = "INSERT INTO users (email,password,role,last_login,nome,apelido,data_nascimento,telefone,morada,cod_postal,cidade,nome_empresa,local_empresa,dep_empresa) VALUES ('$email','$password',0,now(),'$nome','$apelido','$data_nascimento','$telefone','$morada','$cod_postal','$cidade','$nome_empresa','$local_empresa','$dep_empresa')";


    $result = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($dbconn), E_USER_ERROR);
    if ($result) {
        $success = 'Registo de cliente criado com sucesso';

        header('Location: ../admin-panel/gerir-clientes.php?status=usercreated');
    } else {
        $error = 'Não foi possivel registar cliente, por favor tente mais tarde';
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

                            <!-- REGISTAR CLIENTE FORMULARIO -->
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
                                            <h3>Registar Cliente</h3>
                                            <form method="post" onSubmit="return validate();">
                                                <h5>Dados Pessoais</h5>
                                                <div class="row mb-3">
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <label for="nome" class="form-label">Nome:<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="nome" name="nome" required>

                                                    </div>
                                                    <div class="col col-lg-6 col-md-6 col-sm-12">
                                                        <label for="apelido" class="form-label">Apelido<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="apelido" name="apelido" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <label for="data_nascimento" class="form-label">Data Nascimento:<span class="text-danger">*</span></label>
                                                        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <label for="telefone" class="form-label">Telefone:<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="telefone" name="telefone" pattern="[0-9]{9}" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <label for="morada" class="form-label">Morada:<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="morada" name="morada" required>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                                        <label for="cod_postal" class="form-label">Codigo Postal:<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="cod_postal" name="cod_postal" required>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-2">
                                                        <label for="cidade" class="form-label">Localidade:<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="cidade" name="cidade" required>
                                                    </div>
                                                </div>

                                                <h5>Dados Conta Cliente</h5>
                                                <div class="row mb-3">
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <label for="email" class="form-label">Email:<span class="text-danger">*</span></label>
                                                        <input type="email" class="form-control" id="email" name="email" required>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <label for="password" class="form-label">Password:<span class="text-danger">*</span></label>
                                                        <input type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Deve conter pelo menos um número, uma letra maiuscula e minuscula, e 8 ou mais caracteres" placeholder="Insira a seu Password" aria-label="Password" id="password" name="password" required>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <label for="confirm_password" class="form-label"> Confirma Password:<span class="text-danger">*</span></label>
                                                        <input type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Deve conter pelo menos um número, uma letra maiuscula e minuscula, e 8 ou mais caracteres" placeholder="Confirme a sua Password" aria-label="confirm_password" id="confirm_password" name="confirm_password" required>
                                                    </div>
                                                </div>

                                                <h5>Dados Empresa</h5>
                                                <div class="row mb-3">
                                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                                        <label for="nome_empresa" class="form-label">Nome Empresa:<span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" id="nome_empresa" name="nome_empresa" required>
                                                    </div>
                                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                                        <label for="local_empresa" class="form-label">Localização:<span class="text-danger">*</span></label>
                                                        <select class="form-select" id="local_empresa" name="local_empresa" required>
                                                            <option value="">Escolher</option>
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
                                                            <option value="">Escolher</option>
                                                            <option valeu='Aveiro'>Oficina</option>
                                                            <option valeu='Braga'>Financeiro</option>
                                                            <option valeu='Faro'>Contabilidade</option>
                                                            <option valeu='Leiria'>Técnico</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="">
                                                    <button class="btn btn-success" type="submit" name="submit">Submeter Registo</button>
                                                    <a href="./admin-panel/gerir-clientes.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>
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
<?php
//TITULO PÁGINA
$page_title = 'Registar Agente -';

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

    //dados pessoais agente:
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

    $sql = "INSERT INTO users (email,password,role,last_login,nome,apelido,data_nascimento,telefone,morada,cod_postal,cidade,nome_empresa,local_empresa,dep_empresa) VALUES ('$email','$password',1,now(),'$nome','$apelido','$data_nascimento','$telefone','$morada','$cod_postal','$cidade','$nome_empresa','$local_empresa','$dep_empresa')";


    $result = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($dbconn), E_USER_ERROR);
    if ($result) {
        $success = 'Registo de agente criado com sucesso';

        header('Location: ../admin-panel/gerir-agentes.php?status=usercreated');
    } else {
        $error = 'Não foi possivel registar agente, por favor tente mais tarde';
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
                        <li class="breadcrumb-item active">Registar Novo Agente</li>
                    </ol>

                    <!-- REGISTAR AGENTE FORMULARIO -->
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
                                    <h3>Registar Agente</h3>
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
                                                <input type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Deve conter pelo menos um número, uma letra maiuscula e minuscula, e 8 ou mais caracteres" placeholder="Confirme a sua Password" aria-label="confirm_password" id="confirm_password" name="confirm_password" data-rule-equalTo="#password" required>
                                            </div>
                                            <div style="margin-top: 7px;" id="CheckPasswordMatch"></div>
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
                                                    <option valeu='Oficina'>Oficina</option>
                                                    <option valeu='Financeiro'>Financeiro</option>
                                                    <option valeu='Contabilidade'>Contabilidade</option>
                                                    <option valeu='Técnico'>Técnico</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="">
                                            <button class="btn btn-success" type="submit" name="submit">Submeter Registo</button>
                                            <a href="./admin-panel/gerir-agentes.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>
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

<!-- Validar Password e Confirma Password -->
<script>
    $(document).ready(function() {
        $("#confirm_password").on('keyup', function() {
            var password = $("#password").val();
            var confirmPassword = $("#confirm_password").val();
            if (password != confirmPassword)
                $("#CheckPasswordMatch").html("Passwords não coincidem").css("color", "red");
            else
                $("#CheckPasswordMatch").html("Passwords coicidem").css("color", "green");
        });
    });
</script>
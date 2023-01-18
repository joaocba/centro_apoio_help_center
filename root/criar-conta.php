<?php
//TITULO PÁGINA
$page_title = 'Criar Conta -';

//HTML HEAD
include('./components/page-head.php');
?>

<?php
$success = false;
$error = false;

require_once('./int.php');

if (isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] == true) {
    header('Location: ./admin-panel/painel-admin.php');
} elseif (isset($_SESSION['agent_logged']) && $_SESSION['agent_logged'] == true) {
    header('Location: ./agent-panel/painel-agente.php');
} elseif (isset($_SESSION['user_logged']) && $_SESSION['user_logged'] == true) {
    header('Location: ./user-panel/painel-cliente.php');
}

if (isset($_POST['submit'])) {

    //dados pessoais cliente:
    $nome = $_POST['nome'];
    $apelido = $_POST['apelido'];
    $data_nascimento = $_POST['data_nascimento']; //pode precisar de formatação dd/mm/yyyy para yyyy/mm/dd
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

    $sql = "INSERT INTO users (email,password,last_login,nome,apelido,data_nascimento,telefone,morada,cod_postal,cidade,nome_empresa,local_empresa,dep_empresa) VALUES ('$email','$password',now(),'$nome','$apelido','$data_nascimento','$telefone','$morada','$cod_postal','$cidade','$nome_empresa','$local_empresa','$dep_empresa')";

    //$result = mysqli_query($dbconn, $sql);

    //para detetar erros
    $result = mysqli_query($db->conn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($db->conn), E_USER_ERROR);

    if ($result) {
        $success = 'Conta criada com sucesso, ja pode iniciar sessao no Painel de Cliente';

        //redireciona para pagina de login com mensagem de sucesso de conta registada
        header('Location: ./login.php?status=registered');
    } else {
        $error = 'Não foi possivel concretizar o pedido, por favor tente mais tarde';
    }
}
?>

<body>
    <!-- FORMULARIO CRIAR CONTA -->
    <div class="bg-light d-flex align-items-center vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10 col-md-8">
                    <div class="card shadow mb-5 bg-body rounded">
                        <div class="card-body">
                            <form method="POST" class="needs-validation" onSubmit="return validate();">
                                <h1>Criar conta</h1>

                                <!-- CAIXA DE ALERTA -->
                                <?php
                                if (isset($error) && $error != false) {
                                    echo '<div class="alert alert-danger">' . $error . '</div>';
                                }
                                ?>
                                <?php
                                if (isset($success) && $success != false) {
                                    echo '<div class="alert alert-success">' . $success . '</div>';
                                }
                                ?>

                                <!-- CAMPOS DE REGISTO -->
                                <h5>Dados Pessoais</h5>
                                <div class="row mb-3">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="nome" class="form-label">Nome:<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Primeiro nome" aria-label="Primeiro nome" id="nome" name="nome" required>

                                    </div>
                                    <div class="col col-lg-6 col-md-6 col-sm-12">
                                        <label for="apelido" class="form-label">Apelido<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Apelido" aria-label="Apelido" id="apelido" name="apelido" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="data_nascimento" class="form-label">Data Nascimento:<span class="text-danger">*</span></label>
                                        <input type="date" class="form-control" placeholder="" aria-label="data_nascimento" id="data_nascimento" name="data_nascimento" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="telefone" class="form-label">Telefone:<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Telefone" aria-label="telefone" id="telefone" name="telefone" pattern="[0-9]{9}" required>
                                    </div>
                                </div>

                                <!-- MORADA -->
                                <div class="row mb-3">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="morada" class="form-label">Morada:<span class="text-danger">*</span></label>
                                        <input type="morada" class="form-control" placeholder="Morada e Nº Porta" aria-label="Morada e Nº Porta" id="morada" name="morada" required>
                                    </div>
                                    <div class="col-lg-2 col-md-2 col-sm-2">
                                        <label for="cod_postal" class="form-label">Codigo Postal:<span class="text-danger">*</span></label>
                                        <input type="cod_postal" class="form-control" placeholder="XXXX-YYY" aria-label="cod_postal" id="cod_postal" name="cod_postal" required>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-2">
                                        <label for="cidade" class="form-label">Localidade:<span class="text-danger">*</span></label>
                                        <input type="cidade" class="form-control" placeholder="Localidade" aria-label="Localidade" id="cidade" name="cidade" required>
                                    </div>
                                </div>

                                <hr>
                                <h5>Dados Conta Cliente</h5>
                                <!-- EMAIL -->
                                <div class="row mb-3">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="email" class="form-label">Email:<span class="text-danger">*</span></label>
                                        <input type="email" class="form-control" placeholder="Email" aria-label="Email" id="email" name="email" required>
                                    </div>
                                </div>

                                <!-- PASSWORD + CONFIRMA PASSWORD -->
                                <div class="row mb-3">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="password" class="form-label">Password:<span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Deve conter pelo menos um número, uma letra maiuscula e minuscula, e 8 ou mais caracteres" placeholder="Password" aria-label="Password" id="password" name="password" required>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="confirm_password" class="form-label"> Confirma Password:<span class="text-danger">*</span></label>
                                        <input type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Deve conter pelo menos um número, uma letra maiuscula e minuscula, e 8 ou mais caracteres" placeholder="Confirme a password" aria-label="Confirme a password" id="confirm_password" name="confirm_password" data-rule-equalTo="#password" required>
                                    </div>
                                    <div style="margin-top: 7px;" id="CheckPasswordMatch"></div>
                                </div>


                                <!-- DADOS EMPRESA -->
                                <hr>
                                <h5>Dados Empresa</h5>
                                <div class="row mb-3">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label for="nome_empresa" class="form-label">Nome Empresa:<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" placeholder="Nome da empresa" aria-label="Nome da empresa" id="nome_empresa" name="nome_empresa" required>
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

                                <div class="row mx-auto my-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" required>
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Concordo com os <a href="./termos.php">Termos de Utilização</a> e <a href="./privacidade.php">Politica de Privacidade</a>
                                        </label>
                                    </div>
                                </div>

                                <div class="my-3">
                                    <button class="btn btn-success" type="submit" name="submit">Criar Conta</button>
                                    <a href="./login.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PAGE BOTTOM -->
    <?php include('./components/page-bottom.php'); ?>
</body>

</html>

<!-- Validar Password e Confirma Password -->
<script>
$(document).ready(function () {
   $("#confirm_password").on('keyup', function(){
    var password = $("#password").val();
    var confirmPassword = $("#confirm_password").val();
    if (password != confirmPassword)
        $("#CheckPasswordMatch").html("Passwords não coincidem").css("color","red");
    else
        $("#CheckPasswordMatch").html("Password coicidem").css("color","green");
   });
});
</script>
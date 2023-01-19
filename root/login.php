<?php
//TITULO PÁGINA
$page_title = 'Login -';

//HTML HEAD
include('./components/page-head.php');
?>

<?php
//VALIDAR LOGIN
require_once('int.php');

if (isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] == true) {
    header('Location: ./admin-panel/painel-admin.php');
} elseif (isset($_SESSION['agent_logged']) && $_SESSION['agent_logged'] == true) {
    header('Location: ./agent-panel/painel-agente.php');
} elseif (isset($_SESSION['user_logged']) && $_SESSION['user_logged'] == true) {
    header('Location: ./user-panel/painel-cliente.php');
}

//var para box de erro
$error = false;

//verifica se foi introduzido um email
if (isset($_POST['email'])) {

    $db = new DB();
    $dbconn = $db->conn;

    //Escapar de caracteres especiais, como aspas, prevenindo SQL injection
    $email = mysqli_real_escape_string($dbconn, $_POST['email']);
    $password = mysqli_real_escape_string($dbconn, $_POST['password']);

    //converter password em hash SHA-1
    $password = sha1($password);

    //query para verificar o username na tabela da bd
    $sql = "SELECT * FROM users WHERE email = '$email' && password = '$password' LIMIT 1";

    //aplica a query na bd
    $result = mysqli_query($dbconn, $sql);

    //print do output da query
    //print_r($query);


    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['password'] == $password) { //compara a password introduzida com a hash da password existente na tabela da bd
                if ($row['role'] == 0) { //verificar se user -> cliente
                    $_SESSION['user_logged'] = true; //valida login
                    $_SESSION['users'] = $row;

                    //aplicar valores na sessao de cliente
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['nome'] = $row['nome'];
                    $_SESSION['apelido'] = $row['apelido'];

                    //atualizar o last_login do cliente
                    $query = "UPDATE users SET last_login = NOW() WHERE email='$email' LIMIT 1";
                    $result = $dbconn->query($query);
                    $_SESSION['last_login'] = $row['last_login'];

                    header('Location: ./user-panel/painel-cliente.php'); //redireciona para painel cliente
                    exit();
                } elseif ($row['role'] == 1) { //verificar se user -> agente
                    $_SESSION['agent_logged'] = true; //valida login
                    $_SESSION['users'] = $row;

                    //aplicar valores na sessao de agente
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['nome'] = $row['nome'];
                    $_SESSION['apelido'] = $row['apelido'];

                    //atualizar o last_login do agente
                    $query = "UPDATE users SET last_login = NOW() WHERE email='$email' LIMIT 1";
                    $result = $dbconn->query($query);
                    $_SESSION['last_login'] = $row['last_login'];

                    header('Location: ./agent-panel/painel-agente.php'); //redireciona para painel agente
                    exit();
                } elseif ($row['role'] == 2) { //verificar se user -> administrador
                    $_SESSION['admin_logged'] = true; //valida login
                    $_SESSION['users'] = $row;

                    //aplicar valores na sessao de admin
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['nome'] = $row['nome'];
                    $_SESSION['apelido'] = $row['apelido'];

                    //atualizar o last_login do admin
                    $query = "UPDATE users SET last_login = NOW() WHERE email='$email' LIMIT 1";
                    $result = $dbconn->query($query);
                    $_SESSION['last_login'] = $row['last_login'];

                    header('Location: ./admin-panel/painel-admin.php'); //redireciona para painel agente
                    exit();
                }
            } else {
                $error = 'Email ou password incorretos'; //retorna mensagem de erro em password incorreta
            }
        }
    } else {
        $error = 'Email ou password incorretos'; //retorna mensagem de erro em email incorreto
    }
}
?>

<body>
    <!-- FORMULARIO LOGIN -->
    <div class="bg-light d-flex align-items-center vh-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-auto">
                    <div class="card shadow mb-5 bg-body rounded-3">
                        <div class="card-body">
                            <form method="POST">

                                <!-- CAIXA DE ALERTA -->
                                <?php
                                //mensagem de erro em falha de login
                                if (isset($error) && $error != false) {
                                    echo '<div class="alert alert-danger text-center">' . $error . '</div>';
                                }
                                ?>
                                <?php
                                //mensagem de terminada sessao
                                if (!empty($_GET['status']) && ($_GET['status'] == "loggedout")) {
                                    echo '<div class="alert alert-danger text-center">Terminou sessao com sucesso. Ate breve</div>';
                                }
                                ?>
                                <?php
                                //mensagem de conta criada com sucesso
                                if (!empty($_GET['status']) && ($_GET['status'] == "registered")) {
                                    echo '<div class="alert alert-success text-center">Conta criada com sucesso. Pode fazer login e aceder ao Painel de Cliente</div>';
                                }
                                ?>

                                <div>
                                    <img class="mx-auto d-block" src="./assets/img/logos/logof.png" width="200px" alt="">
                                </div>
                                <h1 class="text-center mt-2">Iniciar sessão</h1>
                                <div class="m-4">
                                    <div class="input-group mt-5 mb-3">
                                        <!--<label class="form-label">Email</label>-->
                                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-circle"></i></span>
                                        <input type="text" name="email" id="email" required placeholder="Email" class="form-control form-control-lg">
                                    </div>
                                    <div class="input-group mb-4">
                                        <!--<label class="form-label">Password</label>-->
                                        <span class="input-group-text" id="basic-addon1"><i class="bi bi-key-fill"></i></span>
                                        <input type="password" name="password" id="password" required placeholder="Password" class="form-control form-control-lg">
                                    </div>
                                    <div class="d-grid gap-2 mb-3">
                                        <button class="btn btn-success" type="submit">Entrar</button>
                                        <a href="./index.php" target="_self" rel="noopener noreferrer" class="btn btn-outline-secondary btn-sm">Voltar ao inicio</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center text-muted">
                            Ainda não se registou? <a href="./criar-conta.php">Crie uma conta</a>
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
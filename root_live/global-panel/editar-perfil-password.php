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
if (!isset($_SESSION['role'])) {
    if (!isset($_SESSION['user_logged']) && $_SESSION['user_logged'] != true) {
        header('Location: ../login.php');
    } elseif (!isset($_SESSION['agent_logged']) && $_SESSION['agent_logged'] != true) {
        header('Location: ../login.php');
    } elseif (!isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] != true) {
        header('Location: ../login.php');
    }
}

$db = new DB();
$dbconn = $db->conn;
$userid = $_SESSION['id'];

if (isset($_POST['submit'])) {

    //vars associadas ao formulario
    $password_novo = sha1($_POST['password']);

    $sql = "UPDATE users SET password='$password_novo' WHERE id='$userid'";
    //$inset = mysqli_query($dbconn, $sql);
    //para detetar erros
    $inset = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($dbconn), E_USER_ERROR);

    if ($inset) {
        $success = 'Perfil atualizado com sucesso para o cliente ' . $nome . ' ' . $apelido;

        header('Location: ./perfil.php?status=updated');
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
                    <?php
                    if (isset($_SESSION['role'])) {
                        if (isset($_SESSION['user_logged']) && $_SESSION['user_logged'] == true) {
                            echo '
                                <h1 class="mt-4">Perfil</h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="../user-panel/painel-cliente.php">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="../global-panel/perfil.php">Perfil</a></li>
                                    <li class="breadcrumb-item active">Alterar Password</li>
                                </ol>
                                ';
                        } elseif (isset($_SESSION['agent_logged']) && $_SESSION['agent_logged'] == true) {
                            echo '
                                <h1 class="mt-4">Perfil</h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="../agent-panel/painel-agente.php">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="../global-panel/perfil.php">Perfil</a></li>
                                    <li class="breadcrumb-item active">Alterar Password</li>
                                </ol>
                                ';
                        } elseif (isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] == true) {
                            echo '
                                <h1 class="mt-4">Perfil</h1>
                                <ol class="breadcrumb mb-4">
                                    <li class="breadcrumb-item"><a href="../admin-panel/painel-admin.php">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="../global-panel/perfil.php">Perfil</a></li>
                                    <li class="breadcrumb-item active">Alterar Password</li>
                                </ol>
                                ';
                        }
                    }
                    ?>

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
                                                <input type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Deve conter pelo menos um número, uma letra maiuscula e minuscula, e 8 ou mais caracteres" placeholder="Confirme a nova password" aria-label="confirm_password" id="confirm_password" name="confirm_password" data-rule-equalTo="#password" required>
                                            </div>
                                            <div style="margin-top: 7px;" id="CheckPasswordMatch"></div>
                                        </div>

                                        <div class="">
                                            <button class="btn btn-danger" type="submit" name="submit">Alterar Password</button>
                                            <a href="../global-panel/perfil.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>
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
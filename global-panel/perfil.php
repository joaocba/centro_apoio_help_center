<?php
//TITULO PÁGINA
$page_title = 'Perfil -';

//HTML HEAD
include('../components/page-head.php');
?>

<?php
require_once('../int.php');
if(!isset($_SESSION['role'])){
    if(!isset($_SESSION['user_logged']) && $_SESSION['user_logged'] != true){
        header('Location: ../login.php');
    }elseif(!isset($_SESSION['agent_logged']) && $_SESSION['agent_logged'] != true){
        header('Location: ../login.php');
    }elseif(!isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] != true){
        header('Location: ../login.php');
    }
}

$db = new DB();
$dbconn = $db->conn;

$userid = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id = '$userid' LIMIT 1";
$result = mysqli_query($dbconn, $sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

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
                            <?php
                            if(isset($_SESSION['role'])){
                                if(isset($_SESSION['user_logged']) && $_SESSION['user_logged'] == true){
                                    echo '<h1 class="mb-3"><i class="bi bi-window"></i> Painel de Cliente</h1>';
                                }elseif(isset($_SESSION['agent_logged']) && $_SESSION['agent_logged'] == true){
                                    echo '<h1 class="mb-3"><i class="bi bi-window"></i> Painel de Agente</h1>';
                                }elseif(isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] == true){
                                    echo '<h1 class="mb-3"><i class="bi bi-window"></i> Painel de Administrador</h1>';
                                }
                            }
                            ?>

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
                                            <p class="fs-5"><?php echo $nome. ' ' .$apelido; ?></p>
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
                                            <p class="fs-5"><?php echo $morada.' '.$cod_postal.' '.$cidade; ?></p>
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
                                            <p class="fs-5"><?php echo $nome_empresa.' ('.$local_empresa.')'; ?></p>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12">
                                            <label class="text-muted fs-6">Departamento</label>
                                            <p class="fs-5"><?php echo $dep_empresa; ?></p>
                                        </div>
                                    </div>
                                    <div class="">
                                        <a href="./global-panel/editar-perfil.php" target="_self" rel="noopener noreferrer" class="btn btn-success">Editar Perfil</a>
                                        <a href="./global-panel/editar-perfil-password.php" target="_self" rel="noopener noreferrer" class="btn btn-danger">Alterar Password</a>
                                        <?php
                                        if (isset($_SESSION['user_logged']) && $_SESSION['user_logged'] == true) {
                                            echo '<a href="./user-panel/painel-cliente.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>';
                                        } elseif (isset($_SESSION['agent_logged']) && $_SESSION['agent_logged'] == true) {
                                            echo '<a href="./agent-panel/painel-agente.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>';
                                        } elseif (isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] == true) {
                                            echo '<a href="./admin-panel/painel-admin.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>';
                                        }
                                        ?>
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
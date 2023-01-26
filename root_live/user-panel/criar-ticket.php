<?php
//TITULO PÁGINA
$page_title = 'Criar Ticket -';

//HTML HEAD
include('../components/page-head.php');
?>

<?php
$success = false;
$error = false;
require_once('../int.php');
if (!isset($_SESSION['user_logged']) && $_SESSION['user_logged'] != true) { //se sessao não for iniciada por admin redireciona para página de login
    header('Location: ../login.php');
}

$db = new DB();
$dbconn = $db->conn;

//MOSTRAR CATEGORIAS
$latest_cat = [];
$sql = "SELECT * FROM kb_categorias ORDER BY id ASC LIMIT 15";
$recodes = mysqli_query($dbconn, $sql);

if ($recodes->num_rows > 0) {
    while ($row = $recodes->fetch_assoc()) {
        $latest_cat[] = $row;
    }
}

//FORMULARIO CRIAR TICKET
$userid = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id = '$userid' LIMIT 1";
$result = mysqli_query($dbconn, $sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nome_completo = $row['nome'] . ' ' . $row['apelido'];
    $telefone = $row['telefone'];
    $email = $row['email'];
    $nome_empresa = $row['nome_empresa'];
    $dep_empresa = $row['dep_empresa'];
}

if (isset($_POST['submit'])) {
    //vars associadas ao formulario
    $categoria = $_POST['categoria'];
    //$assunto = $_POST["assunto"];
    //$message = $_POST["Message"];
    $message = mysqli_real_escape_string($dbconn, $_POST["message"]);
    $assunto = mysqli_real_escape_string($dbconn, $_POST["assunto"]);

    //Passar dados de assunto para variavel de sessao
    $_SESSION['tkt_categoria'] = $categoria;
    $_SESSION['tkt_assunto'] = $assunto;

    $unid = random_bytes(5); //gerar um id unico para o ticket para fazer pesquisa
    $unid = bin2hex($unid); //converter o id para hexadecimal
    //$unid = strtoupper($unid); //capitalizar string

    $sql = "INSERT INTO tickets (ticket_id,user_id,status,prioridade,nome,telefone,email,nome_empresa,dep_empresa,categoria,assunto,message) VALUES ('$unid','$userid','0','0','$nome_completo','$telefone','$email','$nome_empresa','$dep_empresa','$categoria','$assunto','$message')";
    //$inset = mysqli_query($dbconn, $sql);

    $inset = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($dbconn), E_USER_ERROR);
    if ($inset) {
        //Passar dados de ticket_id para variavel de sessao
        $_SESSION['ticket_id_criado'] = $unid;

        //$success = 'O ticket foi criado com sucesso com o ID ' . $unid;
        //echo "<script>alert('Ticket criado com sucesso!');</script>";
        echo "<script>window.location.href='../user-panel/ticket-criado.php';</script>";
    } else {
        $error = 'Não foi possivel concretizar o pedido, por favor tente mais tarde';
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
                    <h1 class="mt-4">Ticket</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="../user-panel/painel-cliente.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Novo Ticket</li>
                    </ol>


                    <!-- CRIAR TICKET FORMULARIO -->
                    <form method="POST">
                        <div class="card mb-3">
                            <div class="card-header"> Criar Novo Ticket</div>
                            <div class="card-body">

                                <!-- CAIXA DE ALERTA -->
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

                                <div class="row mb-3">
                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <label for="categoria" class="form-label">Categoria<span class="text-danger">*</span></label>
                                        <?php if (count($latest_cat) > 0) { ?>
                                            <select class="form-select" name="categoria" id="categoria" required>
                                                <option selected>Escolher categoria</option>
                                                <?php
                                                foreach ($latest_cat as $k => $v) {
                                                    echo '
                                                            <option value="' . $v['id'] . '">' . $v['nome_categoria'] . '</option>
                                                            ';
                                                } ?>
                                            </select>
                                        <?php } else {
                                            echo '<div class="alert alert-info">Não existem categorias</div>';
                                        } ?>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label class="form-label">Assunto<span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" required name="assunto" id="assunto" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <label class="form-label">Descrição<span class="text-danger">*</span></label>
                                        <textarea name="message" class="form-control" id="message" cols="30" rows="5" placeholder="Descreva o problema" required></textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-12 col-md-12">
                                        <div class="text-right">
                                            <input type="hidden" name="submit" value="form">
                                            <button class="btn btn-success" type="submit">Submeter</button>
                                            <button class="btn btn-dark" type="reset">Limpar</button>
                                            <a href="../user-panel/painel-cliente.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>
                                        </div>
                                    </div>
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
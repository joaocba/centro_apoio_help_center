<?php
//TITULO PÁGINA
$page_title = 'Ticket Resultados -';

//HTML HEAD
include('../components/page-head.php');
?>

<?php
$success = false;
$error = false;
require_once('../int.php');
if (!isset($_SESSION['user_logged']) && $_SESSION['user_logged'] != true) {
    header('Location: ../login.php');
}

if (!isset($_SESSION['ticket_id_criado']) && $_SESSION['ticket_id_criado'] != true) {
    header('Location: ./user-panel/painel-cliente.php');
}

//SEARCH KEYWORD ENGINE
$keywords_assunto = $_SESSION['tkt_assunto'];
$ticket_categoria = $_SESSION['tkt_categoria'];
$artigos = [];

$db = new DB();
$dbconn = $db->conn;

$aKeyword = explode(" ", $keywords_assunto);
$sql = "SELECT * FROM kb_artigos INNER JOIN kb_categorias ON kb_artigos.cat_id = kb_categorias.id WHERE kb_categorias.id='$ticket_categoria' AND keywords LIKE '%" . $aKeyword[0] . "%'";
for ($i = 1; $i < count($aKeyword); $i++) {
    if (!empty($aKeyword[$i])) {
        $sql .= " OR kb_categorias.id='$ticket_categoria' AND keywords LIKE keywords LIKE '%" . $aKeyword[$i] . "%'";
    }
}

$result = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($dbconn), E_USER_ERROR);
if ($result->num_rows > 0) {
    $success = "Foram encontrados " . mysqli_num_rows($result) . " artigo(s) relacionados com assunto do seu ticket";
    while ($row = $result->fetch_assoc()) {
        //echo "<script>alert('".$row['categoria'] . '  ' . $row['assunto'] . '  ' . $row['descricao'] . '<br>'."');</script>";
        $artigos[] = $row;
    }
} else {
    $error = "Não foram encontrados artigos para a sua pesquisa";
}
//FIM DE SEARCH KEYWORD ENGINE


//IDENTIFICAR TICKET APOS CRIADO
//Le dados em sessão
$ticket_id_criado = $_SESSION['ticket_id_criado'];
$userid = $_SESSION['id'];

$sql = "SELECT * FROM tickets WHERE ticket_id='$ticket_id_criado'";
$recodes = mysqli_query($dbconn, $sql);

if ($recodes->num_rows > 0) {
    $row = $recodes->fetch_assoc();
    $ticket_id_final = $row['id'];
}
//FIM DE IDENTIFICAR TICKET


//FECHAR TICKET (BTN RESOLVIDO)
if (isset($_POST['submit'])) {
    $sql = "UPDATE tickets SET status=2 WHERE id=$ticket_id_final";
    mysqli_query($dbconn, $sql);
    header("Location: ./user-panel/ticket.php?id=" . $ticket_id_final);

    //Limpa os dados da variavel de sessão
    unset($keywords_assunto, $ticket_categoria, $ticket_id_criado);
}
//FIM DE FECHAR TICKET (BTN RESOLVIDO)
?>

<body>
    <div class="d-flex" id="wrapper">
        <?php include('../global-panel/components/sidebar-painel.php'); ?>
        <div class="bg-light" id="page-content-wrapper">
            <?php include('../global-panel/components/topnav-painel.php'); ?>
            <div class="container-fluid">
                <!-- INICIO DE CONTEUDO DE PAGINA -->

                <div class="container mt-4">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-12">

                            <!-- INFO -->
                            <h1 class="mb-3"><i class="bi bi-window"></i> Painel de Cliente</h1>

                            <!-- RESULTADOS DA PESQUISA DE ARTIGOS -->
                            <div class="card mb-3">
                                <div class="card-header"> Artigos relacionados</div>
                                <div class="card-body">

                                    <!-- CAIXA DE ALERTAS -->
                                    <?php
                                    if (isset($success) && $success != false) {
                                        echo '<div class="alert alert-success">' . $success . '</div>';
                                    }
                                    ?>

                                    <!-- DISPLAY BOX COM CARD -->
                                    <?php if (count($artigos) > 0) { ?>
                                        <div class="row row-cols-1 row-cols-md-1 g-4">
                                            <?php foreach ($artigos as $k => $v) { ?>
                                                <div class="col">
                                                    <div class="card h-100">
                                                        <h5 class="card-header"><?php echo $v['nome_categoria']; ?></h5>
                                                        <div class="card-body">
                                                            <h5 class="card-title"><?php echo $v['assunto']; ?></h5>
                                                            <p class="card-text"><?php echo $v['descricao']; ?></p>
                                                        </div>
                                                        <div class="card-footer text-muted">
                                                            Para mais informações visite a Knowledge Base
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    <?php
                                    } else {
                                        if (isset($error) && $error != false) {
                                            echo '<div class="alert alert-danger">' . $error . '</div>';
                                        } else {
                                            echo '<div class="alert alert-info">Sem dados para mostrar</div>';
                                        }
                                    }
                                    ?>

                                    <?php if (count($artigos) > 0) { ?>
                                    <form method="POST">
                                        <div class="mt-3">
                                            <input type="hidden" name="submit" value="send">
                                            <button class="btn btn-success">Resolvido</button>
                                            <a href="./user-panel/painel-cliente.php?tktunsolved=true" target="_self" rel="noopener noreferrer" class="btn btn-dark">Não Resolvido</a>
                                            <!-- <a href="./user-panel/ticket.php?id=<?php echo $ticket_id_final ?>" target="_self" rel="noopener noreferrer" class="btn btn-success">Ver Ticket</a> -->
                                            <!-- <a href="./user-panel/painel-cliente.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a> -->
                                        </div>
                                    </form>
                                    <?php
                                    } else if (count($artigos) == 0) { ?>
                                    <form method="POST">
                                        <div class="mt-3">
                                            <input type="hidden" name="submit" value="send">
                                            <a href="./user-panel/ticket.php?id=<?php echo $ticket_id_final ?>" target="_self" rel="noopener noreferrer" class="btn btn-success">Ver Ticket</a>
                                            <a href="./user-panel/painel-cliente.php" target="_self" rel="noopener noreferrer" class="btn btn-dark">Voltar</a>
                                        </div>
                                    </form>
                                    <?php }
                                    ?>
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
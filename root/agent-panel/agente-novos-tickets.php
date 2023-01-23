<?php
//TITULO PÁGINA
$page_title = 'Tickets Novos -';

//HTML HEAD
include('../components/page-head.php');
?>

<?php
require_once('../int.php'); //chama uma vez o ficheiro "int.php"
if (!isset($_SESSION['agent_logged']) && $_SESSION['agent_logged'] != true) { //se sessao não for iniciada por admin redireciona para página "login.php"
    header('Location: ../login.php');
}

//PREPARAR ESTATISTICAS DE TICKETS
$new_status = 0; //definir vars de identificação de estado
$waiting_reply_status = 1;
$closed_status = 2;

$new_count = 0; //definir vars de contagem de tickets
$reply_count = 0;
$closed_count = 0;

$db = new DB();

//MOSTRAR ULTIMOS 10 TICKETS COM O ESTADO = 0 (novos)
$latest = [];
$recodes = $db->conn->query("SELECT * FROM tickets WHERE status=0 ORDER BY 'date' DESC ");
if ($recodes->num_rows > 0) {
    while ($row = $recodes->fetch_assoc()) {
        $latest[] = $row;
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
                    <h1 class="mt-4">Tickets</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="./agent-panel/painel-agente.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Tickets Novos</li>
                    </ol>

                    <!-- SUBNAV -->
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="list-inline admn_ul">
                                <a href="./agent-panel/painel-agente.php" class="list-inline-item">Dashboard</a>
                                <a href="./agente-novos-tickets.php" class="list-inline-item">Novos Tickets</a>
                                <a href="./agent-panel/agente-espera-tickets.php" class="list-inline-item">Aguardam Resposta</a>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            Novos Tickets
                        </div>
                        <div class="card-body">
                            <?php if (count($latest) > 0) { ?> <!-- caso haja tickets definir tabela com os campos abaixo -->
                                <table class="table table-striped table-inverse">
                                    <thead class="thead-inverse">
                                        <tr>
                                            <th>ID</th>
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>Assunto</th>
                                            <th>Data</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($latest as $k => $v) { //popular a tabela com cada ticket disponivel
                                            echo '
                                        <tr>
                                            <td>' . $v['id'] . '</td>
                                            <td>' . $v['name'] . '</td>
                                            <td>' . $v['email'] . '</td>
                                            <td>' . $v['subject'] . '</td>
                                            <td>' . $v['date'] . '</td>
                                            <td><a href="./agent-ver-ticket.php?id=' . $v['id'] . '" class="btn btn-sm btn-info">View<a/></td>
                                        </tr>
                                        ';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            <?php } else {
                                echo '<div class="alert alert-info">Não existem novos tickets</div>'; //caso não haja tickets mostra alerta
                            } ?>
                        </div>
                    </div>

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
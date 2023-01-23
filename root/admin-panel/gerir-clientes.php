<?php
//TITULO PÁGINA
$page_title = 'Gerir Clientes -';

//HTML HEAD
include('../components/page-head.php');
?>

<?php
require_once('../int.php');

//VERIFICAR SESSAO
if (!isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] != true) {
    header('Location: ./login.php');
}


$db = new DB();
$dbconn = $db->conn;

//MOSTRAR CLIENTES
$latest = [];
$sql = "SELECT * FROM users WHERE role='0' ORDER BY id ASC LIMIT 15";
$recodes = mysqli_query($dbconn, $sql);

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
                    <h1 class="mt-4">Gestão Clientes</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="./admin-panel/painel-admin.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Gerir Clientes</li>
                    </ol>

                    <!-- Cards de Acesso -->
                    <div class="row">
                        <!-- Procurar Cliente -->
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3>Procurar Cliente</h3>
                                    <p>Pesquise clientes por email</p>
                                    <a href="./admin-panel/procurar-cliente.php" class="btn btn-success">Procurar</a>
                                </div>
                            </div>
                        </div>
                        <!-- Registar Cliente -->
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h3>Registar Cliente</h3>
                                    <p>Registe um novo cliente</p>
                                    <a href="./admin-panel/registar-cliente.php" class="btn btn-success">Registar Cliente</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- MOSTRAR ULTIMOS 5 TICKETS EM TABELA -->
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-12">
                            <div class="card mt-3">
                                <div class="card-header">
                                    Clientes Registados
                                </div>
                                <div class="card-body">
                                    <!-- CAIXA DE ALERTA -->
                                    <?php
                                    //mensagem de registo criado
                                    if (!empty($_GET['status']) && ($_GET['status'] == "usercreated")) {
                                        echo '<div class="alert alert-success text-center">Registo criado com sucesso</div>';
                                    }
                                    ?>
                                    <?php
                                    //mensagem de registo alterado
                                    if (!empty($_GET['status']) && ($_GET['status'] == "userdeleted")) {
                                        echo '<div class="alert alert-success text-center">Registo removido com sucesso</div>';
                                    }
                                    ?>
                                    <?php
                                    //mensagem de registo removido
                                    if (!empty($_GET['status']) && ($_GET['status'] == "userupdated")) {
                                        echo '<div class="alert alert-success text-center">Registo atualizado com sucesso</div>';
                                    }
                                    ?>

                                    <!-- GERA TABELA -->
                                    <?php if (count($latest) > 0) { ?>
                                        <table class="table table-striped align-middle css-serial">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nome</th>
                                                    <th>Email</th>
                                                    <th>Telefone</th>
                                                    <th>Empresa</th>
                                                    <th>Departamento</th>
                                                    <th>Ações</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($latest as $k => $v) {
                                                    echo '
                                                <tr>
                                                    <td></td>
                                                    <td>' . $v['nome'] . ' ' . $v['apelido'] . '</td>
                                                    <td>' . $v['email'] . '</td>
                                                    <td>' . $v['telefone'] . '</td>
                                                    <td>' . $v['nome_empresa'] . ' (' . $v['local_empresa'] . ')</td>
                                                    <td>' . $v['dep_empresa'] . '</td>
                                                    <td>
                                                        <a href="./admin-panel/cliente.php?id=' . $v['id'] . '" class="btn btn-sm btn-success"><i class="bi bi-search"></i><a/> 
                                                        <a href="./admin-panel/editar-cliente.php?id=' . $v['id'] . '" class="btn btn-sm btn-primary"><i class="bi bi-pen"></i><a/> 
                                                        <a href="./admin-panel/eliminar-cliente.php?id=' . $v['id'] . '" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i><a/>
                                                    </td>
                                                </tr>
                                                ';
                                                } ?>
                                            </tbody>
                                        </table>
                                    <?php } else {
                                        echo '<div class="alert alert-info">Não existem clientes registados</div>';
                                    } ?>
                                </div>
                            </div>
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
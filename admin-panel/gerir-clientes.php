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

<body>
    <div class="d-flex" id="wrapper">
        <?php include('../global-panel/components/sidebar-painel.php'); ?>
        <div class="bg-light" id="page-content-wrapper">
            <?php include('../global-panel/components/topnav-painel.php'); ?>
            <div class="container-fluid">
                <!-- INICIO DE CONTEUDO DE PAGINA -->

                <div class="container my-4">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <!-- LOGIN INFO -->
                            <h1 class="mb-3"><i class="bi bi-window"></i> Painel de Administrador</h1>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <!-- PROCURAR CLIENTE -->
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h3>Procurar Cliente</h3>
                                    <p>Pesquise clientes por email</p>
                                    <a href="./admin-panel/procurar-cliente.php" class="btn btn-success">Procurar</a>
                                </div>
                            </div>
                        </div>

                        <!-- REGISTAR CLIENTE -->
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card">
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
                                                ';}?>
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

                <!-- FIM DE CONTEUDO DE PAGINA -->
            </div>
        </div>
    </div>

    <!-- PAGE BOTTOM -->
    <?php include('../components/page-bottom.php'); ?>
</body>

</html>
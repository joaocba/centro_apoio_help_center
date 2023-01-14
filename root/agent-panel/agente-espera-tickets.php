<?php
//TITULO PÁGINA
$page_title = 'Tickets em Espera -';

//HTML HEAD
include('../components/page-head.php');
?>

<?php
require_once('../int.php');
if(!isset($_SESSION['agent_logged']) && $_SESSION['agent_logged'] != true){
    header('Location: ../login.php');
}

$new_status=0;
$waiting_reply_status=1;
$closed_status=2;

$new_count=0;
$reply_count=0;
$closed_count=0;

$db=new DB();

$latest=[];
$recodes=$db->conn->query("SELECT * FROM tickets WHERE status=1 ORDER BY 'date' DESC ");
if($recodes->num_rows >0){
    while ($row = $recodes->fetch_assoc()) {
        $latest[]=$row;
    }
}

?>
<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-12">

                <!-- ADMIN INFO -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h3>Olá, -nome agente aqui-</h3>
                        <p>Último sessão inciada a -data aqui-</p>
                        <a href="./logout.php" class="btn btn-dark">Terminar Sessão</a>
                    </div>
                </div>

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
                        Tickets que aguardam resposta
                    </div>
                    <div class="card-body">
                        <?php if(count($latest) > 0){?>
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
                                    foreach ($latest as $k => $v) {
                                        echo '
                                        <tr>
                                            <td>'.$v['id'].'</td>
                                            <td>'.$v['name'].'</td>
                                            <td>'.$v['email'].'</td>
                                            <td>'.$v['subject'].'</td>
                                            <td>'.$v['date'].'</td>
                                            <td><a href="./agent-ver-ticket.php?id='.$v['id'].'" class="btn btn-sm btn-info">View<a/></td>
                                        </tr>
                                        ';
                                    }
                                    ?>
                                </tbody>
                        </table>
                        <?php }else{
                            echo '<div class="alert alert-info">Não existem tickets em espera</div>';
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PAGE BOTTOM -->
    <?php include('../components/page-bottom.php'); ?>
</body>

</html>
<?php
//TITULO PÁGINA
$page_title = 'Tickets Novos -';

//HTML HEAD
include('../components/page-head.php');
?>

<?php
require_once('../int.php'); //chama uma vez o ficheiro "int.php"
if(!isset($_SESSION['agent_logged']) && $_SESSION['agent_logged'] != true){ //se sessao não for iniciada por admin redireciona para página "login.php"
    header('Location: ../login.php');
}

//PREPARAR ESTATISTICAS DE TICKETS
$new_status=0; //definir vars de identificação de estado
$waiting_reply_status=1;
$closed_status=2;

$new_count=0; //definir vars de contagem de tickets
$reply_count=0;
$closed_count=0;

$db=new DB();

//MOSTRAR ULTIMOS 10 TICKETS COM O ESTADO = 0 (novos)
$latest=[];
$recodes=$db->conn->query("SELECT * FROM tickets WHERE status=0 ORDER BY 'date' DESC ");
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
                        Novos Tickets
                    </div>
                    <div class="card-body">
                        <?php if(count($latest) > 0){?> <!-- caso haja tickets definir tabela com os campos abaixo -->
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
                            echo '<div class="alert alert-info">Não existem novos tickets</div>'; //caso não haja tickets mostra alerta
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
<?php
//TITULO PÁGINA
$page_title = 'Estatisticas -';

//HTML HEAD
include('../components/page-head.php');
?>

<?php
$success = false;
$error = false;
require_once('../int.php');
if (!isset($_SESSION['agent_logged']) && $_SESSION['agent_logged'] != true) {
    header('Location: ../login.php');
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
                    <h1 class="mt-4">Estatisticas</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="./agent-panel/painel-agente.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Estatisticas</li>
                    </ol>

                    <!-- CHARTS -->
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Últimos 50 Tickets Registados (Total por data de registo)
                                </div>
                                <div class="card-body"><canvas id="myAreaChartUltimos50" width="100%" height="50"></canvas></div>
                                <div class="card-footer small text-muted">Atualizado a <?php echo $now->format('Y-m-d H:i:s'); ?></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Tickets Registados (Mensal)
                                </div>
                                <div class="card-body"><canvas id="myBarChartTotalMes" width="100%" height="50"></canvas></div>
                                <div class="card-footer small text-muted">Atualizado a <?php echo $now->format('Y-m-d H:i:s'); ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-pie me-1"></i>
                                    Estado dos Tickets (Totais)
                                </div>
                                <div class="card-body"><canvas id="myPieChartEstado" width="100%" height="50"></canvas></div>
                                <div class="card-footer small text-muted">Atualizado a <?php echo $now->format('Y-m-d H:i:s'); ?></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-pie me-1"></i>
                                    Prioridade dos Tickets (Totais)
                                </div>
                                <div class="card-body"><canvas id="myPieChartPrioridade" width="100%" height="50"></canvas></div>
                                <div class="card-footer small text-muted">Atualizado a <?php echo $now->format('Y-m-d H:i:s'); ?></div>
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

    <!-- CHARTS CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>

</body>

</html>

<!-- CHARTS -->
<!-- Chart: Contador de Tickets por dia -->
<?php
$db = new DB();
$dbconn = $db->conn;

$datas = [];

$sql = "SELECT * FROM tickets ORDER BY date ASC LIMIT 50";
$recodes = mysqli_query($dbconn, $sql);
if ($recodes->num_rows > 0) {
    while ($row = $recodes->fetch_assoc()) {
        $datas[] = $row['date'];
    }
}

$newDateFormat = array();
foreach($datas as $data){
    $data = date('Y/m/d',  strtotime($data));
    array_push($newDateFormat,$data);
}

//echo implode(', ', $datas);
//print_r($datas);
//echo implode(', ', $newDateFormat);
//print_r(array_unique($newDateFormat));
//print_r(array_count_values($newDateFormat));

$datas_unicas = '"'.implode('", "', array_unique($newDateFormat)).'"';
$datas_contador = '"'.implode('", "', array_count_values($newDateFormat)).'"';

//print_r($datas_unicas);
//print_r($datas_contador);

?>

<script>
    // Definir font
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    //Definir variaveis com valores PHP

    // Gerar Chart (Pie)
    var ctx = document.getElementById("myAreaChartUltimos50");
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [<?php echo $datas_unicas; ?>],
    datasets: [{
      label: "Tickets",
      lineTension: 0.3,
      backgroundColor: "rgba(2,117,216,0.2)",
      borderColor: "rgba(2,117,216,1)",
      pointRadius: 5,
      pointBackgroundColor: "rgba(2,117,216,1)",
      pointBorderColor: "rgba(255,255,255,0.8)",
      pointHoverRadius: 5,
      pointHoverBackgroundColor: "rgba(2,117,216,1)",
      pointHitRadius: 50,
      pointBorderWidth: 2,
      data: [<?php echo $datas_contador; ?>],
    }],
  },
  options: {
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false
        },
        ticks: {
          maxTicksLimit: 15
        }
      }],
      yAxes: [{
        ticks: {
          min: 0,
          maxTicksLimit: 5
        },
        gridLines: {
          color: "rgba(0, 0, 0, .125)",
        }
      }],
    },
    legend: {
      display: true
    }
  }
});
</script>


<!-- Chart: Contador de Tickets por mês -->
<?php
$db = new DB();
$dbconn = $db->conn;

$latest = [];
$sql = "SELECT * FROM tickets ORDER BY date DESC LIMIT 99";
$recodes = mysqli_query($dbconn, $sql);
if ($recodes->num_rows > 0) {
    while ($row = $recodes->fetch_assoc()) {
        $latest[] = $row;
    }
}

if (count($latest) > 0) {
    $contador_datas_nov = 0;
    $contador_datas_dez = 0;
    $contador_datas_jan = 0;
    $contador_datas_fev = 0;
    $contador_datas_mar = 0;
    $contador_datas_abr = 0;
    $contador_datas_mai = 0;
    $contador_datas_jun = 0;

    foreach ($latest as $k => $v) {
        $data_valor = $v['date'];
        $data_converter = date("Y-m-d", strtotime($data_valor));

        if ($data_converter >= date("2022-11-01") && $data_converter < date("2022-12-01")) {
            $contador_datas_nov++;
        } elseif ($data_converter >= date("2022-12-01") && $data_converter < date("2023-01-01")) {
            $contador_datas_dez++;
        } elseif ($data_converter >= date("2023-01-01") && $data_converter < date("2023-02-01")) {
            $contador_datas_jan++;
        } elseif ($data_converter >= date("2023-02-01") && $data_converter < date("2023-03-01")) {
            $contador_datas_fev++;
        } elseif ($data_converter >= date("2023-03-01") && $data_converter < date("2023-04-01")) {
            $contador_datas_mar++;
        } elseif ($data_converter >= date("2023-04-01") && $data_converter < date("2023-05-01")) {
            $contador_datas_abr++;
        } elseif ($data_converter >= date("2023-05-01") && $data_converter < date("2023-06-01")) {
            $contador_datas_mai++;
        } elseif ($data_converter >= date("2023-06-01") && $data_converter < date("2023-07-01")) {
            $contador_datas_jun++;
        }
    }
}
?>

<script>
    // Definir font
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    //Definir variaveis com valores PHP
    var count_nov = <?php echo (json_encode($contador_datas_nov)); ?>;
    var count_dez = <?php echo (json_encode($contador_datas_dez)); ?>;
    var count_jan = <?php echo (json_encode($contador_datas_jan)); ?>;
    var count_fev = <?php echo (json_encode($contador_datas_fev)); ?>;
    var count_mar = <?php echo (json_encode($contador_datas_mar)); ?>;
    var count_abr = <?php echo (json_encode($contador_datas_abr)); ?>;
    var count_mai = <?php echo (json_encode($contador_datas_mai)); ?>;
    var count_jun = <?php echo (json_encode($contador_datas_jun)); ?>;

    // Gerar Chart (Pie)
    var ctx = document.getElementById("myBarChartTotalMes");
    var myLineChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Novembro", "Dezembro", "Janeiro", "Feveiro", "Março", "Abril", "Maio", "Junho"],
            datasets: [{
                label: "Tickets",
                backgroundColor: "rgba(2,117,216,1)",
                borderColor: "rgba(2,117,216,1)",
                data: [count_nov, count_dez, count_jan, count_fev, count_mar, count_abr, count_mai, count_jun],
            }],
        },
        options: {
            scales: {
                xAxes: [{
                    time: {
                        unit: 'month'
                    },
                    gridLines: {
                        display: true
                    },
                    ticks: {
                        maxTicksLimit: 8
                    }
                }],
                yAxes: [{
                    ticks: {
                        min: 0,
                        maxTicksLimit: 5
                    },
                    gridLines: {
                        display: true
                    }
                }],
            },
            legend: {
                display: true
            }
        }
    });
</script>


<!-- Chart: Contador Estado Tickets -->
<?php
$new_status = 0;
$waiting_reply_status = 1;
$closed_status = 2;

$new_count = 0;
$reply_count = 0;
$closed_count = 0;

$db = new DB();
$dbconn = $db->conn;

//ESTATISTICAS: TICKETS NOVOS
$sql = "SELECT COUNT(*) AS new_tickets FROM tickets WHERE status=$new_status";
$ntr = mysqli_query($dbconn, $sql);
if ($ntr->num_rows > 0) {
    while ($row = $ntr->fetch_assoc()) {
        $new_count = $row['new_tickets'];
    }
}

//ESTATISTICAS: AGUARDAM RESPOSTA
$sql = "SELECT COUNT(*) AS new_tickets FROM tickets WHERE status=$waiting_reply_status";
$rtc = mysqli_query($dbconn, $sql);
if ($rtc->num_rows > 0) {
    while ($row = $rtc->fetch_assoc()) {
        $reply_count = $row['new_tickets'];
    }
}

//ESTATISTICAS: FECHADOS
$sql = "SELECT COUNT(*) AS new_tickets FROM tickets WHERE status=$closed_status";
$ctr = mysqli_query($dbconn, $sql);
if ($ctr->num_rows > 0) {
    while ($row = $ctr->fetch_assoc()) {
        $closed_count = $row['new_tickets'];
    }
}
?>

<script>
    // Definir font
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    //Definir variaveis com valores PHP
    var count_new_tickets = <?php echo (json_encode($new_count)); ?>;
    var count_waiting_tickets = <?php echo (json_encode($reply_count)); ?>;
    var count_closed_tickets = <?php echo (json_encode($closed_count)); ?>;

    // Gerar Chart (Pie)
    var ctx = document.getElementById("myPieChartEstado");
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["Novos", "Em Espera", "Fechados"],
            datasets: [{
                data: [count_new_tickets, count_waiting_tickets, count_closed_tickets],
                backgroundColor: ['#007bff', '#ffc107', '#202024'],
            }],
        },
    });
</script>


<!-- Chart: Contador Estado Tickets -->
<?php
$prioridade_normal = 0;
$prioridade_alta = 1;

$priori_normal_count = 0;
$priori_alta_count = 0;

$db = new DB();
$dbconn = $db->conn;

//ESTATISTICAS: TICKETS PRIORIDADE NORMAL
$sql = "SELECT COUNT(*) AS prioridade_tickets FROM tickets WHERE prioridade=$prioridade_normal AND status!=$closed_status";
$ntr = mysqli_query($dbconn, $sql);
if ($ntr->num_rows > 0) {
    while ($row = $ntr->fetch_assoc()) {
        $priori_normal_count = $row['prioridade_tickets'];
    }
}

//ESTATISTICAS: TICKETS PRIORIDADE ALTA
$sql = "SELECT COUNT(*) AS prioridade_tickets FROM tickets WHERE prioridade=$prioridade_alta AND status!=$closed_status";
$rtc = mysqli_query($dbconn, $sql);
if ($rtc->num_rows > 0) {
    while ($row = $rtc->fetch_assoc()) {
        $priori_alta_count = $row['prioridade_tickets'];
    }
}
?>

<script>
    // Definir font
    Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
    Chart.defaults.global.defaultFontColor = '#292b2c';

    //Definir variaveis com valores PHP
    var count_normal_tickets = <?php echo (json_encode($priori_normal_count)); ?>;
    var count_alta_tickets = <?php echo (json_encode($priori_alta_count)); ?>;

    // Gerar Chart (Pie)
    var ctx = document.getElementById("myPieChartPrioridade");
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["Normal", "Alta"],
            datasets: [{
                data: [count_normal_tickets, count_alta_tickets],
                backgroundColor: ['#28a745', '#dc3545',],
            }],
        },
    });
</script>
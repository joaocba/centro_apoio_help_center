<?php
//MENU ADMINISTRADOR
if (isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] == true) {
    echo '
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Painel Administrador</div>
                    <a class="nav-link" href="./admin-panel/painel-admin.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-pie-chart"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Utilizadores</div>
                    <a class="nav-link" href="./admin-panel/gerir-clientes.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-people"></i></div>
                        Gerir Clientes
                    </a>
                    <a class="nav-link" href="./admin-panel/gerir-agentes.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-person-workspace"></i></div>
                        Gerir Agentes
                    </a>
                    <div class="sb-sidenav-menu-heading">Knowledge Base</div>
                    <a class="nav-link" href="./admin-panel/gerir-kb.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-pencil-square"></i></div>
                        Gerir KB
                    </a>
                    <div class="sb-sidenav-menu-heading">Definições</div>
                    <a class="nav-link" href="./admin-panel/definicoes-admin.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-sliders"></i></div>
                        Aceder Definições
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Sessão iniciada em:</div>
                <div class="blob blobgreen"></div> '.$_SESSION['nome'] . ' ' . $_SESSION['apelido'].'
            </div>
        </nav>
    </div>
    ';
}

//MENU AGENTE
if (isset($_SESSION['agent_logged']) && $_SESSION['agent_logged'] == true) {

    //Contador de tickets
    $count_tickets_novos = 0;
    $count_tickets_espera = 0;
    $count_tickets_prioridade_alta = 0;
    $count_tickets_prioridade_normal = 0;

    $db = new DB();
    $dbconn = $db->conn;

    //Novos
    $sql = "SELECT COUNT(*) AS new_tickets FROM tickets WHERE status=0";
    $ntr = mysqli_query($dbconn, $sql);
    if ($ntr->num_rows > 0) {
        while ($row = $ntr->fetch_assoc()) {
            $count_tickets_novos = $row['new_tickets'];
        }
    }

    //Em Espera
    $sql = "SELECT COUNT(*) AS new_tickets FROM tickets WHERE status=1";
    $wtr = mysqli_query($dbconn, $sql);
    if ($wtr->num_rows > 0) {
        while ($row = $wtr->fetch_assoc()) {
            $count_tickets_espera = $row['new_tickets'];
        }
    }

    //Prioridade Alta
    $sql = "SELECT COUNT(*) AS prioridade_tickets FROM tickets WHERE prioridade=1 AND status!=2";
    $rtc = mysqli_query($dbconn, $sql);
    if ($rtc->num_rows > 0) {
        while ($row = $rtc->fetch_assoc()) {
            $count_tickets_prioridade_alta = $row['prioridade_tickets'];
        }
    }

    //Prioridade Normal
    $sql = "SELECT COUNT(*) AS prioridade_tickets FROM tickets WHERE prioridade=0 AND status!=2";
    $ntr = mysqli_query($dbconn, $sql);
    if ($ntr->num_rows > 0) {
        while ($row = $ntr->fetch_assoc()) {
            $count_tickets_prioridade_normal = $row['prioridade_tickets'];
        }
    }

    echo '
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Painel Agente</div>
                    <a class="nav-link" href="./agent-panel/painel-agente.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-pie-chart"></i></div>
                        Dashboard
                    </a>

                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="bi bi-ticket-perforated"></i></div>
                        Tickets
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="./global-panel/procurar-ticket.php">Procurar Ticket</a>
                            <a class="nav-link" href="./agent-panel/agente-tickets-novos.php">Novos <span class="align-items-center badge rounded-pill bg-secondary" style="margin-left: auto; !important">'.$count_tickets_novos.'</span></a>
                            <a class="nav-link" href="./agent-panel/agente-tickets-espera.php">Em Espera <span class="align-items-center badge rounded-pill bg-secondary" style="margin-left: auto; !important">'.$count_tickets_espera.'</span></a>
                            <a class="nav-link" href="./agent-panel/agente-tickets-fechados.php">Fechados</a>
                            <a class="nav-link" href="./agent-panel/agente-tickets-prioridade-um.php">Prioridade Alta <span class="align-items-center badge rounded-pill bg-secondary" style="margin-left: auto; !important">'.$count_tickets_prioridade_alta.'</span></a>
                            <a class="nav-link" href="./agent-panel/agente-tickets-prioridade-zero.php">Prioridade Normal <span class="align-items-center badge rounded-pill bg-secondary" style="margin-left: auto; !important">'.$count_tickets_prioridade_normal.'</span></a>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">Estatisticas</div>
                    <a class="nav-link" href="./agent-panel/estatisticas-agente.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-graph-up"></i></div>
                        Ver Estatisticas
                    </a>
                    <div class="sb-sidenav-menu-heading">Knowledge Base</div>
                    <a class="nav-link" href="./global-panel/knowledge-base.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-info-circle"></i></div>
                        Ver Artigos
                    </a>
                    <a class="nav-link" href="./global-panel/pesquisa-kb.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-search"></i></div>
                        Procurar Artigos
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Sessão iniciada em:</div>
                <div class="blob blobgreen"></div> '.$_SESSION['nome'] . ' ' . $_SESSION['apelido'].'
            </div>
        </nav>
    </div>
    ';
}

//MENU CLIENTE
if (isset($_SESSION['user_logged']) && $_SESSION['user_logged'] == true) {

    //Contador de tickets
    $count_tickets_abertos = 0;

    //Var User ID:
    $userid = $_SESSION['id'];

    $db = new DB();
    $dbconn = $db->conn;

    $sql = "SELECT COUNT(*) AS new_tickets FROM tickets WHERE user_id='$userid' AND status!=2";
    $ntr = mysqli_query($dbconn, $sql);
    if ($ntr->num_rows > 0) {
        while ($row = $ntr->fetch_assoc()) {
            $count_tickets_abertos = $row['new_tickets'];
        }
    }

    echo '
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark shadow" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Painel Cliente</div>
                    <a class="nav-link" href="./user-panel/painel-cliente.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-pie-chart"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">Tickets</div>
                    <a class="nav-link" href="./global-panel/procurar-ticket.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-search"></i></div>
                        Procurar Ticket
                    </a>
                    <a class="nav-link" href="./user-panel/criar-ticket.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-pencil-square"></i></div>
                        Novo Ticket
                    </a>
                    <a class="nav-link" href="./user-panel/tickets-abertos.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-ticket-perforated"></i></div>
                        Tickets Abertos <span class="align-items-center badge rounded-pill bg-secondary" style="margin-left: auto; !important">'.$count_tickets_abertos.'</span>
                    </a>
                    <a class="nav-link" href="./user-panel/tickets-fechados.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-ticket-perforated"></i></div>
                        Tickets Resolvidos
                    </a>
                    <div class="sb-sidenav-menu-heading">Knowledge Base</div>
                    <a class="nav-link" href="./global-panel/knowledge-base.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-info-circle"></i></div>
                        Ver Artigos
                    </a>
                    <a class="nav-link" href="./global-panel/pesquisa-kb.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-search"></i></div>
                        Procurar Artigos
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Sessão iniciada em:</div>
                <div class="blob blobgreen"></div> '.$_SESSION['nome'] . ' ' . $_SESSION['apelido'].'
            </div>
        </nav>
    </div>
    ';
}
?>
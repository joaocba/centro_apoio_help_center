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
                    <div class="sb-sidenav-menu-heading">Tickets</div>
                    <a class="nav-link" href="./global-panel/procurar-ticket.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-search"></i></div>
                        Procurar Ticket
                    </a>
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
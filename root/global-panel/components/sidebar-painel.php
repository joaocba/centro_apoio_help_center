<?php
//MENU ADMINISTRADOR
if (isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] == true) {
    echo '
    <div class="border-end bg-dark text-white" id="sidebar-wrapper">
        <div class="sidebar-heading border-bottom bg-dark text-white">Menu</div>
        <div class="list-group list-group-flush">
            <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="./admin-panel/painel-admin.php"><i class="bi bi-pie-chart"></i> Painel</a>
            <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="./admin-panel/gerir-clientes.php"><i class="bi bi-people"></i> Gerir Clientes</a>
            <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="./admin-panel/gerir-agentes.php"><i class="bi bi-person-workspace"></i> Gerir Agentes</a>
            <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="./admin-panel/gerir-kb.php"><i class="bi bi-pencil-square"></i> Gerir Knowledge Base</a>
            <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="./admin-panel/definicoes-admin.php"><i class="bi bi-sliders"></i> Definições</a>
        </div>
    </div>
    ';
}

//MENU AGENTE
if (isset($_SESSION['agent_logged']) && $_SESSION['agent_logged'] == true) {
    echo '
    <div class="border-end bg-dark text-white" id="sidebar-wrapper">
        <div class="sidebar-heading border-bottom bg-dark text-white">Menu</div>
        <div class="list-group list-group-flush">
            <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="./agent-panel/painel-agente.php"><i class="bi bi-pie-chart"></i> Painel</a>
            <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="./global-panel/procurar-ticket.php"><i class="bi bi-search"></i> Procurar Ticket</a>
            <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="./agent-panel/estatisticas-agente.php"><i class="bi bi-graph-up"></i> Estatisticas</a>
            <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="./global-panel/knowledge-base.php"><i class="bi bi-info-circle"></i> Knowledge Base</a>
            <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="./global-panel/pesquisa-kb.php"><i class="bi bi-search"></i> Pesquisar na KB</a>
        </div>
    </div>
    ';
}

//MENU CLIENTE
if (isset($_SESSION['user_logged']) && $_SESSION['user_logged'] == true) {
    echo '
    <div class="border-end bg-dark text-white" id="sidebar-wrapper">
        <div class="sidebar-heading border-bottom bg-dark text-white">Menu</div>
        <div class="list-group list-group-flush">
            <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="./user-panel/painel-cliente.php"><i class="bi bi-pie-chart"></i> Painel</a>
            <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="./global-panel/procurar-ticket.php"><i class="bi bi-search"></i> Procurar Ticket</a>
            <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="./user-panel/criar-ticket.php"><i class="bi bi-pencil-square"></i> Novo Ticket</a>
            <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="./global-panel/knowledge-base.php"><i class="bi bi-info-circle"></i> Knowledge Base</a>
            <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="./global-panel/pesquisa-kb.php"><i class="bi bi-search"></i> Pesquisar na KB</a>
        </div>
    </div>
    ';
}

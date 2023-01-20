<?php
//MENU ADMINISTRADOR
if (isset($_SESSION['admin_logged']) && $_SESSION['admin_logged'] == true) {
    echo '
    <div class="bg-dark text-white" id="sidebar-wrapper">
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
    <div class="bg-dark text-white" id="sidebar-wrapper">
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
    <div class="bg-dark text-white" id="sidebar-wrapper">
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
?>


<!--
<div class="bg-dark text-white" id="sidebar-wrapper">
    <div class="sidebar-heading border-bottom bg-dark text-white">Menu</div>
    <div class="list-group list-group-flush">
        <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="./user-panel/painel-cliente.php"><i class="bi bi-pie-chart"></i> Painel</a>
        <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="./global-panel/procurar-ticket.php"><i class="bi bi-search"></i> Procurar Ticket</a>
        <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="./user-panel/criar-ticket.php"><i class="bi bi-pencil-square"></i> Novo Ticket</a>
        <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="./global-panel/knowledge-base.php"><i class="bi bi-info-circle"></i> Knowledge Base</a>
        <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="./global-panel/pesquisa-kb.php"><i class="bi bi-search"></i> Pesquisar na KB</a>
    </div>
</div>


<aside id="sidebar-wrapper" class="sidebar bg-dark text-white">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item"> <a class="nav-link " href="index.html"> <i class="bi bi-grid"></i> <span>Dashboard</span> </a></li>
        <li class="nav-item"> <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#" aria-expanded="false"> <i class="bi bi-menu-button-wide"></i><span>Components</span><i class="bi bi-chevron-down ms-auto"></i> </a>
            <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav" style="">
                <li> <a href="components-alerts.html"> <i class="bi bi-circle"></i><span>Alerts</span> </a></li>
            </ul>
        </li>
        <li class="nav-heading">Pages</li>
        <li class="nav-item"> <a class="nav-link collapsed" href="users-profile.html"> <i class="bi bi-person"></i> <span>Profile</span> </a></li>
        <li class="nav-item"> <a class="nav-link collapsed" href="pages-faq.html"> <i class="bi bi-question-circle"></i> <span>F.A.Q</span> </a></li>
        <li class="nav-item"> <a class="nav-link collapsed" href="pages-contact.html"> <i class="bi bi-envelope"></i> <span>Contact</span> </a></li>
        <li class="nav-item"> <a class="nav-link collapsed" href="pages-register.html"> <i class="bi bi-card-list"></i> <span>Register</span> </a></li>
        <li class="nav-item"> <a class="nav-link collapsed" href="pages-login.html"> <i class="bi bi-box-arrow-in-right"></i> <span>Login</span> </a></li>
        <li class="nav-item"> <a class="nav-link collapsed" href="pages-error-404.html"> <i class="bi bi-dash-circle"></i> <span>Error 404</span> </a></li>
        <li class="nav-item"> <a class="nav-link collapsed" href="pages-blank.html"> <i class="bi bi-file-earmark"></i> <span>Blank</span> </a></li>
    </ul>
</aside>
-->
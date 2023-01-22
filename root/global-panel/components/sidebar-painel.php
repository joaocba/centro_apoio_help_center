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
    <div id="sidebar-wrapper" class="bg-dark text-white position-fixed">
        <div class="sidebar-heading border-bottom bg-dark text-white"></div>
        <div class="list-group list-group-flush">
            <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="./user-panel/painel-cliente.php"><i class="bi bi-pie-chart"></i> Painel</a>
            <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="./global-panel/procurar-ticket.php"><i class="bi bi-search"></i> Procurar Ticket</a>
            <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="./user-panel/criar-ticket.php"><i class="bi bi-pencil-square"></i> Novo Ticket</a>
            <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="./global-panel/knowledge-base.php"><i class="bi bi-info-circle"></i> Knowledge Base</a>
            <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="./global-panel/pesquisa-kb.php"><i class="bi bi-search"></i> Pesquisar na KB</a>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed list-group-item-dark p-3" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            <span><i class="bi bi-info-circle"></i> Knowledge Base</span>
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="">
                            <a class="list-group-item list-group-item-action list-group-item-dark p-3" href="./global-panel/pesquisa-kb.php"><i class="bi bi-search"></i> Pesquisar na KB</a>
                        </div>
                    </div>
                </div>
            </div>
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

.sidebar {
  position: fixed;
  top: 60px;
  left: 0;
  bottom: 0;
  width: 300px;
  z-index: 996;
  transition: all 0.3s;
  padding: 20px;
  overflow-y: auto;
  scrollbar-width: thin;
  scrollbar-color: #aab7cf transparent;
  box-shadow: 0px 0px 20px rgba(1, 41, 112, 0.1);
  background-color: #fff;
}

.sidebar-nav {
  padding: 0;
  margin: 0;
  list-style: none;
}

.sidebar-nav .nav-item {
  margin-bottom: 5px;
}

.sidebar-nav li {
  padding: 0;
  margin: 0;
    margin-bottom: 0px;
  list-style: none;
}

.sidebar-nav .nav-link {
  display: flex;
  align-items: center;
  font-size: 15px;
  font-weight: 600;
  color: #4154f1;
  transition: 0.3;
  background: #f6f9ff;
  padding: 10px 15px;
  border-radius: 4px;
}
.nav-link {
  display: block;
  padding: var(--bs-nav-link-padding-y) var(--bs-nav-link-padding-x);
  font-size: var(--bs-nav-link-font-size);
  font-weight: var(--bs-nav-link-font-weight);
  color: var(--bs-nav-link-color);
  text-decoration: none;
  transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out;
}

.sidebar-nav .nav-link.collapsed {
  color: #012970;
  background: #fff;
}


<aside id="sidebar-wrapper" class="sidebar bg-dark text-white">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item"> <a class="nav-link " href="./user-panel/painel-cliente.php"> <i class="bi bi-pie-chart"></i> <span>Dashboard</span> </a></li>
        <li class="nav-item"> <a class="nav-link collapsed" href="./global-panel/procurar-ticket.php"> <i class="bi bi-search"></i> <span>Procurar Ticket</span> </a></li>
        <li class="nav-item"> <a class="nav-link collapsed" href="./user-panel/criar-ticket.php"> <i class="bi bi-search"></i> <span>Novo Ticket</span> </a></li>
        <li class="nav-item"> <a class="nav-link collapsed" href="./global-panel/knowledge-base.php"> <i class="bi bi-info-circle"></i> <span>Knowledge Base</span> </a></li>
        <li class="nav-item"> <a class="nav-link collapsed" href="./global-panel/pesquisa-kb.php"> <i class="bi bi-search"></i> <span>Pesquisar na KB</span> </a></li>

        <li class="nav-item"> <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#" aria-expanded="false"> <i class="bi bi-info-circle"></i><span>./global-panel/knowledge-base.php</span><i class="bi bi-chevron-down ms-auto"></i> </a>
            <ul id="components-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav" style="">
                <li> <a href="./global-panel/pesquisa-kb.php"> <i class="bi bi-circle"></i><span>Pesquisar na KB</span> </a></li>
            </ul>
        </li>

    </ul>
</aside>




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


<div class="bg-dark text-white" id="sidebar-wrapper">
    <div class="sidebar-heading border-bottom bg-dark text-white">Menu</div>
    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-start" id="menu">
        <li class="nav-item">
            <a href="#" class="nav-link text-truncate">
                <i class="fs-5 bi-house"></i><span class="ms-1 d-none d-sm-inline">Home</span>
            </a>
        </li>
        <li>
            <a href="#submenu1" data-bs-toggle="collapse" class="nav-link text-truncate">
                <i class="fs-5 bi-speedometer2"></i><span class="ms-1 d-none d-sm-inline">Dashboard</span> </a>
        </li>
        <li>
            <a href="#" class="nav-link text-truncate">
                <i class="fs-5 bi-table"></i><span class="ms-1 d-none d-sm-inline">Orders</span></a>
        </li>
        <li class="dropdown">
            <a href="#" class="nav-link dropdown-toggle  text-truncate" id="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fs-5 bi-bootstrap"></i><span class="ms-1 d-none d-sm-inline">Bootstrap</span>
            </a>
            <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdown">
                <li><a class="dropdown-item" href="#">New project...</a></li>
                <li><a class="dropdown-item" href="#">Settings</a></li>
                <li><a class="dropdown-item" href="#">Profile</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="#">Sign out</a></li>
            </ul>
        </li>
        <li>
            <a href="#" class="nav-link text-truncate">
                <i class="fs-5 bi-grid"></i><span class="ms-1 d-none d-sm-inline">Products</span></a>
        </li>
        <li>
            <a href="#" class="nav-link text-truncate">
                <i class="fs-5 bi-people"></i><span class="ms-1 d-none d-sm-inline">Customers</span> </a>
        </li>
    </ul>
</div>


-->
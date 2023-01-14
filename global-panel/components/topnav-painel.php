<?php
$now = new DateTime();

echo '
<!-- Top navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white border-bottom">
    <div class="container-fluid">
        <button class="btn btn-primary" id="sidebarToggle"><i class="bi bi-list"></i></button>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                <li class="nav-item"><a class="nav-link disabled" href="#"><i class="bi bi-clock-history"></i> Última atualização às '.$now->format('H:i:s').'</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bi bi-gear-fill"></i></a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="./global-panel/perfil.php"><i class="bi bi-person-check"></i> Perfil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="./components/logout.php"><i class="bi bi-box-arrow-right"></i> Terminar sessão</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
';
?>
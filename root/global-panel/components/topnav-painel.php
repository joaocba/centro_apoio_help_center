<?php
$now = new DateTime();
?>

<!-- Top navigation-->
<nav id="global_panel_topnav" class="navbar navbar-expand-lg navbar-dark bg-dark text-white shadow fixed-top">
    <div class="container-fluid">
        <button class="btn btn-primary" id="sidebarToggle"><i class="bi bi-list"></i></button>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <a class="navbar-brand ms-3" href="<?= $_SERVER['PHP_SELF'] ?>">
                <img src="./assets/img/logos/logof_white.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                Centro de Apoio
            </a>
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                <li class="nav-item"><a class="nav-link disabled" href="#"><i class="bi bi-clock-history"></i> Última atualização às <?php echo $now->format('H:i:s');?></a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img class="rounded-circle" src="./assets/img/panel/avatar.png" alt="" height="20px">
                        <?php echo mb_substr($_SESSION['nome'], 0, 1).'. '.$_SESSION['apelido']; ?>
                        <!--<i class="bi bi-gear-fill"></i>-->
                    </a>
                    <div class="dropdown-menu dropdown-menu-end" style="width: 200px;" aria-labelledby="navbarDropdown">
                        <div class="text-center my-3">
                            <span class="fs-5 fw-semibold">
                                <?php echo $_SESSION['nome'].' '.$_SESSION['apelido']; ?>
                            </span>
                            <br>
                            <span class="text-muted">
                                <?php
                                if ($_SESSION['role'] == 0){
                                    echo 'Utilizador';
                                }elseif ($_SESSION['role'] == 1){
                                    echo 'Agente';
                                }elseif ($_SESSION['role'] == 2){
                                    echo 'Administrador';
                                }
                                ?>
                            </span>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="./global-panel/perfil.php"><i class="bi bi-person-check"></i> Perfil</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="./components/logout.php"><i class="bi bi-box-arrow-right"></i> Terminar sessão</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>

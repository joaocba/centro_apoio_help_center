<?php
$now = new DateTime();
?>

<!-- TOP NAVBAR -->
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark shadow">
    <!-- Logo -->
    <a class="navbar-brand ps-3" href="<?= /*$_SERVER['PHP_SELF']*/$_SERVER['REQUEST_URI'] ?>"><img src="../assets/img/logos/logof_white.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top"> Centro de Apoio</a>
    <!-- Botão Sidebar -->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Info Atualização -->
    <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <a class="nav-link disabled" href="#"><i class="bi bi-clock-history"></i> Última atualização às <?php echo $now->format('H:i:s'); ?></a>
    </div>
    <!-- Menu Perfil -->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" style="width: 200px;" aria-labelledby="navbarDropdown">
                <li class="text-center my-3">
                    <span class="fs-5 fw-semibold">
                        <?php echo $_SESSION['nome'] . ' ' . $_SESSION['apelido']; ?>
                    </span>
                    <br>
                    <span class="text-muted">
                        <?php
                        if ($_SESSION['role'] == 0) {
                            echo 'Utilizador';
                        } elseif ($_SESSION['role'] == 1) {
                            echo 'Agente';
                        } elseif ($_SESSION['role'] == 2) {
                            echo 'Administrador';
                        }
                        ?>
                    </span>
                </li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="../global-panel/perfil.php"><i class="bi bi-person-check"></i> Perfil</a></li>
                <li>
                    <hr class="dropdown-divider" />
                </li>
                <li><a class="dropdown-item" href="../components/logout.php"><i class="bi bi-box-arrow-right"></i> Terminar sessão</a></li>
            </ul>
        </li>
    </ul>
</nav>
<!-- END TOP NAVBAR V2 -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container px-5">
        <a class="navbar-brand" href="index.php<?= $_SESSION['lang_set'] ?>">
            <img src="./assets/img/logos/logof_white.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
            Centro de Apoio
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="index.php<?= $_SESSION['lang_set'] ?>"><?php echo $lang['topnav_inicio']; ?></a></li>
                <li class="nav-item"><a class="nav-link" href="sobre.php<?= $_SESSION['lang_set'] ?>"><?php echo $lang['topnav_sobre']; ?></a></li>
                <li class="nav-item"><a class="nav-link" href="blog.php<?= $_SESSION['lang_set'] ?>"><?php echo $lang['topnav_blog']; ?></a></li>
                <li class="nav-item"><a class="nav-link" href="contacto.php<?= $_SESSION['lang_set'] ?>"><?php echo $lang['topnav_contacto']; ?></a></li>
                <li class="nav-item"><a class="nav-link" href="login.php"><?php echo $lang['topnav_login']; ?></a></li>

                <!-- LANG SELECTOR -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="./assets/img/landing/<?= $_SESSION['flag'] ?>.png" alt="">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="<?= $_SERVER['PHP_SELF'] ?>?lang=pt-pt"><img src="./assets/img/landing/pt-pt.png" alt=""></a></li>
                        <li><a class="dropdown-item" href="<?= $_SERVER['PHP_SELF'] ?>?lang=en-us"><img src="./assets/img/landing/en-us.png" alt=""></a></li>
                        <li><a class="dropdown-item" href="<?= $_SERVER['PHP_SELF'] ?>?lang=fr-fr"><img src="./assets/img/landing/fr-fr.png" alt=""></a></li>
                        <li><a class="dropdown-item" href="<?= $_SERVER['PHP_SELF'] ?>?lang=es-sp"><img src="./assets/img/landing/es-sp.png" alt=""></a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>
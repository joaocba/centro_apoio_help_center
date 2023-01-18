<!-- FOOTER TOP -->
<div id="footer">
    <div class="footer-top text-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 footer-contact">
                    <h3>Centro de Apoio</h3>
                    <p> Edifício Oneshop <br> E.N.10, km 127<br> 2615-701 Alverca do Ribatejo <br><br> <strong>Telefone:</strong> +351 250000000<br> <strong>Email:</strong> info@info.com<br></p>
                </div>
                <div class="col-lg-3 col-md-6 footer-links">
                    <h4><?php echo $lang['footer_links']; ?></h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="index.php<?= $_SESSION['lang_set'] ?>"><?php echo $lang['footer_inicio']; ?></a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="sobre.php<?= $_SESSION['lang_set'] ?>"><?php echo $lang['footer_sobre']; ?></a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="blog.php<?= $_SESSION['lang_set'] ?>"><?php echo $lang['footer_blog']; ?></a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="contacto.php<?= $_SESSION['lang_set'] ?>"><?php echo $lang['footer_contacto']; ?></a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="login.php">Login</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 footer-links">
                    <h4><?php echo $lang['footer_servicos']; ?></h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#"><?php echo $lang['footer_servico1']; ?></a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#"><?php echo $lang['footer_servico2']; ?></a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#"><?php echo $lang['footer_servico3']; ?></a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#"><?php echo $lang['footer_servico4']; ?></a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#"><?php echo $lang['footer_servico5']; ?></a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 footer-links">
                    <h4><?php echo $lang['footer_social']; ?></h4>
                    <p><?php echo $lang['footer_social_sub']; ?></p>
                    <div class="social-links mt-3">
                        <a href="#" class="twitter"><i class="bi-twitter"></i></a>
                        <a href="#" class="facebook"><i class="bi-facebook"></i></a>
                        <a href="#" class="instagram"><i class="bi-instagram"></i></a>
                        <a href="#" class="google-plus"><i class="bi-microsoft-teams"></i></a>
                        <a href="#" class="linkedin"><i class="bi-telegram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER BOTTOM -->
<footer id="footer-bottom" class="bg-dark py-4 mt-auto clearfix">
    <div class="container">
        <div class="row align-items-center justify-content-between flex-column flex-sm-row">
            <div class="col-auto">
                <div class="small m-0 text-white">&copy; Copyright 2022-<script>document.write(new Date().getFullYear())</script>, Centro de Apoio</div>
            </div>
            <div class="col-auto">
                <a class="link-light small" href="./privacidade.php<?= $_SESSION['lang_set'] ?>"><?php echo $lang['footer_privacy']; ?></a>
                <span class="text-white mx-1">&middot;</span>
                <a class="link-light small" href="./termos.php<?= $_SESSION['lang_set'] ?>"><?php echo $lang['footer_terms']; ?></a>
                <span class="text-white mx-1">&middot;</span>
                <a class="link-light small" href="contacto.php<?= $_SESSION['lang_set'] ?>"><?php echo $lang['footer_contacto']; ?></a>
            </div>
        </div>
    </div>
</footer>
<!-- FOOTER PANEL -->
<footer id="footer-panel" class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex justify-content-center small">
            <div class="text-muted">&copy; Copyright 2022-<script>document.write(new Date().getFullYear())</script>, Centro de Apoio</div>
        </div>
    </div>
</footer>

<!-- Button -->
<button type="button" class="btn btn-primary btn-floating rounded-circle opacity-75" id="btn-back-to-top">
    <i class="bi bi-arrow-up"></i>
</button>

<script>
    //Identificar botão
    let mybutton = document.getElementById("btn-back-to-top");

    // A partir de 50px de scroll para baixo mostra o botão
    window.onscroll = function() {
        scrollFunction();
    };

    function scrollFunction() {
        if (
            document.body.scrollTop > 50 ||
            document.documentElement.scrollTop > 50
        ) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // Ao clicar no botão sobe para o topo
    mybutton.addEventListener("click", backToTop);

    function backToTop() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    }
</script>
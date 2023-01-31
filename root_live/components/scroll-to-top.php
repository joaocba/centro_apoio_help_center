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
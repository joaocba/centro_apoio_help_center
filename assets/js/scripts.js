
// Sidebar (abrir-fechar)
window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});


//Validar Password e Confirma Password - NAO TESTADO
function validate() {
    var a = document.getElementById("password").value;
    var b = document.getElementById("confirm_password").value;
    if (a != b) {
        alert("Campo Password e Confirma Password não coincidem");
        return false;
    }
}
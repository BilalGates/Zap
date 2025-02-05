document.addEventListener('DOMContentLoaded', function() {
    var botonesEliminar = document.querySelectorAll('.cancelar-plan');

    botonesEliminar.forEach(function(boton) {
        boton.addEventListener('click', function() {
            var idsub = this.getAttribute('data-id');
            var confirmar = confirm('¿Estás seguro de que deseas cancelar tu plan?');

            if (confirmar) {
                window.location.href = '../php/cliente_gestionar.php?cancelar_plan=' + idsub;
            } else {
                alert('No se cancelará el plan');
            }
        });
    });
});

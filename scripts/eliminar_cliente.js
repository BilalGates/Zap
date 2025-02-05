document.addEventListener('DOMContentLoaded', function() {
    var botonesEliminar = document.querySelectorAll('.eliminar-cliente');

    botonesEliminar.forEach(function(boton) {
        boton.addEventListener('click', function() {
            var idcliente = this.getAttribute('data-id');
            var confirmar = confirm('¿Estás seguro de que quieres eliminar tu cuenta?');

            if (confirmar) {
                window.location.href = '../php/cliente_gestionar.php?eliminar_cliente=' + idcliente;
            } else {
                alert('No se eliminará tu cuenta');
            }
        });
    });
});

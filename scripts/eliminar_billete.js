document.addEventListener('DOMContentLoaded', function() {
    var botonesEliminar = document.querySelectorAll('.eliminar-billete');

    botonesEliminar.forEach(function(boton) {
        boton.addEventListener('click', function() {
            var idBillete = this.getAttribute('data-id');
            var confirmar = confirm('¿Estás seguro de que deseas eliminar este billete?');

            if (confirmar) {
                window.location.href = '../php/cliente_gestionar.php?eliminar_billete=' + idBillete;
            } else {
                alert('No se eliminará el billete');
            }
        });
    });
});

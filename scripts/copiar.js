function seleccionarTexto() {
    var textoEditable = document.querySelector(".texto-editable");

    if (textoEditable) {
        var contenidoTexto = textoEditable.textContent || textoEditable.innerText;
        
        // Crear un elemento de texto temporal
        var elementoTemporal = document.createElement("textarea");
        elementoTemporal.value = contenidoTexto;

        // Añadir el elemento temporal al documento
        document.body.appendChild(elementoTemporal);

        // Seleccionar y copiar el contenido
        elementoTemporal.select();
        document.execCommand("copy");

        // Eliminar el elemento temporal
        document.body.removeChild(elementoTemporal);

        alert("Correo electrónico copiado al portapapeles");
    } else {
        console.error("Elemento con clase 'texto-editable' no encontrado.");
    }
}

document.addEventListener("DOMContentLoaded", function () {
    const viajeInfoElements = document.querySelectorAll('.viaje-info');
    const numPasajerosSelect = document.getElementById('num_pasajeros_select');

    function isInViewport(element) {
        const rect = element.getBoundingClientRect();
        return (
            rect.top >= 0 &&
            rect.left >= 0 &&
            rect.bottom <= (window.innerHeight || document.documentElement.clientHeight) &&
            rect.right <= (window.innerWidth || document.documentElement.clientWidth)
        );
    }

    function handleScroll() {
        viajeInfoElements.forEach((element) => {
            if (isInViewport(element)) {
                element.classList.add('scroll');
            }
        });
    }

    window.addEventListener('scroll', handleScroll);
    handleScroll();

    // Nuevas funciones para manejar el desplazamiento del desplegable
    function updatePasajeros(value) {
        numPasajerosSelect.value = value;
    }

    function increment() {
        var currentValue = parseInt(numPasajerosSelect.value, 10);
        if (currentValue < 6) {
            updatePasajeros(currentValue + 1);
        }
    }

    function decrement() {
        var currentValue = parseInt(numPasajerosSelect.value, 10);
        if (currentValue > 1) {
            updatePasajeros(currentValue - 1);
        }
    }

    // Asigna las nuevas funciones a los botones de incremento y decremento
    const incrementButton = document.getElementById('increment_button');
    const decrementButton = document.getElementById('decrement_button');

    incrementButton.addEventListener('click', increment);
    decrementButton.addEventListener('click', decrement);
});
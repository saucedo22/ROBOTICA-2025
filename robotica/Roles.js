// Selecciona todos los cuadros de entrada, incluyendo inputs y select
const formElements = document.querySelectorAll('input, select');

// Agrega el efecto al pasar el mouse sobre cada elemento
formElements.forEach(element => {
    element.addEventListener('mouseover', () => {
        // Aplica la animación de zoom hacia el frente
        element.animate(
            [
                { transform: 'scale(1)' },     // Tamaño original
                { transform: 'scale(1.1)' }   // Tamaño ampliado
            ],
            {
                duration: 300, // Duración del zoom
                easing: 'ease', // Suavidad en la transición
                fill: 'forwards' // Se mantiene en la posición final
            }
        );
    });

    // Regresa a su tamaño original al salir el mouse
    element.addEventListener('mouseleave', () => {
        element.animate(
            [
                { transform: 'scale(1.1)' },  // Tamaño ampliado
                { transform: 'scale(1)' }    // Vuelve al tamaño original
            ],
            {
                duration: 300, // Duración del retorno
                easing: 'ease', // Suavidad en la transición
                fill: 'forwards' // Se mantiene en la posición final
            }
        );
    });
});
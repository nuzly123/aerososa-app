// Definir una función para calcular la duración del vuelo
function calcularDuracion(horaSalidaElementId, horaLlegadaElementId, duracionVueloElementId) {
    var horaSalida = document.getElementById(horaSalidaElementId).value;
    var horaLlegada = document.getElementById(horaLlegadaElementId).value;

    // Verificar si ambos campos tienen valores
    if (horaSalida && horaLlegada) {
        var horaSalidaObj = new Date('1970-01-01T' + horaSalida + 'Z'); // Convertir a objeto Date
        var horaLlegadaObj = new Date('1970-01-01T' + horaLlegada + 'Z'); // Convertir a objeto Date

        // Calcular la diferencia en milisegundos
        var duracionMilisegundos = horaLlegadaObj - horaSalidaObj;

        // Convertir la diferencia a horas y minutos
        var duracionHoras = Math.floor(duracionMilisegundos / (1000 * 60 * 60));
        var duracionMinutos = Math.floor((duracionMilisegundos % (1000 * 60 * 60)) / (1000 * 60));

        // Formatear la duración
        var duracionFormateada = duracionHoras.toString().padStart(2, '0') + ':' + duracionMinutos.toString().padStart(2, '0');

        // Mostrar la duración en el campo de texto
        document.getElementById(duracionVueloElementId).value = duracionFormateada;
    } else {
        // Limpiar el campo de duración si uno de los campos está vacío
        document.getElementById(duracionVueloElementId).value = '';
    }
}

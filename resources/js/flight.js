/* function calcularDuracion() {
    var horaSalida = document.getElementById('hora_salida').value;
    var horaLlegada = document.getElementById('hora_llegada').value;

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
        var duracionFormateada = duracionHoras.toString().padStart(2, '0') + ':' + duracionMinutos.toString()
            .padStart(2, '0');

        // Mostrar la duración en el campo de texto
        document.getElementById('duracion_vuelo').value = duracionFormateada;
    } else {
        // Limpiar el campo de duración si uno de los campos está vacío
        document.getElementById('duracion_vuelo').value = '';
    }
} */

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

// Capturar el evento de cambio en el campo select de vuelos
$('#flight_selected').change(function() {
    var numeroVueloSeleccionado = $(this).val();

    // Hacer una solicitud AJAX para obtener la información del vuelo seleccionado desde el servidor
    $.ajax({
        url: '/get-flight-info',
        method: 'GET',
        data: {
            numero_vuelo: numeroVueloSeleccionado
        },
        success: function(response) {
            // Autocompletar los campos relacionados en el formulario
            $('#flight_route').val(response.origin, response.destination);
            $('#campo_salida').val(response.salida);
            $('#campo_llegada').val(response.llegada);
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
});

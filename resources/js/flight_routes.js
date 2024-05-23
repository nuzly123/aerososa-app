function concatenarRuta(origen, destino) {
    var ruta = origen + " - " + destino;
    return ruta;
}

function actualizarRuta() {
    var origenIndex = document.getElementById("origin").selectedIndex;
    var destinoIndex = document.getElementById("destination").selectedIndex;

    // Verificar si se seleccionó una opción válida en ambos selectores
    if (origenIndex !== 0 && destinoIndex !== 0) {
        var origen = document.getElementById("origin").options[origenIndex].text;
        var destino = document.getElementById("destination").options[destinoIndex].text;

        // Verificar si las ciudades seleccionadas son diferentes
        if (origen !== destino) {
            var ruta = concatenarRuta(origen, destino);
            document.getElementById("route").value = ruta;
            document.getElementById("warning-message").style.display = "none"; // Ocultar mensaje de advertencia
            document.getElementById("addButton").disabled = false; // Habilitar botón de añadir
        } else {
            document.getElementById("route").value = "";
            document.getElementById("warning-message").textContent = "¡Por favor, selecciona ciudades diferentes!";
            document.getElementById("warning-message").style.display = "block"; // Mostrar mensaje de advertencia
            document.getElementById("addButton").disabled = true; // Deshabilitar botón de añadir
        }
    } else {
        document.getElementById("route").value = "";
        document.getElementById("warning-message").style.display = "none"; // Ocultar mensaje de advertencia
        document.getElementById("addButton").disabled = true; // Deshabilitar botón de añadir
    }
}


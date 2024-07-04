// JavaScript para calcular la suma de pasajeros y mostrar el resultado en el campo total
document.addEventListener("DOMContentLoaded", function () {
    // Obtener los elementos de los campos de pasajeros y total
    var pxInput = document.getElementById("px");
    var infInput = document.getElementById("inf");
    var totalInput = document.getElementById("total");

    // Función para calcular la suma de pasajeros y mostrar el resultado en el campo total
    function calcularTotalPasajeros() {
        // Obtener los valores de los campos px e inf
        var pxValue = parseInt(pxInput.value) || 0;
        var infValue = parseInt(infInput.value) || 0;

        // Calcular la suma de pasajeros
        var sumaTotal = pxValue + infValue;

        // Mostrar la suma en el campo total
        totalInput.value = sumaTotal;
    }

    // Agregar eventos change a los campos px e inf
    pxInput.addEventListener("change", calcularTotalPasajeros);
    infInput.addEventListener("change", calcularTotalPasajeros);
});

// JavaScript para calcular la suma de libras y mostrar el resultado en el campo total_lbs
document.addEventListener("DOMContentLoaded", function () {
    // Obtener los elementos de los campos de libras y total_lbs
    var pxLbsInput = document.getElementById("px_lbs");
    var freightInput = document.getElementById("freight");
    var transInput = document.getElementById("trans_weight");
    var totalLbsInput = document.getElementById("total_lbs");

    // Función para calcular la suma de libras y mostrar el resultado en el campo total_lbs
    function calcularTotalLbs() {
        // Obtener los valores de los campos px_lbs, freight y trans
        var pxLbsValue = parseInt(pxLbsInput.value) || 0;
        var freightValue = parseInt(freightInput.value) || 0;
        var transValue = parseInt(transInput.value) || 0;

        // Calcular la suma de libras
        var sumaTotalLbs = pxLbsValue + freightValue + transValue;

        // Mostrar la suma en el campo total_lbs
        totalLbsInput.value = sumaTotalLbs;
    }

    // Agregar eventos change a los campos px_lbs, freight y trans
    pxLbsInput.addEventListener("change", calcularTotalLbs);
    freightInput.addEventListener("change", calcularTotalLbs);
    transInput.addEventListener("change", calcularTotalLbs);
});

/* document.addEventListener("DOMContentLoaded", function () {
    // Obtener los elementos de los campos de libras y total_lbs
    var residual = document.getElementById("residual");
    var refueling = document.getElementById("refueling");
    var totalInitial = document.getElementById("initial_fuel");
    var consumption = document.getElementById("fuel_consumption");
    var new_residual = document.getElementById("residual_fuel");

    function calcularInitialFuel() {
        var residualValue = parseInt(residual.value) || 0;
        var refuelingValue = parseInt(refueling.value) || 0;
        var fuel_consumption = parseInt(consumption.value) || 0;

        // Calcular la suma
        var sumInitial = residualValue + refuelingValue;
        totalInitial.value = sumInitial;

        var newResidual = sumInitial - fuel_consumption;
        new_residual.value = newResidual;
    }

    refueling.addEventListener("change", calcularInitialFuel);
    consumption.addEventListener("change", calcularInitialFuel);
});
 */
<script>
function validarFormularioHotel() {
    var nombre = document.getElementById("nombre").value;
    var ubicacion = document.getElementById("ubicacion").value;
    var habitaciones = document.getElementById("habitaciones_disponibles").value;
    var tarifa = document.getElementById("tarifa_noche").value;

    if (nombre === "" || ubicacion === "" || habitaciones === "" || tarifa === "") {
        alert("Todos los campos son obligatorios.");
        return false;
    }

    if (isNaN(habitaciones) || habitaciones <= 0) {
        alert("Las habitaciones disponibles deben ser un número mayor que cero.");
        return false;
    }

    if (isNaN(tarifa) || tarifa <= 0) {
        alert("La tarifa por noche debe ser un número mayor que cero.");
        return false;
    }

    return true;
}
</script>
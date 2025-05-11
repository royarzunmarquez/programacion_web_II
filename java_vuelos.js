<script>
function validarFormularioVuelo() {
    var origen = document.getElementById("origen").value;
    var destino = document.getElementById("destino").value;
    var fecha = document.getElementById("fecha").value;
    var plazas = document.getElementById("plazas_disponibles").value;
    var precio = document.getElementById("precio").value;

    if (origen === "" || destino === "" || fecha === "" || plazas === "" || precio === "") {
        alert("Todos los campos son obligatorios.");
        return false;
    }

    if (isNaN(plazas) || plazas <= 0) {
        alert("Las plazas disponibles deben ser un número mayor que cero.");
        return false;
    }

    if (isNaN(precio) || precio <= 0) {
        alert("El precio debe ser un número mayor que cero.");
        return false;
    }

    return true;
}
</script>
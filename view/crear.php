<?php
require_once("../models/db.php");
$mesaje = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escapar los valores para evitar SQL Injection
    $nombre = $conn->real_escape_string($_POST['nombre']);
    $apellido = $conn->real_escape_string($_POST['apellido']);
    $identificacion = $conn->real_escape_string($_POST['identificacion']);
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $ubicacion = $conn->real_escape_string($_POST['ubicacion']);

    // Consulta de inserción
    $sql = "INSERT INTO `1` (Nombre, Apellido, Identificación, Telefono, Udicación) 
            VALUES ('$nombre', '$apellido', '$identificacion', '$telefono', '$ubicacion')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "Registro Exitoso";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // No cierres la conexión aquí, ya que lo necesitas para otras posibles operaciones
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Agenda Telefónica</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../index.php">Crear Agenda Telefonica</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="../index.php">Inicio  <span class="sr-only">(current)</span></a>
                </li>
              
            </ul>
        </div>
    </nav>
   

    <div class="container">
    <h1 class="mt-5">Crear una entrada en la Agenda Telefónica</h1>
    <form method="POST" action="" onsubmit="return validarFormulario()">
        <div class="form-group">
            <label for="nombre">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required pattern="[A-Za-z\s]+" title="El nombre solo puede contener letras.">
        </div>
        <div class="form-group">
            <label for="apellido">Apellido</label>
            <input type="text" class="form-control" id="apellido" name="apellido" required pattern="[A-Za-z\s]+" title="El apellido solo puede contener letras.">
        </div>
        <div class="form-group">
            <label for="identificacion">Identificación</label>
            <input type="number" class="form-control" id="identificacion" name="identificacion" required minlength="6" maxlength="10" title="La identificación debe tener entre 6 y 10 dígitos.">
        </div>
        <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="number" class="form-control" id="telefono" name="telefono" required minlength="8" maxlength="10" title="El teléfono debe tener entre 8 y 10 dígitos.">
        </div>
        <div class="form-group">
            <label for="ubicacion">Ubicación</label>
            <textarea class="form-control" id="ubicacion" name="ubicacion" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<script>
    function validarFormulario() {
        var nombre = document.getElementById('nombre').value.trim();
        var apellido = document.getElementById('apellido').value.trim();
        var identificacion = document.getElementById('identificacion').value.trim();
        var telefono = document.getElementById('telefono').value.trim();
        var ubicacion = document.getElementById('ubicacion').value.trim();

        var nombreApellidoRegex = /^[A-Za-z\s]+$/;

        // Validar nombre y apellido (solo letras)
        if (!nombreApellidoRegex.test(nombre)) {
            alert("El nombre solo puede contener letras.");
            return false;
        }
        if (!nombreApellidoRegex.test(apellido)) {
            alert("El apellido solo puede contener letras.");
            return false;
        }

        // Validar identificación (6-10 dígitos)
        if (identificacion.length < 6 || identificacion.length > 10) {
            alert("La identificación debe tener entre 6 y 10 dígitos.");
            return false;
        }

        // Validar teléfono (8-10 dígitos)
        if (telefono.length < 8 || telefono.length > 10) {
            alert("El teléfono debe tener entre 8 y 10 dígitos.");
            return false;
        }

        // Validar ubicación (no vacía)
        if (ubicacion === "") {
            alert("La ubicación no puede estar vacía.");
            return false;
        }

        // Si todo está bien, permitir el envío del formulario
        return true;
    }
</script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


<?php
require_once("../models/db.php");

if (isset($_POST['id_usuario'])) {
    $id_usuario = $_POST['id_usuario'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $identificacion = $_POST['identificacion'];
    $telefono = $_POST['telefono'];
    $ubicacion = $_POST['ubicacion'];

    // Verificar si $ubicacion está vacío o no
    if (empty($ubicacion)) {
        echo "El campo Ubicación no puede estar vacío.";
    } else {
        // Corregir el nombre de la columna y usar el tipo adecuado
        $query = "UPDATE `1` SET Nombre = ?, Apellido = ?, Identificación = ?, Telefono = ?, Ubicación = ? WHERE id_usuario = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssissi", $nombre, $apellido, $identificacion, $telefono, $ubicacion, $id_usuario);

        if ($stmt->execute()) {
            header("Location: ../index.php");
        } else {
            echo "Error al actualizar el registro.";
        }

        $stmt->close();
    }

    $conn->close();
}
?>

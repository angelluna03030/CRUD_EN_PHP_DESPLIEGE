<?php
require_once("../models/db.php");

if (isset($_POST['id_usuario'])) {
    $id_usuario = $_POST['id_usuario'];

    $query = "DELETE FROM `1` WHERE id_usuario = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_usuario);

    if ($stmt->execute()) {
        header("Location: ../index.php");
    } else {
        echo "Error al eliminar el registro.";
    }

    $stmt->close();
    $conn->close();
}
?>
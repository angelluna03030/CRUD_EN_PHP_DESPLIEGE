<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Telefonica</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Agenda Telefonica</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="view/crear.php">Crear <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="jumbotron">
            <h1 class="display-4">¡Bienvenidos a Agenda Telefonica!</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID Usuario</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido</th>
                        <th scope="col">Identificacion</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Ubicacion</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once("models/db.php"); // Asegúrate de que la conexion esté en db.php

                    $query = "SELECT * FROM `1`"; // Suponiendo que tu tabla se llama `1`
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <th scope='row'>{$row['id_usuario']}</th>
                                <td>{$row['Nombre']}</td>
                                <td>{$row['Apellido']}</td>
                                <td>{$row['Identificacion']}</td>
                                <td>{$row['Telefono']}</td>
                                <td>{$row['Ubicacion']}</td>
                                <td>
                                    <!-- Boton Editar -->
                                    <button type='button' class='btn btn-outline-secondary' data-toggle='modal' data-target='#editModal' data-id='{$row['id_usuario']}' data-nombre='{$row['Nombre']}' data-apellido='{$row['Apellido']}' data-identificacion='{$row['Identificacion']}' data-telefono='{$row['Telefono']}' data-ubicacion='{$row['Ubicacion']}'>
                                        Editar
                                    </button>
                                    <!-- Boton Eliminar -->
                                    <form action='controller/eliminar.php' method='POST' style='display:inline-block;'>
                                        <input type='hidden' name='id_usuario' value='{$row['id_usuario']}'>
                                        <button type='submit' class='btn btn-outline-danger'>Eliminar</button>
                                    </form>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No hay registros en la base de datos</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal para Editar -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="controller/editar.php" method="POST">
                    <input type="hidden" id="edit-id" name="id_usuario">
                    <div class="form-group">
                        <label for="edit-nombre">Nombre</label>
                        <input type="text" class="form-control" id="edit-nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-apellido">Apellido</label>
                        <input type="text" class="form-control" id="edit-apellido" name="apellido" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-identificacion">Identificacion</label>
                        <input type="number" class="form-control" id="edit-identificacion" name="identificacion" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-telefono">Teléfono</label>
                        <input type="number" class="form-control" id="edit-telefono" name="telefono" required>
                    </div>
                    <div class="form-group">
                        <label for="edit-ubicacion">Ubicacion</label>
                        <textarea class="form-control" id="edit-ubicacion" name="ubicacion" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        // Script para pasar los datos al modal de edicion
        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Boton que abre el modal
            var id = button.data('id')
            var nombre = button.data('nombre')
            var apellido = button.data('apellido')
            var identificacion = button.data('identificacion')
            var telefono = button.data('telefono')
            var ubicacion = button.data('ubicacion')

            var modal = $(this)
            modal.find('#edit-id').val(id)
            modal.find('#edit-nombre').val(nombre)
            modal.find('#edit-apellido').val(apellido)
            modal.find('#edit-identificacion').val(identificacion)
            modal.find('#edit-telefono').val(telefono)
            modal.find('#edit-ubicacion').val(ubicacion)
        })
    </script>
</body>

</html>



<?php
    require_once '../config/usuarios.php';

    $usuarios = new Usuarios();
    $mostrarTipos = new MostrarTipos();
    $tipos = $mostrarTipos->obtenerTipos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="icon" href="../assets/img/logo23.ico" type="image/x-icon">
    <link rel="stylesheet" href="../includes/css/bootstrap.min.css">
    <link rel="stylesheet" href="../includes/css/principal.css">
    <link rel="stylesheet" href="../includes/css/components.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <style>
        table.dataTable {
            border: 1px solid #dee2e6;
        }
        table.dataTable th,
        table.dataTable td {
            border: 1px solid #dee2e6;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    <div id="navbar"></div>
    <div class="d-flex flex-grow-1">
        <div id="sidebar"></div>
        <div class="content flex-grow-1" id="content">
            <div class="container mt-5">
                <div class="d-flex justify-content-between align-items-center bg-warning text-white p-3 rounded">
                    <h2 class="m-0">Usuarios</h2>
                    <button class="btn btn-success" id="agregar_usuario" data-toggle="modal" data-target="#modalCrearUsuario">Agregar Usuario</button>
                </div>
                <br>
                <table id="usuariosTable" class="table table-bordered table-striped table-light">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Nombre del Usuario</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Contraseña</th>
                            <th scope="col" style="width: 150px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $usuarios->generarFilasUsuarios(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal para Crear Usuario -->
    <div class="modal fade" id="modalCrearUsuario" tabindex="-1" role="dialog" aria-labelledby="modalCrearUsuarioLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCrearUsuarioLabel">Crear Usuario</h5>
                </div>
                <div class="modal-body">
                    <form id="formCrearUsuario" action="../config/usuarios.php" method="POST">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="tipo_usuario">Tipo de Usuario</label>
                            <select class="form-control" id="tipo_usuario" name="tipo_usuario" required>
                                <?php foreach ($tipos as $tipo): ?>
                                    <option value="<?php echo $tipo['id']; ?>"><?php echo $tipo['nombre']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="contraseña">Contraseña</label>
                            <input type="password" class="form-control" id="contraseña" name="contraseña" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Crear Usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditarUsuario" tabindex="-1" role="dialog" aria-labelledby="modalEditarUsuarioLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarUsuarioLabel">Editar Usuario</h5>
            </div>
            <div class="modal-body">
                <form id="formEditarUsuario" action="../config/usuarios.php" method="POST">
                    <input type="hidden" id="editar_id" name="editar_id">
                    <div class="form-group">
                        <label for="editar_nombre">Nombre</label>
                        <input type="text" class="form-control" id="editar_nombre" name="editar_nombre" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="editar_tipo_usuario">Tipo de Usuario</label>
                        <select class="form-control" id="editar_tipo_usuario" name="editar_tipo_usuario" required>
                            <?php foreach ($tipos as $tipo): ?>
                                <option value="<?php echo $tipo['id']; ?>"><?php echo $tipo['nombre']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="editar_contraseña">Contraseña</label>
                        <input type="password" class="form-control" id="editar_contraseña" name="editar_contraseña" required>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

    
    <!-- Modal para Confirmar Eliminación -->
    <div class="modal fade" id="modalConfirmarEliminar" tabindex="-1" role="dialog" aria-labelledby="modalConfirmarEliminarLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalConfirmarEliminarLabel">Confirmar Eliminación</h5>
                </div>
                <div class="modal-body">
                    <p>¿Estás seguro de que deseas eliminar este usuario?</p>
                </div>
                <div class="modal-footer">
                    <form id="formEliminarUsuario" action="../config/usuarios.php" method="POST">
                        <input type="hidden" name="id" id="idEliminarUsuario">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <footer class="bg-danger text-light text-center py-3 mt-auto">
        Copyright © Las Aguilas del Saber. Nos Reservamos los Derechos.
    </footer>

    <script src="../includes/js/componentes.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script>
$(document).ready(function() {
    $('#modalEditarUsuario').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Botón que abrió el modal
        var id = button.data('id'); // Extraer la información de los atributos data-*
        var nombre = button.data('nombre');
        var tipo = button.data('tipo');

        // Actualizar los valores del modal
        var modal = $(this);
        modal.find('#editar_id').val(id);
        modal.find('#editar_nombre').val(nombre);
        modal.find('#editar_tipo_usuario').val(tipo);
    });

    $('#modalConfirmarEliminar').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var userId = button.data('id');
        var modal = $(this);
        modal.find('#idEliminarUsuario').val(userId);
    });

    $('#usuariosTable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json"
        }
    });
});
</script>

</body>
</html>

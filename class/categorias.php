<?php
require_once '../config/categorias.php';
$categorias = new Categorias();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorías</title>
    <link rel="icon" href="../assets/img/logo23.ico" type="image/x-icon">
    <link rel="stylesheet" href="../includes/css/bootstrap.min.css">
    <link rel="stylesheet" href="../includes/css/principal.css">
    <link rel="stylesheet" href="../includes/css/components.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    <div id="navbar"></div>
    <div class="d-flex flex-grow-1">
        <div id="sidebar"></div>
        <div class="content flex-grow-1" id="content">
            <div class="container mt-5">
                <div class="d-flex justify-content-between align-items-center bg-success text-white p-3 rounded">
                    <h2 class="m-0">Categorías</h2>
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#crearModal">Nueva Categoría</button>
                </div>
                <table class="table table-bordered table-light">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Número Categoría</th>
                            <th scope="col">Nombre de la Categoría</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $categorias->generarFilasCategorias(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <footer class="bg-danger text-light text-center py-3 mt-auto">
        Copyright © Las Aguilas del Saber. Nos Reservamos los Derechos.
    </footer>

    <!-- Modal para crear nueva categoría -->
    <div class="modal fade" id="crearModal" tabindex="-1" role="dialog" aria-labelledby="crearModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crearModalLabel">Crear Nueva Categoría</h5>
                </div>
                <div class="modal-body">
                    <form action="../config/categorias.php" method="POST">
                        <div class="form-group">
                            <label for="nombre_categoria">Nombre de la Categoría</label>
                            <input type="text" class="form-control" id="nombre_categoria" name="nombre_categoria" required>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Crear</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para confirmar eliminación -->
    <div class="modal fade" id="eliminarModal" tabindex="-1" role="dialog" aria-labelledby="eliminarModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eliminarModalLabel">Eliminar Categoría</h5>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar esta categoría?
                </div>
                <div class="modal-footer">
                    <form action="../config/categorias.php" method="POST">
                        <input type="hidden" name="categoria_id" id="categoria_id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="../includes/js/componentes.js"></script>
    <!-- Incluir jQuery, Popper.js y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function setCategoriaId(id) {
            document.getElementById('categoria_id').value = id;
        }
    </script>
</body>
</html>

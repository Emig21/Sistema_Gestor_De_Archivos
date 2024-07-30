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
            <div class="container mt-4">
                <div class="row">
                    <?php
                        $categorias = new Categorias();
                        echo $categorias->generarTarjetasCategorias();
                    ?>
                </div>
                <div class="row">
                <div class="container mt-5 border p-2">
                        <div class="d-flex justify-content-between align-items-center bg-warning text-white p-3 rounded">
                            <h2 class="m-0">Categorías</h2>
                            <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#crearModal">Nueva Categoría</button>
                        </div>
                        <br>
                        <table id="categoriasTable" class="table table-bordered table-striped table-light">
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

    <div class="modal fade" id="modalEditarCategoria" tabindex="-1" role="dialog" aria-labelledby="modalEditarCategoriaLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditarCategoriaLabel">Editar Categoría</h5>
                </div>
                <div class="modal-body">
                    <form id="formEditarCategoria" action="../config/categorias.php" method="POST">
                        <input type="hidden" id="editar_categoria_id" name="categoria_id">
                        <div class="form-group">
                            <label for="editar_nombre_categoria">Nombre de la Categoría</label>
                            <input type="text" class="form-control" id="editar_nombre_categoria" name="nombre_categoria" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
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
    

    <!-- Modal para mostrar documentos de la categoría -->
<div class="modal fade" id="modalDocumentos" tabindex="-1" aria-labelledby="modalDocumentosLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDocumentosLabel">Documentos de la Categoría</h5>
            </div>
            <div class="modal-body">
                <table id="tablaDocumentosCategoria" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Descripción</th>
                            <th>Archivo</th>
                            <th>Fecha de creación</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Contenido generado dinámicamente -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


    <script src="../includes/js/componentes.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function() {
            $('#modalEditarCategoria').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Botón que abrió el modal
                var id = button.data('id'); // Extraer la información de los atributos data-*
                var nombre = button.data('nombre');

                // Actualizar los valores del modal
                var modal = $(this);
                modal.find('#editar_categoria_id').val(id);
                modal.find('#editar_nombre_categoria').val(nombre);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#categoriasTable').DataTable({
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

        function setCategoriaId(id) {
            document.getElementById('categoria_id').value = id;
        }
    </script>

<script>
    $('#modalDocumentos').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var categoriaId = button.data('id');
        var categoriaNombre = button.data('nombre');
        var modal = $(this);
        modal.find('.modal-title').text('Documentos de la Categoría: ' + categoriaNombre);

        $.ajax({
            url: '../config/documentos.php', // Cambia esta URL a la ruta correcta
            method: 'GET',
            data: { categoria_id: categoriaId },
            success: function(response) {
                var documentos = JSON.parse(response);
                var filas = '';

                if (documentos.length > 0) {
                    documentos.forEach(function(doc) {
                        filas += '<tr>';
                        filas += '<td>' + doc.titulo + '</td>';
                        filas += '<td>' + doc.descripcion + '</td>';
                        filas += '<td><a href="' + doc.ruta_archivo + '" target="_blank">Ver Documento</a></td>';
                        filas += '<td>' + doc.fecha_creacion + '</td>';
                        filas += '</tr>';
                    });
                } else {
                    filas = '<tr><td colspan="4" class="text-center">No hay documentos disponibles</td></tr>';
                }

                modal.find('#tablaDocumentosCategoria tbody').html(filas);
            },
            error: function() {
                alert('Error al obtener los documentos de la categoría.');
            }
        });
    });
</script>


</body>
</html>

<?php
require_once '../config/categorias.php';
require_once '../config/documentos.php';
require_once '../config/generar_reporte.php';
$documentos = new Documentos();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documentos</title>
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
            <div class="container mt-5 border p-2">
                <div class="d-flex justify-content-between align-items-center bg-warning text-white p-3 rounded">
                    <h2 class="m-0">Documentos</h2>
                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#reporteModal">Reporte Documentos</a>
                </div>
                <br>
                <table id="documentosTable" class="table table-bordered table-striped table-light">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Título</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Categoría</th>
                            <th scope="col">Documento</th>
                            <th scope="col">Fecha de creación</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            echo $documentos->generarFilasDocumentos();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>    
    </div>

    <!-- Modal Reporte Documentos -->
    <div class="modal fade" id="reporteModal" tabindex="-1" aria-labelledby="reporteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reporteModalLabel">Generar Reportes</h5>
                </div>
                <div class="modal-body">
                    <button type="button" class="btn btn-primary" onclick="mostrarReporte('diario')">Reporte Diario</button>
                    <button type="button" class="btn btn-secondary" onclick="mostrarReporte('mensual')">Reporte Mensual</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para mostrar Reporte Diario -->
    <div class="modal fade" id="reporteDiarioModal" tabindex="-1" aria-labelledby="reporteDiarioModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reporteDiarioModalLabel">Reporte Diario</h5>
                </div>
                <div class="modal-body">
                    <table id="reporteDiarioTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th>Categoría</th>
                                <th>Documento</th>
                                <th>Fecha de creación</th>
                            </tr>
                        </thead>
                        <tbody id="reporteDiarioBody">
                            <!-- Contenido generado dinámicamente -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para mostrar Reporte Mensual -->
    <div class="modal fade" id="reporteMensualModal" tabindex="-1" aria-labelledby="reporteMensualModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reporteMensualModalLabel">Reporte Mensual</h5>
                </div>
                <div class="modal-body">
                    <table id="reporteMensualTable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Título</th>
                                <th>Descripción</th>
                                <th>Categoría</th>
                                <th>Documento</th>
                                <th>Fecha de creación</th>
                            </tr>
                        </thead>
                        <tbody id="reporteMensualBody">
                            <!-- Contenido generado dinámicamente -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Confirmar Eliminación -->
    <div class="modal fade eliminar" id="eliminarModal" tabindex="-1" aria-labelledby="eliminarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eliminarModalLabel">Confirmar Eliminación</h5>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar este elemento?
                </div>
                <div class="modal-footer">
                    <form method="post" action="documentos.php?action=delete">
                        <input type="hidden" name="documento_id" id="documento_id" value="">
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
    <!-- Incluir jQuery, Popper.js y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script>
       function mostrarReporte(tipo) {
    let modalId = tipo === 'diario' ? '#reporteDiarioModal' : '#reporteMensualModal';
    let tablaId = tipo === 'diario' ? '#reporteDiarioBody' : '#reporteMensualBody';
    let fecha = new Date().toISOString().split('T')[0];

    if (tipo === 'mensual') {
        let fechaObj = new Date();
        fecha = new Date(fechaObj.getFullYear(), fechaObj.getMonth(), 1).toISOString().split('T')[0];
    }

    $.ajax({
        url: '../config/documentos.php',
        method: 'GET',
        data: {
            tipo: tipo,
            fecha: fecha
        },
        success: function(response) {
            let documentos = JSON.parse(response);
            console.log("Datos recibidos:", documentos); // Depuración: verificar los datos recibidos
            let filas = '';

            documentos.forEach(function(doc) {
                let categoria = doc.categoria ? doc.categoria : 'Sin categoría'; // Asegurarse de que la categoría esté definida
                filas += `<tr>
                    <td>${doc.titulo}</td>
                    <td>${doc.descripcion}</td>
                    <td>${categoria}</td>
                    <td><a href="${doc.ruta_archivo}" target="_blank">Ver Documento</a></td>
                    <td>${doc.fecha}</td>
                </tr>`;
            });

            $(tablaId).html(filas);
            $(modalId).modal('show');
        },
        error: function() {
            alert('Error al obtener el reporte');
        }
    });
}

    </script>

    <script>
        function setDocumentoId(id) {
            document.getElementById('documento_id').value = id;
        }
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#documentosTable').DataTable({
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

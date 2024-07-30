<?php
require_once '../config/documento_por_usuario.php';
require_once '../config/documentos.php';
require_once '../config/autenticar.php';

$documentosApi = new Documentos();
$numeroDocumentos = $documentosApi->obtenerNumeroDocumentos();

$usuario_id = $_SESSION['usuario_id'];
$documentos = new ObtenerDocumentos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Principal</title>
    <link rel="icon" href="../assets/img/logo23.ico" type="image/x-icon">
    <link rel="stylesheet" href="../includes/css/bootstrap.min.css">
    <link rel="stylesheet" href="../includes/css/principal.css">
    <link rel="stylesheet" href="../includes/css/components.css">
    
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.0/css/bootstrap.min.css" rel="stylesheet">
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
                    <div class="col-md-4">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                    <h1 class="display-4"><?php echo $numeroDocumentos; ?></h1>
                                        <p class="card-text">Documentos</p>
                                    </div>
                                    <div>
                                        <i class="fas fa-file-pdf fa-3x"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="container mt-5 border p-2 bg-light">
                        <div class="d-flex justify-content-between align-items-center bg-warning text-white p-3 rounded">
                            <h2 class="m-0">Mis Documentos</h2>
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    echo $documentos->generarFilasDocumentos($usuario_id);
                                ?>
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
    
    <script src="../includes/js/componentes.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script>
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

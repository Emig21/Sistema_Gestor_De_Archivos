<?php
require_once '../config/documento_por_usuario.php';
require_once '../config/documentos.php';
require_once '../config/autenticar.php';
require_once '../api/reportes.php';


$documentosApi = new Documentos();
$numeroDocumentos = $documentosApi->obtenerNumeroDocumentos();

$apiUrl = "http://localhost/servicios/reportes.php";
$reportesApi = new ReportesAPI($apiUrl);
$numeroEstudiantes = $reportesApi->obtenerNumeroEstudiantes();

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
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    <div id="navbar"></div>
    <div class="d-flex flex-grow-1">
        <div id="sidebar"></div>
        <div class="content flex-grow-1" id="content">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-white bg-danger mb-3">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                    <h1 class="display-4"><?php echo $numeroEstudiantes; ?></h1>
                                        <p class="card-text">Estudiantes</p>
                                    </div>
                                    <div>
                                        <i class="fas fa-user-graduate fa-3x"></i>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-between align-items-center">
                                <span>ir</span>
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
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
                                <span>ir</span>
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="container mt-5">
                    <div class="d-flex justify-content-between align-items-center bg-warning text-white p-3 rounded">
                        <h2 class="m-0">Mis Documentos</h2>
                    </div>
                    <table class="table table-bordered table-light">
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
require_once '../api/reportes.php';

$estudianteId = $_GET['id'];
$apiUrl = "http://localhost/servicios/reportes.php";
$reportesApi = new ReportesAPI($apiUrl);
$reportes = $reportesApi->obtenerReportes();
$detalle = null;

if ($reportes !== null) {
    foreach ($reportes as $reporte) {
        if ($reporte['estudiante_id'] == $estudianteId) {
            $detalle = $reporte;
            break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Estudiante</title>
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
                <div class="d-flex justify-content-between align-items-center bg-warning text-white p-3 rounded">
                    <h2 class="m-0">Detalle del Estudiante</h2>
                </div>
                <?php if ($detalle !== null): ?>
                    <form class="mt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="estudiante_id">Número</label>
                                    <input type="text" class="form-control" id="estudiante_id" value="<?php echo htmlspecialchars($detalle['estudiante_id']); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="cedula">Cédula</label>
                                    <input type="text" class="form-control" id="cedula" value="<?php echo htmlspecialchars($detalle['cedula']); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="apellidos">Apellidos</label>
                                    <input type="text" class="form-control" id="apellidos" value="<?php echo htmlspecialchars($detalle['apellidos']); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nombres">Nombres</label>
                                    <input type="text" class="form-control" id="nombres" value="<?php echo htmlspecialchars($detalle['nombres']); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="lugar_nacimiento">Lugar Nacimiento</label>
                                    <input type="text" class="form-control" id="lugar_nacimiento" value="<?php echo htmlspecialchars($detalle['lugar_nacimiento']); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="residencia">Residencia</label>
                                    <input type="text" class="form-control" id="residencia" value="<?php echo htmlspecialchars($detalle['residencia']); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="direccion">Dirección</label>
                                    <input type="text" class="form-control" id="direccion" value="<?php echo htmlspecialchars($detalle['direccion']); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="sector">Sector</label>
                                    <input type="text" class="form-control" id="sector" value="<?php echo htmlspecialchars($detalle['sector']); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="fecha_nacimiento">Fecha Nacimiento</label>
                                    <input type="text" class="form-control" id="fecha_nacimiento" value="<?php echo htmlspecialchars($detalle['fecha_nacimiento']); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="parentesco_responsable">Parentesco</label>
                                    <input type="text" class="form-control" id="parentesco_responsable" value="<?php echo htmlspecialchars($detalle['parentesco_responsable']); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="estado_estudiante">Estado Estudiante</label>
                                    <input type="text" class="form-control" id="estado_estudiante" value="<?php echo htmlspecialchars($detalle['estado_estudiante']); ?>" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="codigo_unico">Código Único</label>
                                    <input type="text" class="form-control" id="codigo_unico" value="<?php echo htmlspecialchars($detalle['codigo_unico']); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="condicion">Condición</label>
                                    <input type="text" class="form-control" id="condicion" value="<?php echo htmlspecialchars($detalle['condicion']); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="grado">Grado</label>
                                    <input type="text" class="form-control" id="grado" value="<?php echo htmlspecialchars($detalle['grado']); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="paralelo">Paralelo</label>
                                    <input type="text" class="form-control" id="paralelo" value="<?php echo htmlspecialchars($detalle['paralelo']); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="periodo">Periodo</label>
                                    <input type="text" class="form-control" id="periodo" value="<?php echo htmlspecialchars($detalle['periodo']); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="tipo_discapacidad">Tipo Discapacidad</label>
                                    <input type="text" class="form-control" id="tipo_discapacidad" value="<?php echo htmlspecialchars($detalle['tipo_discapacidad']); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="porcentaje_discapacidad">Porcentaje Discapacidad</label>
                                    <input type="text" class="form-control" id="porcentaje_discapacidad" value="<?php echo htmlspecialchars($detalle['porcentaje_discapacidad']); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="carnet_discapacidad">Carnet Discapacidad</label>
                                    <input type="text" class="form-control" id="carnet_discapacidad" value="<?php echo htmlspecialchars($detalle['carnet_discapacidad']); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nombre_responsable">Representante</label>
                                    <input type="text" class="form-control" id="nombre_responsable" value="<?php echo htmlspecialchars($detalle['nombre_responsable']); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="telefono_responsable">Teléfono Representante</label>
                                    <input type="text" class="form-control" id="telefono_responsable" value="<?php echo htmlspecialchars($detalle['telefono_responsable']); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="usuario">Usuario que lo Matriculó</label>
                                    <input type="text" class="form-control" id="usuario" value="<?php echo htmlspecialchars($detalle['usuario']); ?>" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="rol_usuario">Rol</label>
                                    <input type="text" class="form-control" id="rol_usuario" value="<?php echo htmlspecialchars($detalle['rol_usuario']); ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php else: ?>
                    <div class="alert alert-danger mt-3">No se pudo obtener el detalle del estudiante.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <footer class="bg-danger text-light text-center py-3 mt-auto">
        Copyright © Las Aguilas del Saber. Nos Reservamos los Derechos.
    </footer>

    <script src="../includes/js/componentes.js"></script>
    <!-- Incluir jQuery, Popper.js y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

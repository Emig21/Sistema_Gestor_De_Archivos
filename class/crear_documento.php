<?php
require_once '../config/documentos.php';
$categorias = obtenerCategorias();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Documento</title>
    <link rel="icon" href="../assets/img/logo23.ico" type="image/x-icon">
    <link rel="stylesheet" href="../includes/css/bootstrap.min.css">
    <link rel="stylesheet" href="../includes/css/principal.css">
    <link rel="stylesheet" href="../includes/css/components.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100 bglight">
    <div id="navbar"></div>
    <div class="d-flex flex-grow-1">
        <div id="sidebar"></div>
        <div class="content flex-grow-1" id="content">
            <div class="container mt-5">
                <div class="d-flex justify-content-between align-items-center bg-warning text-white p-3 rounded">
                    <h2 class="m-0">Información del Documento</h2>
                </div>
                <form class="border p-3" action="../config/documentos.php" method="POST" enctype="multipart/form-data">
                    <fieldset class="border p-2">
                        <div class="form-group">
                            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="5" placeholder="Descripción"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="categoria">Categoría</label>
                            <select class="form-control" id="categoria" name="categoria" required>
                                <?php foreach ($categorias as $categoria): ?>
                                    <option value="<?php echo $categoria['categoria_id']; ?>"><?php echo htmlspecialchars($categoria['nombre_categoria']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </fieldset>
                    <fieldset class="border p-2 mt-3">
                        <div class="form-group">
                            <label for="archivo">Subir Documento</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="archivo" name="archivo" required>
                            </div>
                            <small class="form-text text-muted">Max. 32MB</small>
                        </div>
                    </fieldset>
                    <div class="form-group mt-3 d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Crear Documento</button>
                        <a href="documentos.php" class="btn btn-secondary">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>    
    </div>
    <footer class="bg-danger text-light text-center py-3 mt-auto">
        Copyright © Las Aguilas del Saber. Nos Reservamos los Derechos.
    </footer>
    
    <script src="../includes/js/componentes.js"></script>
    <!-- Incluir jQuery, Popper.js y Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        // Mostrar el nombre del archivo seleccionado
        $('.custom-file-input').on('change', function() {
            var fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass('selected').html(fileName);
        });
    </script>
</body>
</html>

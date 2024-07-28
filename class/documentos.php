<?php
    require_once '../config/categorias.php';
    require_once '../config/documentos.php';
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
</head>
<body class="d-flex flex-column min-vh-100 bg-light">
    <div id="navbar"></div>
    <div class="d-flex flex-grow-1">
        <div id="sidebar"></div>
        <div class="content flex-grow-1" id="content">
            <div class="container mt-5">
                <div class="d-flex justify-content-between align-items-center bg-warning text-white p-3 rounded">
                    <h2 class="m-0">Documentos</h2>
                    <a href="crear_documento.php" class="btn btn-success">Crear Documento</a>
                </div>
                <table class="table table-bordered table-light">
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
    <!-- Modal -->
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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function setDocumentoId(id) {
            document.getElementById('documento_id').value = id;
        }
    </script>
</body>
</html>

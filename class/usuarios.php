

<?php
require_once '../config/usuarios.php';

$usuarios = new Usuarios();
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div id="navbar"></div>
    <div class="d-flex">
        <div id="sidebar"></div>
        <div class="content" id="content">
        <div class="container mt-5">
                <div class="d-flex justify-content-between align-items-center mb-2 bg-primary text-white p-3 rounded">
                    <h2 class="m-0">Usuarios</h2>
                    <button class="btn btn-light">Agregar Usuario</button>
                </div>
                <table class="table table-bordered table-hover">
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

    <div id="footer"></div>
    
    <script src="../includes/js/componentes.js"></script>
</body>
</html>

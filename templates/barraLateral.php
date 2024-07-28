<?php
    session_start();

    $cargo = $_SESSION['cargo'] ?? '';
?>

<div class="sidebar bg-danger text-light">
    <div class="sidebar-top">
        <img src="../assets/img/logo23.png" alt="Logo" class="logo">

    </div>
    <div class="sidebar-center">
        <ul class="list">
            <li class="list-item">
                <i class="list-item-icon fas fa-home"></i>
                <a class="text-light text-decoration-none fw-bold" href="../class/principal.php">Inicio</a>
            </li>
            <?php if ($cargo === 'Secretaria'): ?>
                <li class="list-item">
                    <i class="list-item-icon fas fa-user-plus"></i>
                    <a class="text-light text-decoration-none fw-bold" href="../class/usuarios.php">Usuarios</a>
                </li>
                <li class="list-item">
                    <i class="list-item-icon fas fa-archive"></i>
                    <a class="text-light text-decoration-none fw-bold" href="../class/categorias.php">Categorías</a>
                </li>
                <li class="list-item">
                    <i class="list-item-icon fas fa-user-graduate"></i>
                    <a class="text-light text-decoration-none fw-bold" href="../class/reportes.php">Reportes</a>
                </li>
            <?php endif; ?>
                <li class="list-item">
                    <i class="list-item-icon fas fa-file-pdf"></i>
                    <a class="text-light text-decoration-none fw-bold" href="../class/documentos.php">Documentos</a>
                </li>
                <li class="list-item">
                    <i class="list-item-icon fas fa-users"></i>
                    <a class="text-light text-decoration-none fw-bold" href="../class/Estudiantes.php">Estudiantes</a>
                </li>
        </ul>
    </div>

</div>

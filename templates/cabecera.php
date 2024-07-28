<?php
    session_start();
    $nombreUsuario = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Usuario';
?>
<nav class="navbar navbar-expand-lg bg-danger fixed-top">
    <div class="container-fluid">
        <div class="row w-100">
            <div class="col-8 d-flex align-items-center">
                <div class="titulo">
                    <span class="brand text-white">SGD Las Aguilas Del Saber</span>
                </div>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
                <img src="../assets/img/usuario3.jpeg" alt="Perfil" class="imagen-perfil rounded-circle" style="width: 40px; height: 40px;">
                <span class="text-light p-3"><?php echo htmlspecialchars($nombreUsuario); ?></span>
                <a class="Btn" href="../config/logout.php">
                    <div class="sign">
                        <svg viewBox="0 0 512 512">
                            <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
                        </svg>
                    </div>
                    <div class="text">Salir</div>
                </a>
            </div>
        </div>
    </div>
</nav>

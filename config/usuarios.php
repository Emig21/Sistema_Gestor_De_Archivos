<?php
require_once 'Conexion.php';

class Usuarios {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->conectar();
        if ($this->conn === null) {
            throw new Exception('No se pudo establecer la conexión a la base de datos.');
        }
    }

    public function obtenerUsuarios() {
        try {
            $sql = "SELECT * FROM seleccionar_usuarios()";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    public function generarFilasUsuarios() {
        $usuarios = $this->obtenerUsuarios();
        $filas = '';
    
        if (!empty($usuarios)) {
            foreach ($usuarios as $usuario) {
                $filas .= '<tr>';
                $filas .= '<td>' . htmlspecialchars($usuario['nombre']) . '</td>';
                $filas .= '<td>' . htmlspecialchars($usuario['tipo_usuario']) . '</td>';
                $filas .= '<td>********</td>';
                $filas .= '<td class="text-center">';
                $filas .= '<button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modalEditarUsuario" data-id="' . $usuario['id'] . '" data-nombre="' . htmlspecialchars($usuario['nombre']) . '" data-tipo="' . $usuario['tipo_usuario'] . '">Editar</button> ';
                $filas .= '<button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalConfirmarEliminar" data-id="' . $usuario['id'] . '">Eliminar</button>';
                $filas .= '</td>';
                $filas .= '</tr>';
            }
        } else {
            $filas .= '<tr>';
            $filas .= '<td colspan="4" class="text-center">No hay usuarios disponibles</td>';
            $filas .= '</tr>';
        }
    
        return $filas;
    }
    

    public function crearUsuario($nombre, $tipo_usuario_id, $contrasena) {
        try {
            $sql = "INSERT INTO public.usuario (nombre, tipo_usuario_id, contraseña) VALUES (:nombre, :tipo_usuario_id, :contrasena)";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':tipo_usuario_id', $tipo_usuario_id);
            $stmt->bindParam(':contrasena', $contrasena);

            if ($stmt->execute()) {
                header('Location: ../class/usuarios.php');
            } else {
                return "Error al crear el usuario.";
            }
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }

    public function actualizarUsuario($id, $nombre, $tipo_usuario_id, $contrasena) {
        try {
            $sql = "UPDATE public.usuario SET nombre = :nombre, tipo_usuario_id = :tipo_usuario_id, contraseña = :contrasena WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':tipo_usuario_id', $tipo_usuario_id);
            $stmt->bindParam(':contrasena', $contrasena);
    
            if ($stmt->execute()) {
                header('Location: ../class/usuarios.php');
            } else {
                return "Error al actualizar el usuario.";
            }
        } catch (PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
    

    public function __destruct() {
        $this->conn = null;
    }
}

class MostrarTipos {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->conectar();
        if ($this->conn === null) {
            throw new Exception('No se pudo establecer la conexión a la base de datos.');
        }
    }

    public function obtenerTipos() {
        try {
            $sql = "SELECT id, nombre FROM tipo_usuario";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    public function __destruct() {
        $this->conn = null;
    }
}

// Eliminar a un usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        $conexion = new Conexion();
        $conn = $conexion->conectar();
        if ($conn === null) {
            throw new Exception('No se pudo establecer la conexión a la base de datos.');
        }

        $sql = "DELETE FROM usuario WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Redirigir de nuevo a la página principal después de eliminar el usuario
        header('Location: ../class/usuarios.php');
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

// Crear un nuevo usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'], $_POST['tipo_usuario'], $_POST['contraseña'])) {
    $nombre = $_POST['nombre'];
    $tipo_usuario_id = $_POST['tipo_usuario'];
    $contrasena = $_POST['contraseña'];

    try {
        $usuarios = new Usuarios();
        $mensaje = $usuarios->crearUsuario($nombre, $tipo_usuario_id, $contrasena);
        echo $mensaje;
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

// Actualizar un usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_id'], $_POST['editar_nombre'], $_POST['editar_tipo_usuario'], $_POST['editar_contraseña'])) {
    $id = $_POST['editar_id'];
    $nombre = $_POST['editar_nombre'];
    $tipo_usuario_id = $_POST['editar_tipo_usuario'];
    $contrasena = $_POST['editar_contraseña'];

    // Verifica que los valores no estén vacíos
    if (!empty($id) && !empty($nombre) && !empty($tipo_usuario_id) && !empty($contrasena)) {
        try {
            $usuarios = new Usuarios();
            $mensaje = $usuarios->actualizarUsuario($id, $nombre, $tipo_usuario_id, $contrasena);
            echo $mensaje;
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        echo 'Todos los campos son obligatorios.';
    }
}

?>

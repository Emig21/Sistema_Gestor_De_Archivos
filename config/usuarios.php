<?php
require_once 'Conexion.php';  // Asegúrate de que la ruta a Conexion.php es correcta

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
                $filas .= '<td>' . htmlspecialchars($usuario['contraseña']) . '</td>';
                $filas .= '<td class="text-center">';
                $filas .= '<button class="btn btn-warning btn-sm">Editar</button> ';
                $filas .= '<button class="btn btn-danger btn-sm">Eliminar</button>';
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

    public function __destruct() {
        $this->conn = null;
    }
}
?>

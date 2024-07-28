<?php
require_once 'Conexion.php';

class ObtenerDocumentos {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->conectar();
        if ($this->conn === null) {
            throw new Exception('No se pudo establecer la conexión a la base de datos.');
        }
    }

    public function obtenerDocumentosPorUsuario($usuario_id) {
        try {
            $stmt = $this->conn->prepare('SELECT titulo, descripcion, categoria_id, ruta_archivo, fecha_creacion FROM documentos WHERE usuario_id = :usuario_id');
            $stmt->bindParam(':usuario_id', $usuario_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    public function generarFilasDocumentos($usuario_id) {
        $documentos = $this->obtenerDocumentosPorUsuario($usuario_id);
        $filas = '';

        if (!empty($documentos)) {
            foreach ($documentos as $documento) {
                $filas .= '<tr>';
                $filas .= '<td>' . htmlspecialchars($documento['titulo']) . '</td>';
                $filas .= '<td>' . htmlspecialchars($documento['descripcion']) . '</td>';
                $filas .= '<td>' . htmlspecialchars($documento['categoria_id']) . '</td>';
                $filas .= '<td><a href="' . htmlspecialchars($documento['ruta_archivo']) . '" target="_blank">Ver Documento</a></td>';
                $filas .= '<td>' . htmlspecialchars($documento['fecha_creacion']) . '</td>';
                $filas .= '</tr>';
            }
        } else {
            $filas .= '<tr>';
            $filas .= '<td colspan="5" class="text-center">No hay documentos disponibles</td>';
            $filas .= '</tr>';
        }

        return $filas;
    }

    public function __destruct() {
        $this->conn = null;
    }
}
?>

<?php
require_once 'Conexion.php';

session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['usuario_id'])) {
    die("Error: Usuario no autenticado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $categoria_id = $_POST['categoria'];
    $archivo = $_FILES['archivo'];
    $usuario_id = $_SESSION['usuario_id'];  // Obtener el ID del usuario desde la sesión

    $nombreArchivo = $archivo['name'];
    $rutaArchivo = '../uploads/' . basename($nombreArchivo);

    if (move_uploaded_file($archivo['tmp_name'], $rutaArchivo)) {
        try {
            $conexion = new Conexion();
            $conn = $conexion->conectar();

            $stmt = $conn->prepare('INSERT INTO documentos (titulo, descripcion, categoria_id, ruta_archivo, usuario_id) VALUES (:titulo, :descripcion, :categoria_id, :ruta_archivo, :usuario_id)');
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':descripcion', $descripcion);
            $stmt->bindParam(':categoria_id', $categoria_id);
            $stmt->bindParam(':ruta_archivo', $rutaArchivo);
            $stmt->bindParam(':usuario_id', $usuario_id);  // Asociar el ID del usuario con el documento
            
            if ($stmt->execute()) {
                header('Location: ../class/documentos.php');
            } else {
                echo "Error al crear el documento.";
            }

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        echo "Error al subir el archivo.";
    }
}


function obtenerCategorias() {
    try {
        $conexion = new Conexion();
        $conn = $conexion->conectar();
        if ($conn === null) {
            throw new Exception('No se pudo establecer la conexión a la base de datos.');
        }

        $sql = "SELECT categoria_id, nombre_categoria FROM categorias";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Error al obtener las categorías: ' . $e->getMessage();
        return [];
    }
}

class Documentos {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->conectar();
        if ($this->conn === null) {
            throw new Exception('No se pudo establecer la conexión a la base de datos.');
        }
    }

    public function obtenerDocumentos() {
        try {
            $sql = "SELECT * FROM seleccionar_documentos()";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    public function generarFilasDocumentos() {
        $documentos = $this->obtenerDocumentos();
        $filas = '';

        if (!empty($documentos)) {
            foreach ($documentos as $documento) {
                $filas .= '<tr>';
                $filas .= '<td>' . htmlspecialchars($documento['titulo']) . '</td>';
                $filas .= '<td>' . htmlspecialchars($documento['descripcion']) . '</td>';
                $filas .= '<td>' . htmlspecialchars($documento['categoria']) . '</td>';
                $filas .= '<td><a href="' . htmlspecialchars($documento['ruta_archivo']) . '" target="_blank">Ver Documento</a></td>';
                $filas .= '<td>' . htmlspecialchars($documento['fecha_creacion']) . '</td>';
                $filas .= '<td><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminarModal" onclick="setDocumentoId(' . $documento['documento_id'] . ')">Eliminar</button></td>';
                $filas .= '</tr>';
            }
        } else {
            $filas .= '<tr>';
            $filas .= '<td colspan="6" class="text-center">No hay documentos disponibles</td>';
            $filas .= '</tr>';
        }

        return $filas;
    }

    public function obtenerNumeroDocumentos() {
        $documentos = $this->obtenerDocumentos();
        if ($documentos !== null) {
            return count($documentos);
        } else {
            return 0;
        }
    }

    public function eliminarDocumento($documento_id) {
        try {
            // Obtener la ruta del archivo del documento
            $stmt = $this->conn->prepare('SELECT ruta_archivo FROM public.documentos WHERE documento_id = :documento_id');
            $stmt->bindParam(':documento_id', $documento_id, PDO::PARAM_INT);
            $stmt->execute();
            $documento = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($documento) {
                $rutaArchivo = $documento['ruta_archivo'];

                // Eliminar el archivo del sistema de archivos
                if (file_exists($rutaArchivo)) {
                    unlink($rutaArchivo);
                }

                // Eliminar el registro de la base de datos
                $stmt = $this->conn->prepare('DELETE FROM public.documentos WHERE documento_id = :documento_id');
                $stmt->bindParam(':documento_id', $documento_id, PDO::PARAM_INT);
                return $stmt->execute();
            } else {
                echo 'Documento no encontrado.';
                return false;
            }
        } catch (PDOException $e) {
            echo 'Error al eliminar el documento: ' . $e->getMessage();
            return false;
        }
    }


    public function __destruct() {
        $this->conn = null;
    }
}

// Manejar la solicitud de eliminación
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['action']) && $_GET['action'] === 'delete') {
    $documento_id = $_POST['documento_id'];
    $documentos = new Documentos();
    if ($documentos->eliminarDocumento($documento_id)) {
        header('Location: ../class/documentos.php');
    } else {
        echo 'Error al eliminar el documento';
    }
}



?>

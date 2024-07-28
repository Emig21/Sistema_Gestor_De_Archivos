<?php
require_once 'Conexion.php';

class Categorias {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->conectar();
        if ($this->conn === null) {
            throw new Exception('No se pudo establecer la conexión a la base de datos.');
        }
    }

    public function obtenerCategorias() {
        try {
            $sql = "SELECT categoria_id, nombre_categoria FROM categorias";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return [];
        }
    }

    public function generarFilasCategorias() {
        $categorias = $this->obtenerCategorias();
        $filas = '';

        if (!empty($categorias)) {
            foreach ($categorias as $categoria) {
                $filas .= '<tr>';
                $filas .= '<td>' . htmlspecialchars($categoria['categoria_id']) . '</td>';
                $filas .= '<td>' . htmlspecialchars($categoria['nombre_categoria']) . '</td>';
                $filas .= '<td><button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#eliminarModal" onclick="setCategoriaId(' . $categoria['categoria_id'] . ')">Eliminar</button></td>';
                $filas .= '</tr>';
            }
        } else {
            $filas .= '<tr>';
            $filas .= '<td colspan="3" class="text-center">No hay categorías disponibles</td>';
            $filas .= '</tr>';
        }

        return $filas;
    }

    public function eliminarCategoria($categoria_id) {
        try {
            $stmt = $this->conn->prepare('DELETE FROM categorias WHERE categoria_id = :categoria_id');
            $stmt->bindParam(':categoria_id', $categoria_id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error al eliminar la categoría: ' . $e->getMessage();
            return false;
        }
    }

    public function crearCategoria($nombre_categoria) {
        try {
            $stmt = $this->conn->prepare('INSERT INTO categorias (nombre_categoria) VALUES (:nombre_categoria)');
            $stmt->bindParam(':nombre_categoria', $nombre_categoria);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error al crear la categoría: ' . $e->getMessage();
            return false;
        }
    }

    public function __destruct() {
        $this->conn = null;
    }
}

// Verificar si se está eliminando una categoría
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['categoria_id'])) {
    $categoria_id = $_POST['categoria_id'];
    $categorias = new Categorias();
    if ($categorias->eliminarCategoria($categoria_id)) {
        echo "Categoría eliminada exitosamente.";
    } else {
        echo "Error al eliminar la categoría.";
    }
    header('Location: ../class/categorias.php'); // Redirige de nuevo a la página de la lista de categorías
    exit();
}

// Verificar si se está creando una nueva categoría
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre_categoria'])) {
    $nombre_categoria = $_POST['nombre_categoria'];
    $categorias = new Categorias();
    if ($categorias->crearCategoria($nombre_categoria)) {
        echo "Categoría creada exitosamente.";
    } else {
        echo "Error al crear la categoría.";
    }
    header('Location: ../class/categorias.php'); // Redirige de nuevo a la página de la lista de categorías
    exit();
}

?>

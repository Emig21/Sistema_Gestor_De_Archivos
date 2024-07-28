<?php
require_once 'Conexion.php';

class Autenticacion {
    private $conn;

    public function __construct() {
        $conexion = new Conexion();
        $this->conn = $conexion->conectar();
        if ($this->conn === null) {
            throw new Exception('No se pudo establecer la conexión a la base de datos.');
        }
    }

    public function autenticar($usuario, $password) {
        try {
            $sql = "SELECT u.id, u.nombre, u.tipo_usuario_id, u.contraseña, t.nombre as cargo 
                    FROM public.usuario u 
                    JOIN public.tipo_usuario t ON u.tipo_usuario_id = t.id 
                    WHERE u.nombre = :usuario";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':usuario', $usuario);
            $stmt->execute();
            $usuarioData = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuarioData) {
                if ($password === $usuarioData['contraseña']) {
                    session_start();
                    $_SESSION['usuario_id'] = $usuarioData['id'];
                    $_SESSION['nombre'] = $usuarioData['nombre'];
                    $_SESSION['tipo_usuario_id'] = $usuarioData['tipo_usuario_id'];
                    $_SESSION['cargo'] = $usuarioData['cargo'];
                    return true;
                } else {
                    echo "Contraseña incorrecta.";
                    return false;
                }
            } else {
                echo "No se encontró el usuario.";
                return false;
            }
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header('Location: ../login.html');
        exit();
    }

    public function __destruct() {
        $this->conn = null;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    try {
        $autenticacion = new Autenticacion();
        if ($autenticacion->autenticar($usuario, $password)) {
            header('Location: ../class/principal.php');
            exit();
        } else {
            echo "Usuario o contraseña incorrectos.";
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}
?>

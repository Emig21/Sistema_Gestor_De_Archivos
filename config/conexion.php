<?php

class Conexion {
    private $host = 'localhost';
    private $port = '5432';
    private $dbname = 'aguilas_del_saber';
    private $user = 'postgres';
    private $password = 'tkmch2005';
    private $conn;

    public function conectar() {
        try {
            $this->conn = new PDO("pgsql:host=$this->host;port=$this->port;dbname=$this->dbname", $this->user, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            echo 'Error de conexión: ' . $e->getMessage();
            return null;
        }
    }

    public function desconectar() {
        $this->conn = null;
    }
}

?>

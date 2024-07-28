<?php

class EstudiantesAPI {
    private $url;

    public function __construct($url) {
        $this->url = $url;
    }

    public function obtenerEstudiantes() {
        $curl = curl_init(); 
        curl_setopt($curl, CURLOPT_URL, $this->url);
        curl_setopt($curl, CURLOPT_POST, 1);  
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        if ($response === false) { 
            echo 'Error de cURL: ' . curl_error($curl); 
            return null;
        } else { 
            curl_close($curl); 
            $responseData = json_decode($response, true); 
            if (json_last_error() === JSON_ERROR_NONE) { 
                return $responseData;
            } else { 
                echo 'Error al decodificar la respuesta JSON: ' . json_last_error_msg(); 
                return null;
            }
        }
    }

    public function generarFilasEstudiantes() {
        $estudiantes = $this->obtenerEstudiantes();
        $filas = '';
        
        if ($estudiantes !== null) {
            foreach ($estudiantes as $estudiante) {
                $filas .= '<tr>';
                $filas .= '<td>' . htmlspecialchars($estudiante['nombres']) . '</td>';
                $filas .= '<td>' . htmlspecialchars($estudiante['apellidos']) . '</td>';
                $filas .= '<td>' . htmlspecialchars($estudiante['grado']) . '</td>';
                $filas .= '<td>' . htmlspecialchars($estudiante['periodo']) . '</td>';
                $filas .= '<td>' . htmlspecialchars($estudiante['nombre']) . '</td>';
                $filas .= '</tr>';
            }
        } else {
            $filas .= '<tr><td colspan="5" class="text-center">No se pudo obtener la lista de estudiantes.</td></tr>';
        }
        
        return $filas;
    }
}
?>

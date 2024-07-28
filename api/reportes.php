<?php

class ReportesAPI {
    private $url;

    public function __construct($url) {
        $this->url = $url;
    }

    public function obtenerReportes() {
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

    public function generarFilasReportes() {
        $reportes = $this->obtenerReportes();
        $filas = '';

        if ($reportes !== null) {
            foreach ($reportes as $reporte) {
                $filas .= '<tr>';
                $filas .= '<td>' . htmlspecialchars($reporte['estudiante_id']) . '</td>';
                $filas .= '<td>' . htmlspecialchars($reporte['cedula']) . '</td>';
                $filas .= '<td>' . htmlspecialchars($reporte['nombres']) . '</td>';
                $filas .= '<td>' . htmlspecialchars($reporte['apellidos']) . '</td>';
                $filas .= '<td>' . htmlspecialchars($reporte['grado']) . '</td>';
                $filas .= '<td>' . htmlspecialchars($reporte['usuario']) . '</td>';
                $filas .= '<td><a href="../class/detalle.php?id=' . $reporte['estudiante_id'] . '" class="btn btn-info btn-sm">Ver</a></td>';

                $filas .= '</tr>';
            }
        } else {
            $filas .= '<tr><td colspan="7" class="text-center">No se pudo obtener la lista de reportes.</td></tr>';
        }

        return $filas;
    }


    public function obtenerNumeroEstudiantes() {
        $reportes = $this->obtenerReportes();
        if ($reportes !== null) {
            return count($reportes);
        } else {
            return 0;
        }
    }


}
?>

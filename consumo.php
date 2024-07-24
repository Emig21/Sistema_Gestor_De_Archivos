<?php

$url="http://localhost/servicios/estudiantes.php";
$cualquiera=curl_init(); 
curl_setopt($cualquiera, CURLOPT_URL, $url);
curl_setopt($cualquiera, CURLOPT_POST, 1);  
curl_setopt($cualquiera, CURLOPT_RETURNTRANSFER, true);
$response=curl_exec($cualquiera);

$response = curl_exec($cualquiera);
if ($response === false) { 
    echo 'Error de cURL: ' . curl_error($cualquiera); 
} else { 
    curl_close($cualquiera); 
    echo 'Respuesta del servicio: ' . $response; // Añade esta línea para depuración
    $responseData = json_decode($response, true); 
    if (json_last_error() === JSON_ERROR_NONE) { 
        echo 'Respuesta decodificada: '; print_r($responseData); 
    } else { 
        echo 'Error al decodificar la respuesta JSON: ' . json_last_error_msg(); 
    }
}


?>
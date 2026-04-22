<?php 

try {
    $url = "http://localhost:5000/api/v1/user-access/health/db"; // END POINT PARA VERIFICAR OS STATUS DA API DB

    $ch = curl_init($url); // INICIA A REQUISIÇÃO

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // faz retornar o resultado

    $response = curl_exec($ch); // executa a requisição

    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // pega o status de retorno da requisição
    curl_close($ch);
    $data = json_decode($response, true); // tranforma json em array
    error_reporting(0); // REMOVE AS LOGS DE ERROS NO HEADER


     if($data["connected"] == false || $response == false)
     {
         if($response == false || $response == 0) $statusCode = 503;
         header('Location: ../error/code.php?er='. $statusCode);
        
     }

    

} 
catch (\Throwable $th) {
        echo $th;
        
}


?>
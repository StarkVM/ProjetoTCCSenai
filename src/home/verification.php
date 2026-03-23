<?php 

try {
    $url = "http://localhost:5000/api/v1/user-access/health/db"; // END POINT PARA VERIFICAR OS STATUS DA API DB

    $ch = curl_init($url); // INICIA A REQUISIÇÃO

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // faz retornar o resultado

    $response = curl_exec($ch); // executa a requisição

    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // pega o status de retorno da requisição
    curl_close($ch);

    $data = json_decode($response, true); // tranforma json em array
    $data["connected"] = false;
    if($data["connected"] == false)
    {
        
        
        echo "<script>
            console.log(" . print_r($data) . ");
            console.log('Erro 2:', " . curl_error($ch) . ");    
            </script>";
        echo "<p style='color: red;'>Erro: sem conexão com o servidor!</p>";
        
    }

    
    

} 
catch (\Throwable $th) {
        echo $th;
        
}


?>
<?php 

try {
    $url = "http://localhost:5000/api/v1/user-access/health/db"; // END POINT PARA VERIFICAR OS STATUS DA API DB

    $ch = curl_init($url); // INICIA A REQUISIÇÃO

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // faz retornar o resultado

    $response = curl_exec($ch); // executa a requisição

    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE); // pega o status de retorno da requisição
    curl_close($ch);

    $data = json_decode($response, true); // tranforma json em array
    if($data["connected"] == false)
    {
        
        $erro[0] = print_r($data); // REMOVER NO FUTURO POR MOTIVOS DE SEGURANÇA
        $erro[1] = curl_error($ch); // RETORNA O ERRO
        header("Location: error.php?er=$erro[0]&er2=$erro[1]");
        return;
        
        
    }


} 
catch (\Throwable $th) {
        echo $th;
        
}   

?>


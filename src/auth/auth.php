<?php
try {
    if(!isset($_SESSION))
    {
        header("Location: ../login/code.php");
        return;
    }
    session_start();
    // FAZ A CONEXÃO COM A API PARA ENVIO DOS DADOS
        $url = "http://localhost:5000/api/v1/user-access/auth/refresh-tokens";
        $dados = ["refreshToken" => $_SESSION['refreshToken']];

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // faz a resposta vir como string
        curl_setopt($ch, CURLOPT_POST, true); //  define que é post
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dados)); // envia os dados (json)
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json"
        ]); // tipo do envio

        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $data = json_decode($response, true); // tranforma json em array
        curl_close($ch);
        var_dump($response); // REMOVER ISSO - DEBUG
        var_dump($data); // REMOVER ISSO - DEBUG
        // VERIFICA O CODIGO DE RETORNO DA API E TRATA COM OS RESPECTIVOS CODIGOS
        if ($statusCode >= 200 && $statusCode <= 299 && $data['message'] != 'Refresh Token not found.') {

            $_SESSION['accessToken'] = $data['accessToken'];
            $_SESSION['refreshToken'] = $data['refreshToken'];
            $_SESSION['logado'] = true;

        }
        else {


            session_destroy();
            header('Location: ../login/code.php');

        }
}
catch (Exception $e) {

}

?>
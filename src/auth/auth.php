<?php
require_once("../endpoints.php");
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTCCSenai/src/config/session.php';
$endpoints = new Endpoints();
try {
    if(!isset($_SESSION) || $_SESSION['logado'] == false)
    {
        header("Location: ../login/code.php");
        return;
    }

    // FAZ A CONEXÃO COM A API PARA ENVIO DOS DADOS
        $url = $endpoints->urlRefreshToken;
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

        // VERIFICA O CODIGO DE RETORNO DA API E TRATA COM OS RESPECTIVOS CODIGOS
        if ($statusCode >= 200 && $statusCode <= 299 && $data['message'] != 'Refresh Token not found.') {

            $_SESSION['accessToken'] = $data['accessToken'];
            $_SESSION['refreshToken'] = $data['refreshToken'];
            $_SESSION['logado'] = true;
            include("../home/me.php");
        }
        else {


            session_destroy();
            header('Location: ../login/code.php');

        }
}
catch (Exception $e) {

}

?>

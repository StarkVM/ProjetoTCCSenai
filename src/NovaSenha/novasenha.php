<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTCCSenai/src/config/session.php';
require_once("../endpoints.php");

$endpoints = new Endpoints();

try {
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['atualizar'])){
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $_SESSION["newPassword"] = $senha;
        $_SESSION["email"] = $email;
        $_SESSION["esqueceusenha"] = true;

        // FAZ A CONEXÃO COM A API PARA ENVIO DOS DADOS
        $url = $endpoints->urlEsqueceuSenha;
        $dados = ["email" => $email];


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

        if($statusCode >= 200 && $statusCode <= 299) {


            header("Location: /ProjetoTCCSenai/src/2fa/code.php");
            exit;
        }
        else
        {
            
        }
    }

}
catch (Exception $e) {

}
?>
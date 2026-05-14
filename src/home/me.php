<?php
require_once("../endpoints.php");

$endpoints = new Endpoints();

$tempo = 60 * 60 * 24 * 7; // 7 dias para expirar a sessao

ini_set('session.gc_maxlifetime', $tempo);
session_set_cookie_params($tempo);


if(!isset($_SESSION))
{
    ini_set('session.gc_maxlifetime', $tempo);
    session_set_cookie_params($tempo);
    session_start();
}

try {
    $url = $endpoints->urlME;


    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // faz a resposta vir como string
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: Bearer " . $_SESSION['accessToken']
    ]); // tipo do envio

    $response = curl_exec($ch);
    $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $data = json_decode($response, true); // tranforma json em array
    curl_close($ch);

    if($statusCode >= 200 && $statusCode <= 299 && empty($data['message'])) {
        foreach ($data as $sessao => $value) {
            $_SESSION[$sessao] = $value;
        }
        $_SESSION['logado'] = true;

        header("Location: code.php"); //redirecionar para o home logado
    }
    else
    {
        $_SESSION['logado'] = false;
        header("Location: ../error/code.php?er=". $statusCode);
    }

}
catch (Exception $e) {
    print_r($e->getMessage());
}
?>

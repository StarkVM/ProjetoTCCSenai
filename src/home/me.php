<?php
require_once("../endpoints.php");

$endpoints = new Endpoints();

require_once $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTCCSenai/src/config/session.php';

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


    }
    else
    {
        $_SESSION['logado'] = false;
        if (!defined('NO_REDIRECT')) {
            header("Location: ../error/code.php?er=". $statusCode);
            exit();
        }
    }

}
catch (Exception $e) {
    $_SESSION['logado'] = false;
    if (!defined('NO_REDIRECT')) {
        header("Location: ../error/code.php?er=500");
        exit();
    }
}
?>

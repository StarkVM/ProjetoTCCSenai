<?php
require_once("../endpoints.php");

$endpoints = new Endpoints();

require_once $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTCCSenai/src/config/session.php';

try {
    $url = $endpoints->urlME;


    $ch = curl_init($url);

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); //  define que é delete
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
        session_destroy();
        header("Location: ../home/code.php");


    }
    else
    {
        header("Location: code.php");
    }

}
catch (Exception $e) {

}
?>


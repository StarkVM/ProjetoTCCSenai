<?php

require_once("../endpoints.php");
require("../auth/auth.php");

$endpoints = new Endpoints();

require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTCCSenai/src/config/session.php';

$url = $endpoints->urlProvider;

if($_SESSION["status"] != 3)
{
    header('Content-Type: application/json; charset=utf-8');
    http_response_code(403);
    echo json_encode(["status" => "failed", "reason" => "forbidden"]);
    exit();
}

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // faz a resposta vir como string
curl_setopt($ch, CURLOPT_POST, true); //  define que é post
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "Content-Type: application/json",
    "Authorization: Bearer " . $_SESSION['accessToken']
]); // tipo do envio

$response = curl_exec($ch);
$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$data = json_decode($response, true); // tranforma json em array
curl_close($ch);


if($statusCode >= 200 && $statusCode <= 299) {

    define('NO_REDIRECT', true);
    include "../home/me.php";

    header('Content-Type: application/json; charset=utf-8');
    if (!empty($_SESSION['logado']) && $_SESSION['logado'] === true) {
        echo json_encode(["status" => "success"]);
    } else {
        http_response_code(500);
        echo json_encode(["status" => "failed", "reason" => "session_refresh_failed"]);
    }
}
else
{
    header('Content-Type: application/json; charset=utf-8');
    http_response_code($statusCode ?: 500);
    echo json_encode(["status" => "failed"]);
}

?>
<?php

require_once("../endpoints.php");
require("../auth/auth.php");

$endpoints = new Endpoints();

require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTCCSenai/src/config/session.php';

$url = $endpoints->urlProvider;

if($_SESSION["status"] != 3)
{
    header("Location: ../modal/code.php");
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

    header('Content-Type: application/json');
    echo json_encode(["status" => "success"]);
    include "../home/me.php";
}
else
{
    header('Content-Type: application/json');
    echo json_encode(["status" => "failed"]);
}

?>
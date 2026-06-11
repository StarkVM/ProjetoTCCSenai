<?php
require("../auth/auth.php");
header("Content-Type: application/json; charset=UTF-8");
$dataJS = json_decode(file_get_contents("php://input"), true);

require_once $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTCCSenai/src/config/session.php';
require_once("../endpoints.php");

$endpoints = new Endpoints();




        // FAZ A CONEXÃO COM A API PARA ENVIO DOS DADOS
        $url = $endpoints->urlRentals;
        //$dados = ["email" => $_SESSION["email"]];


        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // faz a resposta vir como string
        curl_setopt($ch, CURLOPT_POST, true); //  define que é post
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dataJS)); // envia os dados (json)
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer " . $_SESSION['accessToken']
        ]); // tipo do envio

        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $data = json_decode($response, true); // tranforma json em array
        curl_close($ch);

        if($statusCode >= 200 && $statusCode <= 299) {


            echo json_encode(["status" => "success"]);

        }
        else
        {


            echo json_encode(["status" => "error"]);
        }


    ?>
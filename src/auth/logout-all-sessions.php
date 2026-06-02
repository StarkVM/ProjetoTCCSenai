<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTCCSenai/src/config/session.php';


require_once("../endpoints.php");

$endpoints = new Endpoints();

 // FAZ A CONEXÃO COM A API PARA ENVIO DOS DADOS
        $url = $endpoints->urlLogoutAllSession;
       //$dados = ["accessToken" => $_SESSION["accessToken"]];


        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // faz a resposta vir como string
        curl_setopt($ch, CURLOPT_POST, true); //  define que é post
        //curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dados)); // envia os dados (json)
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
            "Authorization: Bearer " . $_SESSION['accessToken']
        ]); // tipo do envio

        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $data = json_decode($response, true); // tranforma json em array
        curl_close($ch);
        
        if($statusCode >= 200 && $statusCode <= 299 && $data["success"] == true) {


            session_destroy();
            header("Location: ../home/code.php");
            exit;
        }
        else
        {
            header("Location: ../home/code.php");
            exit;
        }
?>

<?php
require_once("../endpoints.php");

$endpoints = new Endpoints();
    try {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['loginEntrar'])){
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            // VERIFICA SE A SENHA TEM O MINIMO DE 8 CARACTERES
            if(strlen($senha) < 8)
            {
                header('Location: code.php?er=3');
                return;
            }

            // FAZ A CONEXÃO COM A API PARA ENVIO DOS DADOS
            $url = $endpoints->urlLogin;
            $dados = ["email" => $email,
                "password" => $senha];

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
            if ($statusCode >= 200 && $statusCode <= 299 && $data['success'] == 'true') {


                // REDIRECIONAR O USER PARA A PAGINA DE CODIGO LOGIN

            }
            else {

                header('Location: code.php?er=2');

            }




            }
    }
    catch(\Throwable $th)
        {
            echo $th;
        }


?>

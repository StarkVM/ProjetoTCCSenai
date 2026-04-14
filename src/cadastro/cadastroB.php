<?php
    try {

        if (!isset($_SESSION)) {
            session_start();
        } // SE O USER NÃO TIVER UMA SESSÃO ATIVA, IRÁ CRIAR UMA SESSÃO.

        //  RECEBE OS DADOS DO POST REGISTRAR
        if (isset($_POST['registrar']) == "POST") {

            // ATRIBUI VALORES DOS CAMPOS POST A SESSÃO DO USUARIO
            foreach ($_POST as $sessao => $value) {
                $_SESSION[$sessao] = $value;
            }
            // VERIFICAÇÃO DE QUANTIDADE DE CARACTERES NA SENHA
            $senhaF = trim($_SESSION['senha']);
            if(strlen($senhaF) < 8){
                header('Location: code.php?er=3');
                return;
            }
            // CONVERTE A DATA NASCIMENTO PARA DATE TIME
            $dataFormatada = new DateTime($_SESSION['data_nascimento']);
            $dataFormatada->setTimezone(new DateTimeZone("UTC"));

            // FAZ A CONEXÃO COM A API PARA ENVIO DOS DADOS
            $url = "http://localhost:5000/api/v1/user-access/auth/register";
            $dados = ["firstName" => $_SESSION['nome'],
                "lastName" => $_SESSION['sobrenome'],
                "birthDate" => $dataFormatada->format("Y-m-d\TH:i:s.v\Z"),
                "email" => $_SESSION['email'],
                "cpf" => $_SESSION['cpf'],
                "password" => trim($_SESSION['senha']),
                "address" => [
                    "state" => $_SESSION['estado'],
                    "city" => $_SESSION['cidade'],
                    "district" => $_SESSION['bairro'],
                    "street" => $_SESSION['rua'],
                    "zipCode" => $_SESSION['cep']
                ]];
            
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
            if ($statusCode >= 200 && $statusCode <= 299) {


                header('Location: ../2fa/code.php');

            } else if ($statusCode == 409 && $data['message'] == 'CPF already exists.') // CPF JÁ EXISTE
            {


                header('Location: code.php?er=1');

            } else if ($statusCode == 409 && $data['message'] == 'Email already exists.') // CPF JÁ EXISTE
            {

                header('Location: code.php?er=2');
            } else {


                header('Location: code.php?er=4');
            }
        }
    }
    catch (\Throwable $th) {
        echo $th;
    }



?>



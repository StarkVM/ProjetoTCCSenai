<?php

    try {
        if(!isset($_SESSION)){
            session_start();
            } // SE O USER NÃO TIVER UMA SESSÃO ATIVA, IRÁ CRIAR UMA SESSÃO.

        //  RECEBE OS DADOS DO POST REGISTRAR
        if(isset($_POST['registrar']) == "POST"){

            // ATRIBUI VALORES DOS CAMPOS POST A SESSÃO DO USUARIO
            foreach($_POST as $sessao => $value)
                {
                    $_SESSION[$sessao] = $value;  
                }
            
            // FAZ A CONEXÃO COM A API PARA ENVIO DOS DADOS
            $url = "";
            $dados = ["firstName" => $_SESSION['nome'],
            "lastName" => $_SESSION['sobrenome'],
            "birthDate" => $_SESSION['data_nascimento'],
            "email" => $_SESSION['email'],
            "cpf" => $_SESSION['cpf'],
            "password" => $_SESSION['senha'],
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
            $statusCode = 200;
            if($statusCode >= 200 && $statusCode <= 299)
            {
                
                header('Location: ../2fa/2fa.php');
                
            }
            else
            {
                
                
                echo "<script>
                alert('Houve algum erro ao registrar, por favor, tente novamente.');
                setTimeout(function(){
                        window.location.href = 'cadastro.html';
                    });
                </script>";
                
            }
        }
    } 
    catch (\Throwable $th) {
        echo $th;
    }



?>



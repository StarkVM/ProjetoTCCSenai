<?php
require_once("../endpoints.php");
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTCCSenai/src/config/session.php';
$endpoints = new Endpoints();

    try {

        if(isset($_POST['verificar']) == "post")
            {

                foreach($_POST as $valor => $value)
                {
                    $codigo = $codigo . $value;

                }

                if($_SESSION["esqueceusenha"] == true)
                {
                    // FAZ A CONEXÃO COM A API PARA ENVIO DOS DADOS
                    $url = $endpoints->urlResetSenha;
                    $dados = ["email" => $_SESSION['email'],
                        "newPassword" => $_SESSION['newPassword'],
                        "code" => $codigo];
                }
                else if($_SESSION["LoginVerify"] == false)
                {
                    // FAZ A CONEXÃO COM A API PARA ENVIO DOS DADOS
                    $url = $endpoints->urlLoginVerify;
                    $dados = ["email" => $_SESSION['email'],
                        "code" => $codigo];
                }
                else
                {
                    // FAZ A CONEXÃO COM A API PARA ENVIO DOS DADOS
                    $url = $endpoints->urlVerifyEmail;
                    $dados = ["email" => $_SESSION['email'],
                        "code" => $codigo];
                }


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

                if($statusCode >= 200 && $statusCode <= 299 && !isset($data['message']) && !isset($data['success']))
                {
                    if($_SESSION["esqueceusenha"] == true && isset($_SESSION["esqueceusenha"]))
                    {

                        header("Location:/ProjetoTCCSenai/src/login/code.php"); //redirecionar para o login
                        exit();
                    }
                    else
                    {
                        session_unset(); // LIMPA A SESSAO
                        $_SESSION["accessToken"] =  $data['accessToken'];
                        $_SESSION["refreshToken"] = $data['refreshToken'];
                        $_SESSION["accessTokenExpiresAtUtc"] = $data['accessTokenExpiresAtUtc'];
                        $_SESSION["refreshTokenExpiresAtUtc"] = $data['refreshTokenExpiresAtUtc'];
                        $_SESSION["requestId"] = $data['requestId'];
                        $_SESSION["logado"] = true;
                        $_SESSION["LoginVerify"] = true;
                        $dadosQ = ["status" => "success"];
                        session_regenerate_id(true);
                        header("Location: ../home/me.php");
                        exit();
                    }

                    
                }

                else if ($statusCode >= 300 || $data['message'] == "Unable to verify email.")
                {

                    header("location: code.php?er=1");


                }
                else if ($statusCode >= 300 || $data['message'] == "Email or CPF already registered.")
                {

                    header("location: code.php?er=3");


                }
                else{
                    header("location: code.php?er=2");
                }

            }
    } catch (\Throwable $th) {
        //throw $th;

    }
   
    


?>


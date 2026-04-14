<?php
include '../../softwareVerification/querys.php';

    try {
        $ip = $_SERVER['REMOTE_ADDR']; // pega o ip do usuario
        $userAgent = $_SERVER['HTTP_USER_AGENT'];
        session_start();
        if(isset($_POST['verificar']) == "post")
            {
                global $codigo;
                foreach($_POST as $valor => $value)
                {
                    $codigo = $codigo . $value;

                }


                // FAZ A CONEXÃO COM A API PARA ENVIO DOS DADOS
                $url = "http://localhost:5000/api/v1/user-access/auth/email-verification/verify-email";
                $dados = ["email" => $_SESSION['email'],
                        "code" => $codigo];

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
                if($statusCode >= 200 && $statusCode <= 299 && !isset($data['message']))
                {

                    $_SESSION["accessToken"] =  $data['accessToken'];
                    $_SESSION["refreshToken"] = $data['refreshToken'];
                    $_SESSION["accessTokenExpiresAtUtc"] = $data['accessTokenExpiresAtUtc'];
                    $_SESSION["refreshTokenExpiresAtUtc"] = $data['refreshTokenExpiresAtUtc'];
                    $_SESSION["requestId"] = $data['requestId'];

                    $dadosQ = ["status" => "success"];
                    atualizarContador("cadastro", 0, $ip, $userAgent, "site", 0, $dadosQ);
                    echo "success";
                    
                }
                else if ($statusCode >= 300 || $data['message'] == "Unable to verify email.")
                {
                    
                    header("location: code.php?er=1");
                    
                    
                }
                else{
                    header("location: code.php?er=2");
                }
            
            }
    } catch (\Throwable $th) {
        //throw $th;
        echo "erro $th";
    }
   
    


?>


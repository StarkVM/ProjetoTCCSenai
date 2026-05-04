<?php
    try {

        if (!isset($_SESSION)) {
            session_start();
        } // SE O USER NÃO TIVER UMA SESSÃO ATIVA, IRÁ CRIAR UMA SESSÃO.

        // VERIFICAR SE O USUÁRIO ESTÁ LOGADO
        if (!isset($_SESSION['user'])) {
            header('Location: ../login/code.php');
            exit;
        }

        //  RECEBE OS DADOS DO POST REGISTRAR
        if (isset($_POST['registrar']) == "POST") {

            // ATRIBUI VALORES DOS CAMPOS POST A SESSÃO DO USUARIO
            foreach ($_POST as $sessao => $value) {
                $_SESSION[$sessao] = $value;
            }

            // OBTER DADOS DO USUÁRIO LOGADO
            $userData = $_SESSION['user'];
            $userId = $userData['id'] ?? null;

            if (!$userId) {
                header('Location: code.php?er=0');
                return;
            }

            // FAZ A CONEXÃO COM A API PARA ENVIO DOS DADOS DE VENDEDOR
            $url = "http://localhost:5000/api/v1/user-access/vendor/register";
            
            $dados = [
                "userId" => $userId,
                "businessName" => trim($_SESSION['nome_empresa']),
                "businessDescription" => trim($_SESSION['descricao_empresa']),
                "cnpj" => trim(preg_replace('/[^0-9]/', '', $_SESSION['cnpj'])),
                "businessPhone" => trim(preg_replace('/[^0-9]/', '', $_SESSION['telefone_empresa'])),
                "website" => trim($_SESSION['website'] ?? '')
            ];
            
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

                // ATUALIZAR O ROLE DO USUÁRIO NA SESSÃO PARA VENDEDOR
                $_SESSION['user']['role'] = 'vendor';

                // REDIRECIONAR PARA UPLOAD DE DOCUMENTOS (VERIFICAÇÃO)
                header('Location: ../UploadDocumentos/code.html?type=vendor');

            }
            else if ($statusCode >= 300)
                {

                    switch ($data['message'] ?? null)
                    {

                        case "Business profile already exists.":
                            header("location: code.php?er=" . $data['message']);
                            break;
                        case "Invalid user data.":
                            header("location: code.php?er=" . $data['message']);
                            break;
                        case "Database save failed.": // FALHA AO SALVAR NO BANCO
                            header("location: code.php?er=". $data['message']);
                            break;

                        default:
                            header("location: code.php?er=0");
                            break;
                    }


                }
            else {


                header('Location: code.php?er=1');
            }
        }
    }
    catch (\Throwable $th) {
        echo $th;
    }

?>

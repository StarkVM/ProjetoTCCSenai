<<<<<<< Updated upstream
<?php

//  RECEBE OS DADOS DO POST REGISTRAR
    if(isset($_POST['registrar']) === "POST"){
        $nome = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        $data_nascimento = $_POST['data_nascimento'];
        $cep = $_POST['cep'];
        $rua = $_POST['rua'];
        $numero = $_POST['numero'];
        $bairro = $_POST['bairro'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        
        echo "Pão de alho é a melhor coisa no churrasco";
        //Trabalhe nesse arquivo misael, por favor.
    }

?>

=======
<?php

    try {
        //  RECEBE OS DADOS DO POST REGISTRAR
        if(isset($_POST['registrar']) == "POST"){
            $nome = $_POST['nome'];
            $sobrenome = $_POST['sobrenome'];
            $data_nascimento = $_POST['data_nascimento'];
            $cep = $_POST['cep'];
            $rua = $_POST['rua'];
            $numero = $_POST['numero'];
            $bairro = $_POST['bairro'];
            $cidade = $_POST['cidade'];
            $estado = $_POST['estado'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $cpf = null;
            
            // FAZ A CONEXÃO COM A API PARA ENVIO DOS DADOS
            $url = "";
            $dados = ["firstName" => $nome,
            "lastName" => $sobrenome,
            "birthDate" => $data_nascimento,
            "email" => $email,
            "cpf" => $cpf,
            "password" => $senha];

            $ch = curl_init($url); 

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // faz a resposta vir como string
            curl_setopt($ch, CURLOPT_POST, true); //  define que é post 
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($dados)); // envia os dados (json)
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Content-Type: application/json"
            ]); // tipo do envio

            $response = curl_exec($ch);
            $statusCode = 300;//curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $data = json_decode($response, true); // tranforma json em array
            curl_close($ch);

            if($statusCode >= 200 && $statusCode <= 299)
            {
                
                echo "sucess";
                // mensagem de sucesso
                
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

>>>>>>> Stashed changes

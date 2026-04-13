<?php 

    try {
        session_start();
        if(isset($_POST['enviar']) == "POST")
            {
                $codigo = $_POST['codigo'];
                // FAZ A CONEXÃO COM A API PARA ENVIO DOS DADOS
                $url = "";
                $dados = "";

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

                if($statusCode >= 200 && $statusCode <= 299)
                {
                    
                    
                    
                }
                else
                {
                    
                    $msgErro = "<p style='color:red';> Código incorreto.</p>";
                    
                    
                }
            
            }
    } catch (\Throwable $th) {
        //throw $th;
        echo "erro";
    }
   
    


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2FA</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous">

    <link rel="stylesheet" href="../generico/cssgenerico/style.css">
</head>
<body>
<div id="header"></div>
<div id="main" class="container mt-5">
    <h1 class="mb-4 bold text-center">2FA</h1>
    <p>CONFIRME O CÓDIGO ENVIADO AO SEU ENDEREÇO DE E-MAIL <?php echo $_SESSION['email']; ?></p>
    <form method="POST" >
        <div class="form" method="POST">
            <div class="form-group col-md-20">
                <label for="codigo">Código</label>
                <input type="number" class="form-control" id="codigo" name="codigo" required>
            </div>
        </div>
        <?php if(isset($msgErro)) echo $msgErro; ?>
        <button id="submitbutton1" type="submit" class="btn btn-primary col-md-12" name="enviar">ENVIAR</button>
        
    </form>
</div>
<div id="controller"></div>
<div id="footer"></div>
<script src="../generico/jsgenerico/script.js"></script>
<script src="../generico/jsgenerico/frame.js"></script>
</body>
</html>

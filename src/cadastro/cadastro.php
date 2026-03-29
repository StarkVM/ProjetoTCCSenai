<<<<<<< HEAD
<<<<<<< HEAD
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

>>>>>>> Sal-DS
=======
<?php
session_start();
error_reporting(0); // limpa os erros e avisos do header

// SE OCORRER ALGUM ERROR NO CADASTRO, É GETADO O CODIGO DA URL E É MOSTRADO PARA O CLIENTE
$er = $_GET['er'];
if(isset($er))
{
    if($er == "1") $responseError = "CPF informado já está existente em nosso sistema!";
    else if($er == "2")  $responseError = "Email informado já está existente em nosso sistema! Por favor, digite outro.";
    else $responseError = "Houve um erro ao processar os dados! Por favor, tente novamente.";
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous">

    <link rel="stylesheet" href="../generico/cssgenerico/style.css">
    <link rel="stylesheet" href="cadastro.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
<div id="header"></div>
<div id="cadastroheader" class="container mt-5">
        <div class="cadastro">
        <h1 class="text-center">CADASTRO</h1>
    </div>
</div>
<div id="main" class="container mb-5">
    <form method="POST" action="cadastroB.php" id="cadastro">
    <div class="subtitles mb-0">DADOS PESSOAIS</div>
    <section class="dados_pessoais">
        <p></p>
            <div class="form-row">
            <div class="form-group col-md-6">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>

            <div class="form-group col-md-6">
                <label for="sobrenome">Sobrenome</label>
                <input type="text" class="form-control" id="sobrenome" name="sobrenome" required>
            </div>
            </div>           
        
        <div class="form-group">
            <label for="data_nascimento">Data de nascimento</label>
            <input type="date" lang="pt-BR" class="form-control" id="data_nascimento" name="data_nascimento" required>
            <p id="msgErro" style="color: red"></p>
        </div>
        <div class="form-group">
                <label for="nome">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" required>
            </div>
    </section>
    <div class="subtitles mb-0">ENDEREÇO</div>
    <section class="endereço">
        <p></p>
        <div class="form-group">
            <label for="cep">CEP</label>
            <input type="number" class="form-control" id="cep" name="cep" required>
            <p id="cepErro" style="color: red"></p>
        </div>

        <div class="form-group">
            <label for="rua">Rua</label>
            <input type="text" class="form-control" id="rua" name="rua" readonly>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="numero">Número</label>
                <input type="number" class="form-control" id="numero" name="numero" required>
            </div>

            <div class="form-group col-md-8">
                <label for="bairro">Bairro</label>
                <input type="text" class="form-control" id="bairro" name="bairro" readonly>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="cidade">Cidade</label>
                <input type="text" class="form-control" id="cidade" name="cidade" readonly>
            </div>

            <div class="form-group col-md-6">
                <label for="estado">Estado</label>
                <input type="text" class="form-control" id="estado" name="estado" readonly>
            </div>
        </div>
    </section>
    <div class="subtitles mb-0">ACESSO</div>
    <section class="credenciais_de_acesso">
        <p></p>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
            <div class="invalid-feedback" id="emailerro">
                Por favor, insira um email válido.
            </div>
        </div>

        <div class="form-group">
            <label for="senha">Senha</label>
            <div class="passwordfield">
                <input type="password" class="form-control" id="senha1" name="senha" required>
                <span id="eye" class="bi bi-eye-slash" style="font-size: 25px;" onclick="mostrarSenha('senha1','eye')" style="cursor: pointer; font-size: 12px">  </span>     
            </div>
            <p></p>
            <label for="confirmar-senha">Confirme sua senha</label>
            <div class="passwordfield">
                <input type="password" class="form-control" id="senha2" name="senha" required>
                <span id="eye2" class="bi bi-eye-slash" style="font-size: 25px;" onclick="mostrarSenha('senha2', 'eye2')" style="cursor: pointer; font-size: 12px"></span>   
                <p id="erroSenha" style="color:red;"></p>  
            </div>
        </div>
        <p id="responseErro" style="color:red;"><?php  if(isset($responseError)) echo $responseError;?></p>
        <button id="submitbutton" type="submit" class="btn btn-primary col-md-12" name="registrar">CADASTRAR</button>
    </form>
    <a href="../login/login.html"><button type="button" class="btn-login"
      >Já tem uma conta? Login
      </button></a> 
    </section>
</div>
<div id="footer"></div>

<script src="../generico/jsgenerico/frame.js"></script>

<script>
        // // VERIFICAÇÃO DE DATA DE NASCIMENTO VALIDA
        // document.addEventListener("DOMContentLoaded", function () {
        //     const nascInput = document.querySelector('input[name="data_nascimento"]');

        //     nascInput.addEventListener("input", function () {
        //         let value = this.value.replace(/\D/g, "");
        //         if (value.length > 8) value = value.slice(0, 8);

        //         if (value.length >= 5) {
        //             value = value.replace(/^(\d{2})(\d{2})(\d{0,4})/, "$1/$2/$3");
        //         } else if (value.length >= 3) {
        //             value = value.replace(/^(\d{2})(\d{0,2})/, "$1/$2");
        //         }

        //         this.value = value;

        //         if (value.length === 10) {
        //             const dia = parseInt(value.slice(0, 2), 10);
        //             const mes = parseInt(value.slice(3, 5), 10);
        //             const ano = parseInt(value.slice(6, 10), 10);

        //             const anoAtual = new Date().getFullYear();

        //             const dataValida = dia >= 1 && dia <= 31 && mes >= 1 && mes <= 12 && ano <= anoAtual;

        //             if (!dataValida) {
        //                 document.getElementById("msgErro").innerText = "Data de nascimento inválida!";
        //                 document.getElementById("data_nascimento").value = "";
        //             } else {
        //                 document.getElementById("msgErro").innerText = "";
        //             }
        //         }
        //     });
        // });
        // RESTAURA OS DADOS NOS CAMPOS DE CADASTRO
        const nomeForm = document.getElementById('cadastro');
        const sessoes = <?php echo json_encode($_SESSION); ?>;
        for(let campo of nomeForm.elements)
        {
            if(sessoes[campo.name]) {
                campo.value = sessoes[campo.name];
            }
        }
    </script>
    <script src="../generico/jsgenerico/script.js"></script>
</body>
</html>
>>>>>>> 7c8fbbcda18e2e8d453c2a7a38dea1a78d5b6acf

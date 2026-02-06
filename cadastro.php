<?php

//  RECEBE OS DADOS DO POST REGISTRAR
if(isset($_POST['registrar'])){
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

    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="navbar">
  <nav class="nav-container">

    <div class="logo">TCC Máquinas</div>

    <button class="menu-toggle" id="menuToggle" aria-label="Abrir menu">
      ☰
    </button>

    <ul class="nav-links" id="navLinks">
      <li><a href="#">Home</a></li>
      <li><a href="login.html">Login</a></li>
      <li><a href="cadastro.html">Cadastro</a></li>
      <li><a href="#">Sobre</a></li>
    </ul>

  </nav>
</header>
<div id="main" class="container mt-5 mb-5">
    <h1 class="mb-4 bold text-center">CADASTRO</h1>
    <form method="POST">
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
            <input type="text" class="form-control" id="data_nascimento" name="data_nascimento" required>
            <p id="msgErro" style="color: red"></p>
        </div>

        <div class="form-group">
            <label for="cep">CEP</label>
            <input type="text" class="form-control" id="cep" name="cep" required>
            <p id="cepErro" style="color: red"></p>
        </div>

        <div class="form-group">
            <label for="rua">Rua</label>
            <input type="text" class="form-control" id="rua" name="rua" readonly>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="numero">Número</label>
                <input type="text" class="form-control" id="numero" name="numero" required>
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

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
            <span id="mostrarsenha" onclick="mostrarSenha()" style="cursor: pointer; font-size: 12px">Mostrar</span>
        </div>

        <button id="submitbutton" type="submit" class="btn btn-primary col-md-12" name="registrar">CADASTRAR</button>
    </form>
</div>
  <footer>
    <p>Desenvolvido por SENAI - TCC 2026</p>
  </footer>
<script src="script.js"></script>
<script>
        // VERIFICAÇÃO DE DATA DE NASCIMENTO VALIDA
        document.addEventListener("DOMContentLoaded", function () {
            const nascInput = document.querySelector('input[name="data_nascimento"]');

            nascInput.addEventListener("input", function () {
                let value = this.value.replace(/\D/g, "");
                if (value.length > 8) value = value.slice(0, 8);

                if (value.length >= 5) {
                    value = value.replace(/^(\d{2})(\d{2})(\d{0,4})/, "$1/$2/$3");
                } else if (value.length >= 3) {
                    value = value.replace(/^(\d{2})(\d{0,2})/, "$1/$2");
                }

                this.value = value;

                if (value.length === 10) {
                    const dia = parseInt(value.slice(0, 2), 10);
                    const mes = parseInt(value.slice(3, 5), 10);
                    const ano = parseInt(value.slice(6, 10), 10);

                    const anoAtual = new Date().getFullYear();

                    const dataValida = dia >= 1 && dia <= 31 && mes >= 1 && mes <= 12 && ano <= anoAtual;

                    if (!dataValida) {
                        document.getElementById("msgErro").innerText = "Data de nascimento inválida!";
                        document.getElementById("data_nascimento").value = "";
                    } else {
                        document.getElementById("msgErro").innerText = "";
                    }
                }
            });
        });
    </script>
</body>
</html>

<?php

if(isset($_POST['submit'])){
  $email = $_POST['email'];
  $senha = $_POST['senha'];


}



?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Login - TCC</title>
  <link rel="stylesheet" href="login.css">
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

  <main class="main-content" id="">
    <div class="login-container">
      <h2>Login</h2>

      <form id="loginForm" method="post">
        <label for="email">E-mail</label>
        <input type="email" id="email" placeholder="Digite seu e-mail" name="email" required>

        <label for="senha">Senha</label>
        <input type="password" id="senha" placeholder="Digite sua senha" name="senha" required>

        <button type="submit" name="submit">Entrar</button>
      </form>

      <p id="mensagem"></p>
    </div>
  </main>

  <footer>
    <p>Desenvolvido por SENAI - TCC 2026</p>
  </footer>

  <script src="script.js">
    document.getElementById("loginForm").addEventListener("submit", function(e) {
    e.preventDefault();

    const email = document.getElementById("email").value;
    const senha = document.getElementById("senha").value;
    const mensagem = document.getElementById("mensagem");

    if (email === "" || senha === "") {
        mensagem.textContent = "Preencha todos os campos!";
        return;
    }

    // ligar backend
    if (email === "admin@email.com" && senha === "123456") {
        mensagem.style.color = "green";
        mensagem.textContent = "Login realizado com sucesso!";
    } else {
        mensagem.style.color = "red";
        mensagem.textContent = "E-mail ou senha invÃ¡lidos!";
    }
    });
  </script>
</body>
</html>
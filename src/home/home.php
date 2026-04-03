<?php

require "verification.php";

session_start();

// verifica sessão primeiro
if (isset($_SESSION['ultima_url'], $_SESSION['tempo_saida'])) {

    if (time() - $_SESSION['tempo_saida'] > 5 && time() - $_SESSION['tempo_saida'] <= 900) { // 15 min

        $url = $_SESSION['ultima_url'];

        // verifica a url
        if (preg_match('/^[a-zA-Z0-9_\-\/\.]+$/', $url)) {
            header("Location: $url");
            exit;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Home - TCC Máquinas</title>
  <link rel="stylesheet" href="home.css">
  <link rel="stylesheet" href="../generico/cssgenerico/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="home-page">

<div id="header"></div>

<main class="container">


<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
  
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2"></button>
  </div>

  <div class="carousel-inner rounded shadow">

    <div class="carousel-item active">
      <img src="../img/banner1.jpg" class="d-block w-100" style="height: 400px; object-fit: cover;">
      <div class="carousel-caption d-none d-md-block">
      </div>
    </div>

    <div class="carousel-item">
      <img src="../img/banner2.jpg" class="d-block w-100" style="height: 400px; object-fit: cover;">
      <div class="carousel-caption d-none d-md-block">
      </div>
    </div>

    <div class="carousel-item">
      <img src="../img/banner3.jpg" class="d-block w-100" style="height: 400px; object-fit: cover;">
      <div class="carousel-caption d-none d-md-block">
      </div>
    </div>

  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>

  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>

</div>

  <section class="products">
    <h2>Anúncios recentes</h2>
    <div class="product-grid" id="productGrid"></div>
  </section>

</main>

<div id="controller"></div>
<div id="footer"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="home.js"></script>
<script src="../generico/jsgenerico/frame.js?v=3"></script>

</body>

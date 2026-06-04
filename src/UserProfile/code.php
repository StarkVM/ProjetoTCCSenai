<?php
// STATUS 3 É SUPER AUTENTICADO
// TYPE 0 USUARIO COMUM E 1 VENDEDOR

error_reporting(0);
//require("../auth/auth.php");

$semDados = "Dados não carregados!";

require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTCCSenai/src/config/session.php';

$dataFormatada = new DateTime($_SESSION['birthDate']);

$type = $_SESSION['type'] == 0 ? "Cliente" : "Locador";
$status = $_SESSION["status"] == 3 ? '<span class="text-on-surface font-black text-xs uppercase" >Super Verificado & ' . $type . '</span>' : '<span class="text-on-surface font-black text-xs uppercase" style="color: red">Pendente de Verificação & ' . $type . '</span>';


?>

<!DOCTYPE html>

<html lang="pt-BR">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link
    href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;900&amp;family=Inter:wght@300;400;500;600;700&amp;display=swap"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
    rel="stylesheet" />
  <script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          "colors": {
            "tertiary-container": "#2ac6ff",
            "surface-dim": "#dcd9d9",
            "outline-variant": "#d7c3ae",
            "on-tertiary-fixed": "#001e2b",
            "on-surface": "#1c1b1b",
            "tertiary-fixed": "#c0e8ff",
            "primary-fixed": "#ffddb5",
            "error": "#ba1a1a",
            "surface-bright": "#fcf9f8",
            "primary": "#835400",
            "surface": "#fcf9f8",
            "inverse-primary": "#ffb957",
            "surface-container-highest": "#e5e2e1",
            "on-surface-variant": "#524434",
            "surface-variant": "#e5e2e1",
            "on-secondary-container": "#5a666d",
            "primary-container": "#f9a825",
            "inverse-surface": "#313030",
            "on-primary-fixed": "#2a1800",
            "on-secondary": "#ffffff",
            "on-primary-container": "#674100",
            "on-tertiary-container": "#004f69",
            "on-error": "#ffffff",
            "secondary-container": "#d7e4ec",
            "secondary-fixed": "#d7e4ec",
            "background": "#fcf9f8",
            "primary-fixed-dim": "#ffb957",
            "surface-tint": "#835400",
            "on-error-container": "#93000a",
            "tertiary-fixed-dim": "#71d2ff",
            "secondary-fixed-dim": "#bbc8d0",
            "outline": "#857462",
            "on-secondary-fixed": "#111d23",
            "tertiary": "#006687",
            "surface-container-high": "#ebe7e7",
            "on-tertiary": "#ffffff",
            "on-background": "#1c1b1b",
            "error-container": "#ffdad6",
            "inverse-on-surface": "#f3f0ef",
            "surface-container": "#f0edec",
            "surface-container-low": "#f6f3f2",
            "secondary": "#546067",
            "on-tertiary-fixed-variant": "#004d66",
            "on-secondary-fixed-variant": "#3c494f",
            "on-primary-fixed-variant": "#643f00",
            "on-primary": "#ffffff",
            "surface-container-lowest": "#ffffff"
          },
          "borderRadius": {
            "DEFAULT": "0.125rem",
            "lg": "0.25rem",
            "xl": "0.5rem",
            "full": "0.75rem"
          },
          "fontFamily": {
            "headline": ["Space Grotesk"],
            "display": ["Space Grotesk"],
            "body": ["Inter"],
            "label": ["Inter"]
          }
        },
      },
    }
  </script>
  <style>
    .material-symbols-outlined {
      font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
      vertical-align: middle;
    }

    body {
      font-family: 'Inter', sans-serif;
    }

    h1,
    h2,
    h3,
    .font-display {
      font-family: 'Space Grotesk', sans-serif;
    }
  </style>
</head>

<body class="bg-background text-on-surface font-body selection:bg-primary-container">
  <!-- TopAppBar -->
  <header id="header"></header>
  <main class=" min-h-screen flex">
    <aside
      class="w-16 md:w-64 border-r border-outline-variant/20 bg-surface-container flex flex-col py-4 sticky top-16 h-[calc(100vh-4rem)] transition-all duration-300">

      <div class="px-4 md:px-6 pb-6 border-b border-outline-variant/20 mb-4 hidden md:block">
        <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-stone-400">
          Conta
        </p>

        <h3 class="font-headline font-black text-lg mt-2 leading-tight">
          <?php echo $_SESSION["firstName"] . " " . $_SESSION["lastName"]; ?>
        </h3>

        <p class="text-xs text-stone-500 mt-1">
          Membro desde Out 2022
        </p>
      </div>

      <nav class="flex flex-col w-full gap-1">

        <button
          class="tab-btn active p-4 w-full flex items-center justify-center md:justify-start gap-4 opacity-60 hover:opacity-100 transition-all group"
          id="btn-profile" onclick="switchTab('profile')">

          <span class="material-symbols-outlined">person</span>

          <span class="hidden md:block font-headline font-bold uppercase text-xs tracking-wider">
            Perfil
          </span>
        </button>

        <button
          class="tab-btn p-4 w-full flex items-center justify-center md:justify-start gap-4 opacity-60 hover:opacity-100 transition-all group"
          id="btn-security" onclick="switchTab('security')">

          <span class="material-symbols-outlined">shield_lock</span>

          <span class="hidden md:block font-headline font-bold uppercase text-xs tracking-wider">
            Segurança
          </span>
        </button>

        <button
          class="tab-btn p-4 w-full flex items-center justify-center md:justify-start gap-4 opacity-60 hover:opacity-100 transition-all group"
          id="btn-documents" onclick="switchTab('documents')">

          <span class="material-symbols-outlined">badge</span>

          <span class="hidden md:block font-headline font-bold uppercase text-xs tracking-wider">
            Documentos
          </span>
        </button>

        <button
          class="tab-btn p-4 w-full flex items-center justify-center md:justify-start gap-4 opacity-60 hover:opacity-100 transition-all group"
          id="btn-rentals" onclick="switchTab('rentals')">

          <span class="material-symbols-outlined">request_quote</span>

          <span class="hidden md:block font-headline font-bold uppercase text-xs tracking-wider">
            Locações
          </span>
        </button>

        <button
          class="tab-btn p-4 w-full flex items-center justify-center md:justify-start gap-4 opacity-60 hover:opacity-100 transition-all group"
          id="btn-support" onclick="switchTab('support')">

          <span class="material-symbols-outlined">support_agent</span>

          <span class="hidden md:block font-headline font-bold uppercase text-xs tracking-wider">
            Suporte
          </span>
        </button>

      </nav>

      <div class="mt-auto pt-4 border-t border-outline-variant/20">

        <a href="../auth/logout.php"
          class="p-4 w-full flex items-center justify-center md:justify-start gap-4 text-error opacity-70 hover:opacity-100 transition-all">

          <span class="material-symbols-outlined">
            logout
          </span>

          <span class="hidden md:block font-headline font-bold uppercase text-xs tracking-wider">
            Sair
          </span>
        </a>

        <a href="../auth/logout-all-sessions.php"
          class="p-4 w-full flex items-center justify-center md:justify-start gap-4 text-error opacity-70 hover:opacity-100 transition-all">

          <span class="material-symbols-outlined">
            logout
          </span>

          <span class="hidden md:block font-headline font-bold uppercase text-xs tracking-wider">
            Todas Sessões
          </span>
        </a>

      </div>

    </aside>
    <div class="p-8 lg:p-12 max-w-4xl mx-auto space-y-10">
      <!-- Page Header -->
      <header>
        <h1 class="text-5xl md:text-7xl font-black tracking-tighter text-on-surface leading-none uppercase mb-2">
          Meu <span class="text-primary italic">Perfil</span>
        </h1>
        <p class="text-lg text-stone-500 font-light">Gerencie suas informações de acesso e dados cadastrais.</p>
      </header>
      <!-- Tab System -->
      <div class="border-b border-stone-200">
        <nav class="flex gap-8">
          <button
            class="border-b-4 border-primary pb-4 px-1 text-sm font-black uppercase tracking-tighter text-on-surface">Dados
            Pessoais</button>
        </nav>
      </div>
      <!-- Profile Detail View (Dados Pessoais) -->
      <section class="bg-surface-container-lowest rounded-md shadow-sm overflow-hidden">
        <!-- Profile Header -->
        <div
          class="p-8 md:p-10 bg-surface-container-low border-b border-stone-100 flex flex-col md:flex-row items-center gap-8">
          <div class="relative group">
            <div class="h-32 w-32 rounded-full overflow-hidden border-4 border-white shadow-xl">
              <img alt="Ricardo Mendes Profile" class="w-full h-full object-cover"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuBzUDQZl-HKLn1hbcibYx6YX5VTq7eAMYn1QPM01CHamypkVTJOl1k5xkmZRrCKE-ImYbQZtSuZH3P6pUs7BEJHyMRe4bsZl0_qURze9GcGIKaRSSPfIf5zXzOCA8DhWsYs8xPVpIiNgE5LUSzcubC5-IkZqoDQCJZRMQADhQ4LpjwSTl3ZBTeYidDzGISOrBCMdLjg9iFRCe5G5IWGasKNnq3PYVEoBbLPXg0QibzdcOkLRb6MvF_nRLGZOixdrrCjf9-I0Fzb2N8E" />
            </div>
          </div>
          <div class="text-center md:text-left">
            <h2 class="text-3xl font-black uppercase tracking-tighter">
              <?php if (isset($_SESSION["firstName"]) && isset($_SESSION["lastName"]))
                echo $_SESSION["firstName"] . " " . $_SESSION["lastName"] ?? $semDados ?>
              </h2>
              <p class="text-primary font-bold uppercase text-sm tracking-widest mt-1">Gestor de Canteiro / Alpha-7</p>
              <p class="text-stone-400 text-xs mt-2 uppercase font-semibold">Membro desde Outubro 2022</p>
            </div>

          </div>
          <!-- Info Grid -->
          <div class="p-8 md:p-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
              <div>
                <label class="text-[10px] font-black uppercase text-stone-400 tracking-widest block mb-1">Email
                  Corporativo</label>
                <div class="flex items-center gap-3">
                  <span class="material-symbols-outlined text-stone-300">mail</span>
                  <span class="text-on-surface font-semibold"><?php if (isset($_SESSION["email"]))
                echo $_SESSION["email"] ?? $semDados ?></span>
                </div>
              </div>
              <div>
                <label class="text-[10px] font-black uppercase text-stone-400 tracking-widest block mb-1">Localização
                  Principal</label>
                <div class="flex items-center gap-3">
                  <span class="material-symbols-outlined text-stone-300">location_on</span>
                  <span class="text-on-surface font-semibold"><?php if (isset($_SESSION["address"]["city"]) && isset($_SESSION["address"]["state"]))
                echo $_SESSION["address"]["city"] . ", " . $_SESSION["address"]["state"] ?? $semDados ?></span>
                </div>
              </div>
              <div>
                <label class="text-[10px] font-black uppercase text-stone-400 tracking-widest block mb-1">Data de
                  Nascimento</label>
                <div class="flex items-center gap-3">
                  <span class="material-symbols-outlined text-stone-300">calendar_today</span>
                  <span class="text-on-surface font-semibold"><?php if (isset($_SESSION["birthDate"]))
                echo $dataFormatada->format("d/m/Y") ?? $semDados ?></span>
                </div>
              </div>
              <div>
                <label class="text-[10px] font-black uppercase text-stone-400 tracking-widest block mb-1">Status da
                  Conta</label>
                <div class="flex items-center gap-2">
                  <span class="h-2 w-2 rounded-full bg-green-500"></span>
                <?php if (isset($status))
                echo $status ?? $semDados ?>
                </div>
              </div>
            </div>
            <div class="mt-12 pt-8 border-t border-stone-100">
              <h4 class="text-xs font-black uppercase tracking-widest text-stone-400 mb-6">Ações da Conta</h4>
              <div class="flex flex-col sm:flex-row gap-4">
                <button
                  class="inline-flex items-center justify-center border-2 border-red-500 text-red-500 px-4 py-2 rounded-md font-bold text-xs uppercase hover:bg-red-50 transition-colors"
                  onclick="window.location.href='../auth/logout.php'">Desativar Conta</button>
              <?php if (isset($_SESSION["type"]) && $_SESSION["type"] == 0)
                echo '<a href="../VendedorHome/code.php" class="inline-flex items-center justify-center border-2 border-[#2ac6ff] text-[#2ac6ff] px-4 py-2 rounded-md font-bold text-xs uppercase hover:bg-[#c0e8ff] transition-colors">Virar vendedor</a>' ?>
              </div>
            </div>
          </div>
        </section>
      </div>

    </main>
    <footer id="footer"></footer>
    <!-- Mobile Bottom Nav -->
    <nav
      class="md:hidden fixed bottom-0 left-0 right-0 bg-surface-container-lowest border-t border-stone-100 flex justify-around items-center py-4 px-6 z-50">
      <a class="text-stone-400 flex flex-col items-center" href="../home/code.php">
        <span class="material-symbols-outlined">dashboard</span>
        <span class="text-[10px] font-bold mt-1 uppercase">Início</span>
      </a>
      <a class="text-stone-400 flex flex-col items-center" href="../VendedorHome/code.php">
        <span class="material-symbols-outlined">calendar_month</span>
        <span class="text-[10px] font-bold mt-1 uppercase">Locações</span>
      </a>
      <a class="text-primary flex flex-col items-center" href="#">
        <span class="material-symbols-outlined">person</span>
        <span class="text-[10px] font-bold mt-1 uppercase">Perfil</span>
      </a>

    </nav>
    <footer id="footer"></footer>
      <script>
    function switchTab(tabId) {
      // Hide all contents
      document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.remove('active');
      });
      
      // Remove active state from all buttons
      document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
        btn.classList.add('opacity-60');
      });
      
      // Show selected content
      document.getElementById(tabId).classList.add('active');
      
      // Activate clicked button
      const activeBtn = document.querySelector(`[onclick="switchTab('${tabId}')"]`);
      if (activeBtn) {
        activeBtn.classList.add('active');
        activeBtn.classList.remove('opacity-60');
      }
    }
  </script>
    <script src="../generico/jsgenerico/frame.js"></script>
  </body>

  </html>
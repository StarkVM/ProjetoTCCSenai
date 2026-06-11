<?php
error_reporting(0);
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTCCSenai/src/config/session.php';
if(isset($_SESSION["logado"]) && $_SESSION["logado"] == true){
    header("Location: /ProjetoTCCSenai/src/home/code.php");
    exit();
}
 // limpa os erros e avisos do header

// SE OCORRER ALGUM ERROR NO CADASTRO, É GETADO O CODIGO DA URL E É MOSTRADO PARA O CLIENTE
$er = $_GET['er'];
if (isset($er) && !empty($er)) {
    switch ($er) {
        case "Email and Cpf conflict.":
            $responseError = "Email e Cpf já estão cadastrados.";
            break;
        case "Email or Cpf conflict.":
            $responseError = "Email ou Cpf já estão cadastrados.";
            break;
        case "Registration in progress.":
            $responseError = "Registro em progresso com este Email ou Cpf.";
            break;
        case "Database save failed.":
            $responseError = "Ocorreu um erro ao processar os dados, por favor, tente novamente.";
            break;
        case "Send verification code failed.":
            $responseError = "Falha ao enviar o código de verificação para o email!";
            break;
        case "User cpf validation failed.":
            $responseError = "Falha ao validar o CPF, verifique as informações fornecidas e tente novamente.";
            break;
        case "0":
            $responseError = "Ocorreu um erro inesperado, por favor, tente novamente.";
            break;
        case "3":
            $responseError = "A senha informada precisa ter entre 8 e 50 caracteres.";
            break;
        default:
            $responseError = "Ocorreu um erro ao processar a requisição, por favor, tente novamente.";
            break;
    }
}



?>

<!DOCTYPE html>

<html class="light" lang="pt-BR">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;900&amp;family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
  <script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          "colors": {
            "background": "#fcf9f8",
            "surface": "#fcf9f8",
            "on-background": "#1c1b1b",
            "on-error": "#ffffff",
            "outline-variant": "#d7c3ae",
            "on-secondary": "#ffffff",
            "primary-fixed": "#ffddb5",
            "surface-container-high": "#ebe7e7",
            "outline": "#857462",
            "on-primary": "#ffffff",
            "tertiary-container": "#2ac6ff",
            "primary": "#835400",
            "secondary-container": "#d7e4ec",
            "tertiary-fixed": "#c0e8ff",
            "on-secondary-fixed-variant": "#3c494f",
            "primary-fixed-dim": "#ffb957",
            "surface-dim": "#dcd9d9",
            "surface-variant": "#e5e2e1",
            "tertiary-fixed-dim": "#71d2ff",
            "on-secondary-container": "#5a666d",
            "on-secondary-fixed": "#111d23",
            "inverse-on-surface": "#f3f0ef",
            "on-surface-variant": "#524434",
            "error": "#ba1a1a",
            "secondary": "#546067",
            "surface-container": "#f0edec",
            "secondary-fixed-dim": "#bbc8d0",
            "on-tertiary-fixed": "#001e2b",
            "surface-container-lowest": "#ffffff",
            "on-primary-fixed-variant": "#643f00",
            "on-primary-fixed": "#2a1800",
            "inverse-surface": "#313030",
            "surface-bright": "#fcf9f8",
            "on-tertiary-fixed-variant": "#004d66",
            "primary-container": "#f9a825",
            "on-error-container": "#93000a",
            "surface-tint": "#835400",
            "on-tertiary-container": "#004f69",
            "surface-container-highest": "#e5e2e1",
            "tertiary": "#006687",
            "inverse-primary": "#ffb957",
            "surface-container-low": "#f6f3f2",
            "on-tertiary": "#ffffff",
            "error-container": "#ffdad6",
            "on-surface": "#1c1b1b",
            "secondary-fixed": "#d7e4ec",
            "on-primary-container": "#674100"
          },
          "borderRadius": {
            "DEFAULT": "0.125rem",
            "lg": "0.25rem",
            "xl": "0.5rem",
            "full": "0.75rem"
          },
          "fontFamily": {
            "headline": ["Space Grotesk"],
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
    }

    .signature-gradient {
      background: linear-gradient(135deg,  #f9a825 100%);
    }

    .glass-panel {
      background: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(20px);
    }
  </style>
</head>
<header id="header"></header>

<body class="bg-surface font-body text-on-surface selection:bg-primary-fixed selection:text-on-primary-fixed">
  <div class="min-h-screen flex flex-col md:flex-row">
    <!-- Left Column: Branding and Imagery (Asymmetric Layout) -->
    <div class="relative w-full md:w-1/2 lg:w-[60%] h-64 md:h-auto overflow-hidden bg-on-background">
      <div class="absolute inset-0 z-0">
        <img alt="Escavadeira industrial pesada" class="w-full h-full object-cover opacity-60 grayscale hover:grayscale-0 transition-all duration-700" data-alt="Cena cinematográfica de uma enorme escavadeira amarela em um canteiro de obras durante a hora azul, com detalhes mecânicos nítidos e névoa atmosférica industrial" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB-6ev4WxiieivgIb66SpWY2arkN2yITvwjeuHuUSuk5VAxB3tno5_EoJIpRYVY62MXErOdcUf5gJlblc0WMV5Mn5tSkJ6dJihHUfjD8MLbYYMb-cBWz5YvTvOyZqP7UMJDC17qOgAQgKKmCIfPlmHKGck9WbsgeZ7GcPmoODX76RJUNnFMJwt6Ml6k-_SldReVycHGjVsN0hWoQCKbEfOgA83ZKWHlac_iucCSpIjtdwFdJQbfGgYv6qvWSrdTTYK1Zmj932-NbVYO" />
      </div>
      <div class="absolute inset-0 bg-gradient-to-t from-on-background via-transparent to-transparent opacity-80"></div>
      <div class="relative z-10 h-full flex flex-col justify-between p-20 md:p-20">
        <div class="max-w-xl">
          <h1 class="font-headline text-5xl md:text-7xl font-bold text-surface tracking-tighter leading-none mb-6">
            CONSTRUA O <span class="text-primary-container">FUTURO</span> COM A GENTE.
          </h1>
        </div>
      </div>
    </div>
    <!-- Right Column: Registration Form -->
    <div class="w-full md:w-1/2 lg:w-[40%] flex items-center justify-center p-6 md:p-12 lg:p-20 bg-surface">
      <div class="w-full max-w-lg">
        <div class="mb-10">
          <h2 class="font-headline text-3xl font-bold tracking-tight text-on-surface mb-2">CRIAR CONTA</h2>
          <div class="h-1 w-19 bg-primary"></div>
        </div>
        <form method="POST" class="space-y-10 max-w-2xl mx-auto" action="cadastroB.php">

          <!-- DADOS PESSOAIS -->
          <div class="space-y-5">
            <h3 class="text-2xl font-gray text-[#1E1E1E] border-l-4 border-[#C58B18] pl-4 uppercase tracking-wide">
              Dados Pessoais
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

              <input type="text" name="nome" placeholder="Nome" required
                class="w-full bg-[#FFFFFF] border border-[#D6D1C7] rounded-xl px-5 py-4 text-[#1E1E1E] placeholder:text-[#7B7B7B] shadow-sm outline-none transition duration-300 focus:border-[#C58B18] focus:ring-4 focus:ring-[#C58B18]/20 hover:border-[#B8B0A3]">

              <input type="text" name="sobrenome" placeholder="Sobrenome" required
                class="w-full bg-[#FFFFFF] border border-[#D6D1C7] rounded-xl px-5 py-4 text-[#1E1E1E] placeholder:text-[#7B7B7B] shadow-sm outline-none transition duration-300 focus:border-[#C58B18] focus:ring-4 focus:ring-[#C58B18]/20 hover:border-[#B8B0A3]">

            </div>

            <input type="date" name="data_nascimento" required
              class="w-full bg-[#FFFFFF] border border-[#D6D1C7] rounded-xl px-5 py-4 text-[#1E1E1E] shadow-sm outline-none transition duration-300 focus:border-[#C58B18] focus:ring-4 focus:ring-[#C58B18]/20 hover:border-[#B8B0A3]">

            <input id="cpf" maxlength="14" type="text" name="cpf" placeholder="Documento" required
              class="w-full bg-[#FFFFFF] border border-[#D6D1C7] rounded-xl px-5 py-4 text-[#1E1E1E] placeholder:text-[#7B7B7B] shadow-sm outline-none transition duration-300 focus:border-[#C58B18] focus:ring-4 focus:ring-[#C58B18]/20 hover:border-[#B8B0A3]">

            <input type="email" name="email" placeholder="Email" required
              class="w-full bg-[#FFFFFF] border border-[#D6D1C7] rounded-xl px-5 py-4 text-[#1E1E1E] placeholder:text-[#7B7B7B] shadow-sm outline-none transition duration-300 focus:border-[#C58B18] focus:ring-4 focus:ring-[#C58B18]/20 hover:border-[#B8B0A3]">
          </div>

          <!-- SEGURANÇA -->
          <div class="space-y-5">

            <h3 class="text-2xl font-gray text-[#1E1E1E] border-l-4 border-[#C58B18] pl-4 uppercase tracking-wide">
              Segurança
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

              <div class="relative">
                <input id="senha1" type="password" name="senha" placeholder="Senha" required
                  class="w-full bg-[#FFFFFF] border border-[#D6D1C7] rounded-xl px-5 py-4 pr-14 text-[#1E1E1E] placeholder:text-[#7B7B7B] shadow-sm outline-none transition duration-300 focus:border-[#C58B18] focus:ring-4 focus:ring-[#C58B18]/20 hover:border-[#B8B0A3]">

                <span onclick="toggleSenha('senha1', this)"
                  class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 cursor-pointer text-[#8A8A8A] hover:text-[#C58B18] transition">
                  visibility
                </span>
              </div>

              <div class="relative">
                <input id="senha2" type="password" name="confirmar_senha" placeholder="Confirmar senha" required
                  class="w-full bg-[#FFFFFF] border border-[#D6D1C7] rounded-xl px-5 py-4 pr-14 text-[#1E1E1E] placeholder:text-[#7B7B7B] shadow-sm outline-none transition duration-300 focus:border-[#C58B18] focus:ring-4 focus:ring-[#C58B18]/20 hover:border-[#B8B0A3]">

                <span onclick="toggleSenha('senha2', this)"
                  class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 cursor-pointer text-[#8A8A8A] hover:text-[#C58B18] transition">
                  visibility
                </span>
              </div>

            </div>

            <p id="erroSenha" class="text-sm text-red-500 font-medium"></p>

          </div>

          <!-- ENDEREÇO -->
          <div class="space-y-5">

            <h3 class="text-2xl font-gray text-[#1E1E1E] border-l-4 border-[#C58B18] pl-4 uppercase tracking-wide">
              Endereço
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

              <input type="text" id="cep" name="cep" placeholder="CEP" required
                class="w-full bg-[#FFFFFF] border border-[#D6D1C7] rounded-xl px-5 py-4 text-[#1E1E1E] placeholder:text-[#7B7B7B] shadow-sm outline-none transition duration-300 focus:border-[#C58B18] focus:ring-4 focus:ring-[#C58B18]/20 hover:border-[#B8B0A3]">

              <input type="text" name="numero" placeholder="Número" required
                class="w-full bg-[#FFFFFF] border border-[#D6D1C7] rounded-xl px-5 py-4 text-[#1E1E1E] placeholder:text-[#7B7B7B] shadow-sm outline-none transition duration-300 focus:border-[#C58B18] focus:ring-4 focus:ring-[#C58B18]/20 hover:border-[#B8B0A3]">

            </div>

            <fieldset class="space-y-5">

              <input id="rua" type="text" name="rua" placeholder="Rua" required readonly
                class="w-full bg-[#F5F3EE] border border-[#DDD7CB] rounded-xl px-5 py-4 text-[#5C5C5C] placeholder:text-[#9A9A9A] outline-none">

              <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <input id="bairro" type="text" name="bairro" placeholder="Bairro" required readonly
                  class="w-full bg-[#F5F3EE] border border-[#DDD7CB] rounded-xl px-5 py-4 text-[#5C5C5C] placeholder:text-[#9A9A9A] outline-none">

                <input id="cidade" type="text" name="cidade" placeholder="Cidade" required readonly
                  class="w-full bg-[#F5F3EE] border border-[#DDD7CB] rounded-xl px-5 py-4 text-[#5C5C5C] placeholder:text-[#9A9A9A] outline-none">

              </div>

              <input id="estado" type="text" name="estado" placeholder="Estado" required readonly
                class="w-full bg-[#F5F3EE] border border-[#DDD7CB] rounded-xl px-5 py-4 text-[#5C5C5C] placeholder:text-[#9A9A9A] outline-none">

            </fieldset>
          </div>

          <!-- TERMOS -->
          <div class="flex items-start gap-3 bg-[#F8F6F2] border border-[#DDD7CB] rounded-xl p-5">

            <input type="checkbox" id="termbox" required
              class="mt-1 w-5 h-5 accent-[#C58B18] cursor-pointer">

            <label for="termbox" class="text-sm text-[#555555] leading-relaxed">
              Eu li e concordo com os
              <button
                  onclick="openTermsModal()"
                  class="text-[#C58B18] font-semibold hover:underlin">
                  Termos de Uso
              </button>
              e
              <a href="#" class="text-[#C58B18] font-semibold hover:underline">
                Política de Privacidade
              </a>.
            </label>

          </div>

          <!-- ERRO -->
        <?php if (isset($responseError)): ?>
        <div id="responseErro" class="flex items-center justify-center gap-2 bg-red-50 border border-red-200 text-red-700 text-xs font-bold uppercase tracking-wide px-4 py-3 rounded-sm">
          <span class="material-symbols-outlined text-sm">error</span>
          <?= $responseError ?>
        </div>
        <?php endif; ?>

          <!-- BOTÃO -->
          <div class="pt-4">

            <button id="submitbutton" type="submit" name="registrar"
              class="w-full signature-gradient hover:bg-[#B27B10] text-white py-4 rounded-xl font-black tracking-[0.18em] shadow-lg hover:shadow-xl transition duration-300 hover:-translate-y-1">
              FINALIZAR CADASTRO
            </button>

          </div>

        </form>
        <div class="mt-8 text-center">
          <p class="font-body text-xs text-on-surface-variant uppercase tracking-widest">
            Já possui uma conta? <a class="text-primary font-bold hover:underline" href="../login/code.php">Acesso de Login</a>
          </p>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer Segment (Floating Style) -->
  <footer id="footer"></footer>
  <script src="../generico/jsgenerico/script.js"></script>
  <script src="../generico/jsgenerico/frame.js?v=vendor-modal-4"></script>
  <script>
    //MASCARA DE CPF
    cpfField.addEventListener("input", (e) => {
      let value = e.target.value;

      // remove tudo que não é número
      value = value.replace(/\D/g, "");

      // aplica a máscara
      value = value.replace(/(\d{3})(\d)/, "$1.$2");
      value = value.replace(/(\d{3})(\d)/, "$1.$2");
      value = value.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

      e.target.value = value;
    });

    // MASCARA DE CEP
    cepField.addEventListener("input", (e) => {
      let value = e.target.value;

      value = value.replace(/\D/g, "");

      // limita a 8 dígitos
      value = value.substring(0, 8);

      // aplica máscara
      value = value.replace(/(\d{5})(\d)/, "$1-$2");

      e.target.value = value;
    });

    //REMOVER ESPAÇOS DA SENHA
    senha1.addEventListener("keydown", (e) => {
      if (e.key === " ") {
        e.preventDefault();
      }
    });

    senha1.addEventListener("input", (e) => {
      e.target.value = e.target.value.replace(/\s/g, "");
    });

    //MODAL TERMOS DE USO
    function openTermsModal() {
        const modal = document.getElementById("termsModal");

        modal.classList.remove("hidden");
        modal.classList.add("flex");
    }

    function closeTermsModal() {
        const modal = document.getElementById("termsModal");

        modal.classList.add("hidden");
        modal.classList.remove("flex");
    }

  </script>
  <div
    id="termsModal"
    class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">

    <div class="bg-white max-w-2xl w-[90%] rounded-lg shadow-xl">

        <div class="flex justify-between items-center p-6 border-b">
            <h2 class="font-bold text-xl">Termos de Uso</h2>

            <button
                onclick="closeTermsModal()"
                class="text-gray-500 hover:text-black text-2xl">
                &times;
            </button>
        </div>

            <iframe
            src="termos.html"
            class="w-full h-[70vh] border-0">
            </iframe>

        <div class="p-6 border-t flex justify-end">
            <button
                onclick="closeTermsModal()"
                class="bg-primary text-white px-4 py-2 rounded hover:opacity-90">
                Fechar
            </button>
        </div>

    </div>
</div>
</body>

</html>

<?php

session_start();
error_reporting(0); // limpa os erros e avisos do header

// SE OCORRER ALGUM ERROR NO CADASTRO, É GETADO O CODIGO DA URL E É MOSTRADO PARA O CLIENTE
$er = $_GET['er'];
if(isset($er))
{
    if($er == "1") $responseError = "CPF informado já está existente em nosso sistema!";
    else if($er == "2")  $responseError = "Email informado já está existente em nosso sistema! Por favor, digite outro.";
    else if($er == "3")  $responseError = "Senha informada contém menos de 8 caracteres!";
    else $responseError = "Houve um erro ao processar os dados! Por favor, tente novamente.";
}



?>

<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;900&amp;family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
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
            background: linear-gradient(135deg, #835400 0%, #f9a825 100%);
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface selection:bg-primary-fixed selection:text-on-primary-fixed">
<div class="min-h-screen flex flex-col md:flex-row">
<!-- Left Column: Branding and Imagery (Asymmetric Layout) -->
<div class="relative w-full md:w-1/2 lg:w-[60%] h-64 md:h-auto overflow-hidden bg-on-background">
<div class="absolute inset-0 z-0">
<img alt="Heavy industrial excavator" class="w-full h-full object-cover opacity-60 grayscale hover:grayscale-0 transition-all duration-700" data-alt="Cinematic shot of a massive yellow excavator on a construction site during blue hour with sharp mechanical details and industrial atmospheric haze" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB-6ev4WxiieivgIb66SpWY2arkN2yITvwjeuHuUSuk5VAxB3tno5_EoJIpRYVY62MXErOdcUf5gJlblc0WMV5Mn5tSkJ6dJihHUfjD8MLbYYMb-cBWz5YvTvOyZqP7UMJDC17qOgAQgKKmCIfPlmHKGck9WbsgeZ7GcPmoODX76RJUNnFMJwt6Ml6k-_SldReVycHGjVsN0hWoQCKbEfOgA83ZKWHlac_iucCSpIjtdwFdJQbfGgYv6qvWSrdTTYK1Zmj932-NbVYO"/>
</div>
<div class="absolute inset-0 bg-gradient-to-t from-on-background via-transparent to-transparent opacity-80"></div>
<div class="relative z-10 h-full flex flex-col justify-between p-8 md:p-16">
<div class="flex items-center gap-2">
<span class="font-headline text-3xl font-black tracking-tighter text-surface uppercase">TITAN RENTALS</span>
</div>
<div class="max-w-xl">
<h1 class="font-headline text-5xl md:text-7xl font-bold text-surface tracking-tighter leading-none mb-6">
                        BUILD THE <span class="text-primary-container">FUTURE</span> WITH US.
                    </h1>
<p class="font-label text-surface/70 uppercase tracking-widest text-sm max-w-md">
                        Join the global network of precision engineering and industrial logistics. Secure your access to the world's most powerful fleet.
                    </p>
</div>
</div>
</div>
<!-- Right Column: Registration Form -->
<div class="w-full md:w-1/2 lg:w-[40%] flex items-center justify-center p-6 md:p-12 lg:p-20 bg-surface">
<div class="w-full max-w-md">
<div class="mb-10">
<h2 class="font-headline text-3xl font-bold tracking-tight text-on-surface mb-2">CREATE ACCOUNT</h2>
<div class="h-1 w-12 bg-primary"></div>
</div>
<form method="POST" class="space-y-10 max-w-2xl mx-auto" action="cadastroB.php">

<!-- DADOS PESSOAIS -->
<div class="space-y-4">
  <h3 class="text-lg font-bold text-on-surface">Dados Pessoais</h3>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <input type="text" name="nome" placeholder="Nome" required class="input w-full">
    <input type="text" name="sobrenome" placeholder="Sobrenome" required class="input w-full">
  </div>

  <input type="date" name="data_nascimento" required class="input w-full">

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <input id="cpf" maxlength="14" type="text" name="cpf" placeholder="CPF" required class="input w-full">
    <input id="telefone" type="tel" name="telefone" placeholder="Telefone" required class="input w-full">
  </div>

  <input type="email" name="email" placeholder="Email" required class="input w-full">
</div>

<!-- SEGURANÇA -->
<div class="space-y-4">
  <h3 class="text-lg font-bold text-on-surface">Segurança</h3>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

    <div class="relative">
      <input id="senha1" type="password" name="senha" placeholder="Senha" required class="input w-full pr-10">
    <span onclick="toggleSenha('senha1', this)" 
    class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-on-surface-variant">
    visibility
    </span>
      </span>
    </div>
    <p id="erroSenha"></p>

    <div class="relative">
      <input id="senha2" type="password" name="confirmar_senha" placeholder="Confirmar senha" required class="input w-full pr-10">
    <span onclick="toggleSenha('senha2', this)" 
    class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer text-on-surface-variant">
    visibility
    </span>
    </div>

  </div>
</div>

<!-- ENDEREÇO -->
<div class="space-y-4">
  <h3 class="text-lg font-bold text-on-surface">Endereço</h3>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <input type="text" id="cep" name="cep" placeholder="CEP" required class="input w-full">
    <input type="text" name="numero" placeholder="Número" required class="input w-full">
  </div>

  <fieldset class="space-y-4">

    <input id="rua" type="text" name="rua" placeholder="Rua" required class="input w-full" readonly>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
      <input id="bairro" type="text" name="bairro" placeholder="Bairro" required class="input w-full" readonly>
      <input id="cidade" type="text" name="cidade" placeholder="Cidade" required class="input w-full" readonly>
    </div>

    <input id="estado" type="text" name="estado" placeholder="Estado" required class="input w-full" readonly>

  </fieldset>
</div>

<!-- BOTÃO -->
    <p id="responseErro" style="color:red;"><?php  if(isset($responseError)) echo $responseError;?></p>
<div class="pt-6">
  <button id="submitbutton" type="submit" 
    class="w-full signature-gradient text-white py-4 rounded-lg font-semibold tracking-wide hover:opacity-90 transition" name="registrar">
    FINALIZAR CADASTRO
  </button>
</div>

</form>
<div class="mt-8 text-center">
<p class="font-body text-xs text-on-surface-variant uppercase tracking-widest">
                        Already part of the fleet? <a class="text-primary font-bold hover:underline" href="#">Login Access</a>
</p>
</div>
</div>
</div>
</div>
<!-- Footer Segment (Floating Style) -->
<footer class="absolute bottom-4 left-1/2 -translate-x-1/2 w-full max-w-7xl px-8 hidden md:block">
<div class="flex justify-between items-center text-[10px] font-label text-on-background/40 uppercase tracking-[0.3em] font-bold">
<div>© 2024 TITAN RENTALS INDUSTRIAL GROUP.</div>
<div class="flex gap-8">
<a class="hover:text-primary transition-colors" href="#">FLEET SOLUTIONS</a>
<a class="hover:text-primary transition-colors" href="#">SAFETY STANDARDS</a>
<a class="hover:text-primary transition-colors" href="#">CONTACT ENGINEERING</a>
</div>
</div>
</footer>
<script src="../generico/jsgenerico/script.js"></script>
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

//MÁSCARA DE TELEFONE
telefoneField.addEventListener("input", (e) => {
  let value = e.target.value;

  value = value.replace(/\D/g, "");

  // limita a 11 dígitos
  value = value.substring(0, 11);

  // aplica máscara
  value = value.replace(/^(\d{2})(\d)/g, "($1) $2");
  value = value.replace(/(\d{5})(\d)/, "$1-$2");

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
</script>
</body></html>
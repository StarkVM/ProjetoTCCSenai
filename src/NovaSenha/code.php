<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTCCSenai/src/config/session.php';

$er = $_GET['er'] ?? null;
if (isset($er) && !empty($er)) {
    if ($er == "1") $responseError = "Não foi enviar o código para o email, por favor, revise os dados e tente novamente!";
    else $responseError = "Houve um erro ao processar os dados! Por favor, tente novamente.";
}

?>

<!DOCTYPE html>

<html lang="pt-BR"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Definir Nova Senha | Heavy Rent</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&amp;family=Inter:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
          darkMode: "class",
          theme: {
            extend: {
              "colors": {
                      "on-primary-fixed": "#2a1800",
                      "tertiary-fixed": "#c0e8ff",
                      "surface-bright": "#fcf9f8",
                      "secondary": "#546067",
                      "primary-fixed-dim": "#ffb957",
                      "tertiary-container": "#2ac6ff",
                      "outline": "#857462",
                      "on-tertiary-fixed": "#001e2b",
                      "surface-container": "#f0edec",
                      "on-secondary-container": "#5a666d",
                      "primary": "#835400",
                      "on-error-container": "#93000a",
                      "on-secondary": "#ffffff",
                      "primary-container": "#f9a825",
                      "on-surface-variant": "#524434",
                      "on-error": "#ffffff",
                      "inverse-surface": "#313030",
                      "background": "#fcf9f8",
                      "primary-fixed": "#ffddb5",
                      "on-surface": "#1c1b1b",
                      "inverse-primary": "#ffb957",
                      "error-container": "#ffdad6",
                      "secondary-fixed": "#d7e4ec",
                      "outline-variant": "#d7c3ae",
                      "on-primary-fixed-variant": "#643f00",
                      "surface-container-low": "#f6f3f2",
                      "secondary-fixed-dim": "#bbc8d0",
                      "on-primary-container": "#674100",
                      "surface-container-high": "#ebe7e7",
                      "on-secondary-fixed-variant": "#3c494f",
                      "on-tertiary-container": "#004f69",
                      "on-secondary-fixed": "#111d23",
                      "inverse-on-surface": "#f3f0ef",
                      "on-background": "#1c1b1b",
                      "surface": "#fcf9f8",
                      "on-tertiary-fixed-variant": "#004d66",
                      "on-primary": "#ffffff",
                      "tertiary-fixed-dim": "#71d2ff",
                      "tertiary": "#006687",
                      "surface-container-lowest": "#ffffff",
                      "surface-variant": "#e5e2e1",
                      "surface-container-highest": "#e5e2e1",
                      "on-tertiary": "#ffffff",
                      "error": "#ba1a1a",
                      "surface-dim": "#dcd9d9",
                      "surface-tint": "#835400",
                      "secondary-container": "#d7e4ec"
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
          }
        }
    </script>
<style>.material-symbols-outlined {
    font-variation-settings: "FILL" 0, "wght" 400, "GRAD" 0, "opsz" 24;
    vertical-align: middle
    }
.bg-industrial-texture {
    background-image: linear-gradient(rgba(28, 27, 27, 0.7), rgba(28, 27, 27, 0.85)), url(https://lh3.googleusercontent.com/aida-public/AB6AXuAv1lNtMnmr7pwZBHanHuZncIMOiTzTdAh_PAWLElHINBgJRffyLuaFFPUAZCN90esHimzpN-JHv-SamGOUuZlyOUlR1dKIO14p9m3UYIVgH0kMNQLJsJPqkLYaQrSsaCw-ZGq9lezKA83I9vg5F-LjPsfe7l6qKNC46qEhylHiUehalLLwIgh2853XJsHKCkl6bS2iRoLyKR8Ow4PMprwlAjrUU1CaWysFEFHrdX09jwFfxtX8jW4PqZt2lHiksT3Vu72fTHOMm2V4);
    background-size: cover;
    background-position: center
    }
.signature-gradient {
    background: linear-gradient(135deg, #835400 0%, #f9a825 100%)
    }
.ambient-occlusion {
    box-shadow: 0 32px 64px -12px rgba(28, 27, 27, 0.06)
    }</style>
</head>
<body class="bg-surface text-on-surface font-body selection:bg-primary-container selection:text-on-primary-container">
    <header id="header"></header>
<main class="min-h-screen flex flex-col md:flex-row overflow-hidden">
<!-- Left Side: Dark Visual / Brand -->
<section class="hidden md:flex md:w-[45%] lg:w-[40%] bg-inverse-surface relative overflow-hidden items-center justify-center p-12 bg-industrial-texture" data-alt="close-up of industrial hydraulic machinery with yellow steel beams and heavy pistons in a construction site during sunset">
<div class="relative z-10 w-full">
<!-- Brand Anchor -->
<div class="mb-24">
<span class="font-headline text-2xl font-bold tracking-tighter uppercase text-surface-bright">Heavy Rent</span>
<div class="h-1 w-12 bg-primary mt-2"></div>
</div>
<!-- Brand Message -->
<div class="max-w-md">
<h2 class="font-headline text-4xl lg:text-6xl font-bold text-surface-bright leading-[1] tracking-tighter mb-4">
                        Segurança<br />de Primeira
</h2>
<p class="font-body text-lg text-surface-variant/80 leading-relaxed">
                        Proteja sua conta e acesse seus equipamentos com segurança.
                    </p>
</div>
</div>
</section>
<!-- Right Side: Form Container -->
<section class="flex-1 flex items-center justify-center p-6 md:p-16 lg:p-24 bg-surface">
<div class="w-full max-w-lg">
<!-- Mobile Branding (Hidden on MD) -->
<div class="md:hidden mb-12 flex flex-col items-center">
<span class="font-headline text-xl font-black tracking-tighter uppercase text-primary">Heavy Rent</span>
<div class="h-[1px] w-full bg-surface-container-highest mt-6"></div>
</div>
<!-- Form Header -->

<!-- Form Body -->
<form class="space-y-8" method="POST" action="novasenha.php">
<!-- Email Field -->
<div class="space-y-2">
<label class="font-headline text-xs font-bold uppercase tracking-widest text-on-surface-variant flex items-center gap-2" for="email">
<span class="material-symbols-outlined text-[16px]">terminal</span>
                            E-mail do Usuario
                        </label>
<div class="relative group">
<input name="email" class="w-full bg-surface-container-lowest border-none rounded-md px-4 py-4 text-on-surface font-medium placeholder:text-outline/40 focus:ring-2 focus:ring-primary/20 transition-all duration-200" id="email" placeholder="usuario@titan-rentals.com.br" required="" type="email"
        <?php if(isset($_SESSION["email"]))  echo"value=" .$_SESSION["email"];  ?> <?php if(isset($_SESSION["email"])) echo 'disabled' ?>>
<div class="absolute bottom-0 left-0 h-[2px] w-0 bg-primary group-focus-within:w-full transition-all duration-500"></div>
</div>
</div>
<!-- New Password Field -->
<div class="space-y-2">
<label class="font-headline text-xs font-bold uppercase tracking-widest text-on-surface-variant flex items-center gap-2" for="password">
<span class="material-symbols-outlined text-[16px]">lock_open</span>
                            Nova Senha
                        </label>
<div class="relative group">
<input class="w-full bg-surface-container-lowest border-none rounded-md px-4 py-4 pr-12 text-on-surface font-medium placeholder:text-outline/40 focus:ring-2 focus:ring-primary/20 transition-all duration-200" id="password" placeholder="Mínimo 8 caracteres" required="" type="password"/>
<button class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-primary transition-colors" id="togglePassword" type="button" aria-label="Mostrar/Ocultar senha">
<span class="material-symbols-outlined">visibility</span>
</button>
<div class="absolute bottom-0 left-0 h-[2px] w-0 bg-primary group-focus-within:w-full transition-all duration-500"></div>
</div>
</div>
<!-- Confirm Password Field -->
<div class="space-y-2">
<label  class="font-headline text-xs font-bold uppercase tracking-widest text-on-surface-variant flex items-center gap-2" for="confirm-password">
<span class="material-symbols-outlined text-[16px]">verified_user</span>
                            Confirmar Nova Senha
                        </label>
<div class="relative group">
<input name="senha" class="w-full bg-surface-container-lowest border-none rounded-md px-4 py-4 pr-12 text-on-surface font-medium placeholder:text-outline/40 focus:ring-2 focus:ring-primary/20 transition-all duration-200" id="confirm-password" placeholder="Confirme a senha" required="" type="password"/>
<button class="absolute right-3 top-1/2 -translate-y-1/2 text-outline hover:text-primary transition-colors" id="toggleConfirmPassword" type="button" aria-label="Mostrar/Ocultar confirmação de senha">
<span class="material-symbols-outlined">visibility</span>
</button>
<div class="absolute bottom-0 left-0 h-[2px] w-0 bg-primary group-focus-within:w-full transition-all duration-500"></div>
</div>
<!-- Password Match Indicator -->
<div id="passwordMatchIndicator" class="hidden mt-2 flex items-center gap-2 text-xs font-medium">
<span class="material-symbols-outlined text-sm">close</span>
<span id="matchText">As senhas não coincidem</span>
</div>
</div>
<!-- Action Area -->
<div class="pt-6 space-y-6">
<!-- Primary Button -->
<button name="atualizar" class="signature-gradient w-full py-5 rounded-md flex items-center justify-center gap-3 text-white font-headline font-bold uppercase tracking-widest group hover:opacity-90 active:scale-[0.98] transition-all ambient-occlusion disabled:opacity-50 disabled:cursor-not-allowed" id="submitBtn" type="submit" disabled>
                            ATUALIZAR SENHA
                            <span class="material-symbols-outlined group-hover:translate-x-1 transition-transform">arrow_forward</span>
</button>
    <p id="erro" style="color: red"><?php if (isset($responseError)) echo $responseError ?></p>
<!-- Secondary Link -->
<div class="flex justify-center">
<a class="font-label text-sm font-semibold uppercase tracking-widest text-on-surface-variant hover:text-primary flex items-center gap-2 group transition-colors" href="../login/code.php">
<span class="material-symbols-outlined text-[18px] group-hover:-translate-x-1 transition-transform">arrow_back</span>
                                Voltar ao login
                            </a>
</div>
</div>
</form>
<!-- Status Footer -->

</div>
</section>
</main>
<!-- Aesthetic Corner Detail -->
<div class="fixed top-8 right-8 pointer-events-none opacity-5 hidden lg:block">
<svg fill="none" height="120" viewbox="0 0 120 120" width="120" xmlns="http://www.w3.org/2000/svg">
<path d="M0 0H20V120H0V0Z" fill="currentColor"></path>
<path d="M40 0H60V120H40V0Z" fill="currentColor"></path>
<path d="M80 0H100V120H80V0Z" fill="currentColor"></path>
</svg>
</div>
<footer id="footer"></footer>

<script>
// Toggle password visibility
function setupPasswordToggle(inputId, buttonId) {
  const input = document.getElementById(inputId);
  const button = document.getElementById(buttonId);
  
  button.addEventListener('click', (e) => {
    e.preventDefault();
    const icon = button.querySelector('.material-symbols-outlined');
    
    if (input.type === 'password') {
      input.type = 'text';
      icon.textContent = 'visibility_off';
    } else {
      input.type = 'password';
      icon.textContent = 'visibility';
    }
  });
}

// Validate password match
function validatePasswords() {
  const password = document.getElementById('password').value;
  const confirmPassword = document.getElementById('confirm-password').value;
  const indicator = document.getElementById('passwordMatchIndicator');
  const matchText = document.getElementById('matchText');
  const submitBtn = document.getElementById('submitBtn');
  const icon = indicator.querySelector('.material-symbols-outlined');
  
  if (password && confirmPassword) {
    if (password === confirmPassword) {
      indicator.classList.remove('hidden');
      indicator.classList.add('text-tertiary');
      matchText.textContent = 'Senhas coincidem';
      icon.textContent = 'check_circle';
      icon.classList.add('text-tertiary');
      submitBtn.disabled = false;
    } else {
      indicator.classList.remove('hidden');
      indicator.classList.remove('text-tertiary');
      indicator.classList.add('text-error');
      matchText.textContent = 'As senhas não coincidem';
      icon.textContent = 'close';
      icon.classList.remove('text-tertiary');
      icon.classList.add('text-error');
      submitBtn.disabled = true;
    }
  } else {
    indicator.classList.add('hidden');
    submitBtn.disabled = true;
  }
}

document.addEventListener('DOMContentLoaded', () => {
  // Setup password toggle buttons
  setupPasswordToggle('password', 'togglePassword');
  setupPasswordToggle('confirm-password', 'toggleConfirmPassword');
  
  // Setup password validation
  const passwordInput = document.getElementById('password');
  const confirmPasswordInput = document.getElementById('confirm-password');
  
  passwordInput.addEventListener('input', validatePasswords);
  confirmPasswordInput.addEventListener('input', validatePasswords);
  
  // Form submission
  const form = document.querySelector('form');
    form.addEventListener('submit', (e) => {
        const password = passwordInput.value;
        const confirmPassword = confirmPasswordInput.value;

        if (password !== confirmPassword) {
            e.preventDefault();
            matchText.textContent = 'As senhas não coincidem!';
            return;
        }

        if (password.length < 8) {
            e.preventDefault();
            matchText.textContent = 'A senha deve ter no mínimo 8 caracteres!';
            return;
        }
    });
});
</script>

<script src="../generico/jsgenerico/frame.js"></script>
</body></html>

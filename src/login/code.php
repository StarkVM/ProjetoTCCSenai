<?php
$er = $_GET['er'] ?? null;
if(isset($er) && !empty($er))
{
    if($er == "1") $responseError = "Não foi possivel completar o login!";
    else if($er == "2")  $responseError = "Ocorreu um erro ao efetuar o login, verifique os dados e tente novamente.";
    else if($er == "3")  $responseError = "A senha informada precisa ter no mínimo 8 caracteres!";
    else $responseError = "Houve um erro ao processar os dados! Por favor, tente novamente.";
}
?>


<!DOCTYPE html>

<html class="light" lang="pt-BR"><head>
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
        .industrial-grid {
            background-image: radial-gradient(circle at 2px 2px, #e5e2e1 1px, transparent 0);
            background-size: 40px 40px;
        }
    </style>
</head>
<body class="bg-surface text-on-surface font-body selection:bg-primary-container selection:text-on-primary-container">
<main class="min-h-screen flex items-center justify-center relative overflow-hidden px-4">
<!-- Background Decorative Elements -->
<div class="absolute inset-0 industrial-grid opacity-40 pointer-events-none"></div>
<div class="absolute top-0 right-0 w-1/2 h-full hidden lg:block opacity-10 pointer-events-none grayscale contrast-125">
<img class="w-full h-full object-cover" data-alt="high-contrast monochromatic close-up of heavy duty construction crane gears and hydraulic pistons with clean industrial lines" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCEsC6amGXv6pFd4VpTR3Cq3Pr2Rm21kYtmmavrIaScfMESq9aiBGfPg4MHJL_925YZVOY93lJxmRrrBYQ0knD8_XP2gtkV8uEpIJHhF4ukTCC6XrvA9VkvpKjd5iBKrCVShRatUq5PwolCTe-A3a6c82SqBkC0HBgPfPzcNnu3X4b_k5mjecL3wCVH5Zk8HNKApQLrMHZUPPM4aHuMQEsJNLTh1kT0rjhq3algKVeS9limikHhxMFaTo-wkV-PynhpU5in66BgElW5"/>
</div>
<!-- Login Container -->
<div class="w-full max-w-[1200px] grid grid-cols-1 lg:grid-cols-12 gap-0 relative z-10">
<!-- Left Branding Side -->
<div class="lg:col-span-5 bg-on-surface p-12 flex flex-col justify-between rounded-l-lg lg:rounded-r-none">
<div>
<h1 class="font-headline font-black text-4xl tracking-tighter text-surface uppercase leading-none mb-4">
                        Heavy Rent
                    </h1>
<div class="h-1 w-12 bg-primary mb-8"></div>
<p class="font-headline text-2xl font-light text-surface-container tracking-tight leading-snug">
                        ENGENHARIA DE PRECISÃO. <br/>
                        PODER INQUEBRÁVEL.
                    </p>
</div>
<div class="mt-20">
<div class="flex items-center gap-4 mb-6">
<div class="w-12 h-12 flex items-center justify-center bg-surface-container-highest/10 rounded-sm">
<span class="material-symbols-outlined text-primary" style="font-variation-settings: 'FILL' 1;">precision_manufacturing</span>
</div>
<div>
<p class="font-headline text-xs font-bold text-surface-variant uppercase tracking-widest">Autoridade da Frota</p>
<p class="text-surface-container-low text-sm font-light">Acesse especificações de maquinário profissional e agendamento de locações.</p>
</div>
</div>
</div>
</div>
<!-- Right Form Side -->
<div class="lg:col-span-7 bg-surface-container-lowest p-8 md:p-16 rounded-r-lg lg:rounded-l-none border-y lg:border-y-0 lg:border-r border-surface-container-highest">
<div class="max-w-md mx-auto">
<div class="mb-12">
<h2 class="font-headline text-3xl font-bold text-on-surface tracking-tight mb-2">Entrar</h2>
<p class="text-on-surface-variant text-sm uppercase tracking-widest font-semibold">Portal de Clientes Industriais</p>
</div>
<form class="space-y-6" method="post" action="login.php">
<!-- Email Field -->
<div class="space-y-2">
<label class="font-headline text-xs font-bold text-on-surface uppercase tracking-widest flex items-center gap-2" for="email">
<span class="material-symbols-outlined text-[16px]">alternate_email</span>
                                Email
                            </label>
<input class="w-full bg-surface-container-low border-none rounded-sm px-4 py-4 font-headline text-base focus:ring-2 focus:ring-primary transition-all placeholder:text-outline/50" id="email" name="email" placeholder="engineering@titan-rentals.com" required="" type="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"/>
</div>
<!-- Password Field -->
<div class="space-y-2">
<div class="flex justify-between items-end">
<label class="font-headline text-xs font-bold text-on-surface uppercase tracking-widest flex items-center gap-2" for="password">
<span class="material-symbols-outlined text-[16px]">lock_open</span>
                                    Senha
                                </label>
<a class="font-headline text-[10px] font-bold text-primary uppercase tracking-widest hover:text-on-primary-container transition-colors" href="#">
                                    Esqueceu a senha?
                                </a>
</div>
<input class="w-full bg-surface-container-low border-none rounded-sm px-4 py-4 font-headline text-base focus:ring-2 focus:ring-primary transition-all placeholder:text-outline/50" id="password" name="senha" placeholder="••••••••••••" required="" type="password"/>
</div>
<!-- Options -->
<div class="flex items-center">
<input class="w-4 h-4 text-primary border-outline-variant rounded-none focus:ring-primary focus:ring-offset-0 bg-surface-container-low" id="remember" name="remember" type="checkbox"/>
<label class="ml-3 font-label text-xs font-medium text-on-surface-variant uppercase tracking-wider" for="remember">
                                Lembrar deste terminal
                            </label>
</div>
<!-- Login Button -->
    <p id="erro" style="font-size: 10px color=red"><?php if(isset($responseError)) echo $responseError?></p>
<div class="pt-4">
<button name="loginEntrar" class="group relative w-full bg-primary hover:bg-on-primary-container text-on-primary font-headline font-black text-sm uppercase tracking-[0.2em] py-5 rounded-sm transition-all duration-300 flex items-center justify-center gap-3 overflow-hidden" type="submit">
<div class="absolute inset-0 bg-gradient-to-r from-primary to-primary-container opacity-50 group-hover:opacity-100 transition-opacity"></div>
<span class="relative z-10">Autorizar Sessão</span>
<span class="material-symbols-outlined relative z-10 text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
</button>
</div>
</form>
<!-- Footer / Signup -->
<div class="mt-12 pt-8 border-t border-surface-container-highest flex flex-col sm:flex-row justify-between items-center gap-4">
<p class="font-label text-xs text-on-surface-variant uppercase tracking-widest">
                            Novo operador?
                        </p>
<a class="font-headline text-xs font-bold text-on-surface uppercase tracking-[0.1em] px-6 py-2 border border-outline-variant hover:bg-surface-container-high transition-colors rounded-sm" href="../cadastro/code.php">
                            Criar Conta
                        </a>
</div>
</div>
</div>
</div>
<!-- Floating Hardware Details -->
<div class="absolute bottom-10 right-10 hidden xl:block">
<div class="flex flex-col items-end gap-2 opacity-30">
<p class="font-headline text-[10px] font-black tracking-[0.3em] uppercase">Security Level 4-A</p>
<div class="flex gap-1">
<div class="h-1 w-8 bg-on-surface"></div>
<div class="h-1 w-2 bg-primary"></div>
</div>
</div>
</div>
</main>
<!-- Simple Footer (using style tokens from JSON) -->
<footer class="w-full bg-[#f6f3f2] grid grid-cols-1 md:grid-cols-2 gap-8 px-12 py-8 border-t border-[#e5e2e1]">
<div class="flex flex-col gap-2">
<span class="text-lg font-bold text-[#1c1b1b] tracking-tighter uppercase font-headline">Heavy Rent</span>
<p class="font-['Inter'] text-[10px] uppercase tracking-widest text-[#777271]">© 2024 Heavy Rent INDUSTRIAL GROUP. PRECISION ENGINEERING.</p>
</div>
<div class="flex flex-wrap gap-x-6 gap-y-2 md:justify-end items-center">
<a class="font-['Inter'] text-xs uppercase tracking-widest text-[#777271] hover:text-[#835400] transition-colors" href="#">Soluções de Frota</a>
<a class="font-['Inter'] text-xs uppercase tracking-widest text-[#777271] hover:text-[#835400] transition-colors" href="#">Normas de Segurança</a>
<a class="font-['Inter'] text-xs uppercase tracking-widest text-[#777271] hover:text-[#835400] transition-colors" href="#">Termos de Serviço</a>
</div>
</footer>
</body></html>

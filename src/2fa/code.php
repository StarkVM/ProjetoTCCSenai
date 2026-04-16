<?php

session_start();

$er = $_GET['er'] ?? null;
if(isset($er) && !empty($er))
{
    if($er == "1") $responseError = "Não foi possivel verificar o email!";
    else if($er == "2")  $responseError = "Ocorreu um erro ao verificar o email, verifique os dados novamente.";
    else $responseError = "Houve um erro ao processar os dados! Por favor, tente novamente.";
}
?>

<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<title>Titan Rentals | Secure Access</title>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800;900&amp;family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "outline-variant": "#d7c3ae",
                        "on-surface": "#1c1b1b",
                        "on-tertiary-container": "#004f69",
                        "background": "#fcf9f8",
                        "tertiary-fixed": "#c0e8ff",
                        "surface-container": "#f0edec",
                        "on-primary-fixed-variant": "#643f00",
                        "on-primary-container": "#674100",
                        "on-tertiary": "#ffffff",
                        "surface-variant": "#e5e2e1",
                        "secondary-fixed-dim": "#bbc8d0",
                        "on-primary-fixed": "#2a1800",
                        "surface-dim": "#dcd9d9",
                        "tertiary-fixed-dim": "#71d2ff",
                        "on-tertiary-fixed-variant": "#004d66",
                        "inverse-surface": "#313030",
                        "secondary-container": "#d7e4ec",
                        "on-tertiary-fixed": "#001e2b",
                        "on-surface-variant": "#524434",
                        "surface-container-lowest": "#ffffff",
                        "on-secondary": "#ffffff",
                        "on-error": "#ffffff",
                        "primary-container": "#f9a825",
                        "on-secondary-container": "#5a666d",
                        "primary-fixed-dim": "#ffb957",
                        "inverse-primary": "#ffb957",
                        "error": "#ba1a1a",
                        "outline": "#857462",
                        "secondary-fixed": "#d7e4ec",
                        "surface-tint": "#835400",
                        "on-secondary-fixed": "#111d23",
                        "on-primary": "#ffffff",
                        "secondary": "#546067",
                        "primary-fixed": "#ffddb5",
                        "surface-container-low": "#f6f3f2",
                        "tertiary": "#006687",
                        "surface-bright": "#fcf9f8",
                        "tertiary-container": "#2ac6ff",
                        "on-background": "#1c1b1b",
                        "primary": "#835400",
                        "on-secondary-fixed-variant": "#3c494f",
                        "inverse-on-surface": "#f3f0ef",
                        "error-container": "#ffdad6",
                        "surface": "#fcf9f8",
                        "surface-container-highest": "#e5e2e1",
                        "on-error-container": "#93000a",
                        "surface-container-high": "#ebe7e7"
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
    </style>
</head>
<body class="bg-background font-body text-on-background antialiased overflow-hidden">
<!-- Suppression of Nav Shells as per "The Destination Rule" for Transactional Flow -->
<main class="min-h-screen grid grid-cols-1 md:grid-cols-2">
<!-- Left Column: Branding & Immersive Visual -->
<section class="hidden md:flex relative items-end p-12 bg-on-surface">
<div class="absolute inset-0 z-0">
<img class="w-full h-full object-cover opacity-40 grayscale-[0.5]" data-alt="dramatic low-angle shot of a massive yellow excavator on a construction site at dusk with harsh industrial lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBppiWBJ-lBvlHyHKoqGHS9i5kKmagZeh-Qo27kwfQSeOzfx0hUL3NADEgqXwqbM-Snj2dh5yuvfU6j7RBYm14EIuO-2yQVG3nzET45M42JIHw3zev1hf5tKoKC84b0-eaWOLNiCvYeNExsgTKd2ce6uAMPG4Levxo2vpaEZVrvnr3c7q-whX4v0wd_AP2dp0fuhjjEsCOLYG6uFCaqb8cXv2KF-Fv-gYCLAtih2Bt402kAJtGqUarLUYeI2TqzJP3jMsqZBbVB6AeM"/>
<div class="absolute inset-0 bg-gradient-to-t from-on-surface via-on-surface/40 to-transparent"></div>
</div>
<div class="relative z-10 max-w-lg">
<div class="mb-8">
<span class="text-primary-container font-headline font-black italic tracking-tighter text-4xl block mb-2">TITAN RENTALS</span>
<div class="h-1 w-24 bg-primary-container"></div>
</div>
<h1 class="font-headline text-5xl font-bold text-white leading-none tracking-tight mb-6">
                    PRECISION<br/>SECURED.
                </h1>
<p class="text-surface-variant font-body text-lg leading-relaxed max-w-sm">
                    Accessing high-capacity inventory requires verified clearance. Enter your authorization token to proceed to the terminal.
                </p>
</div>
<!-- Absolute Top Left Logo for Branding Consistency -->
<div class="absolute top-12 left-12 flex items-center gap-2">
<span class="material-symbols-outlined text-primary-container" style="font-variation-settings: 'FILL' 1;">precision_manufacturing</span>
<span class="font-headline font-bold uppercase tracking-widest text-xs text-surface-container">Operator Node 88-XJ</span>
</div>
</section>
<!-- Right Column: 2FA Input Area -->
<section class="bg-surface flex items-center justify-center p-8 md:p-16 relative">
<!-- Mobile Brand Header (Visible only on small screens) -->
<div class="absolute top-8 left-8 md:hidden">
<span class="text-on-surface font-headline font-black italic tracking-tighter text-xl">TITAN RENTALS</span>
</div>
<div class="w-full max-w-md">
<!-- Header Icon & Title -->
<div class="mb-12">
<div class="inline-flex items-center justify-center w-16 h-16 bg-surface-container-highest mb-6 rounded-lg">
<span class="material-symbols-outlined text-primary text-3xl" style="font-variation-settings: 'FILL' 1;">shield_person</span>
</div>
<h2 class="font-headline text-3xl font-bold tracking-tight text-on-surface mb-2 uppercase">Authorization Required</h2>
<p class="text-on-surface-variant text-sm font-medium">
                        Digite o código para verificação de 6 dígitos que foi enviado para o email <?php echo $_SESSION['email'] ?? "<p style='color: red;'> EMAIL NÃO CARREGADO! </p>"; ?></span>.
                    </p>
</div>
<!-- 2FA Input Field Grid -->
<form class="space-y-8"  method="post" action="2fa.php">
<div>
<label class="block font-headline text-[10px] uppercase tracking-[0.2em] font-bold text-on-surface-variant mb-4">
                            Security Token
                        </label>
<div class="flex gap-2 sm:gap-3">
<!-- Input pattern using the "Sturdy Card" rule for inputs -->
<input name="codigoChar1" class="w-full aspect-square text-center font-headline text-2xl font-bold bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-md text-on-surface shadow-inner" maxlength="1" type="text" placeholder="0"/>
<input name="codigoChar2" class="w-full aspect-square text-center font-headline text-2xl font-bold bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-md text-on-surface shadow-inner" maxlength="1" type="text" placeholder="0"/>
<input name="codigoChar3" class="w-full aspect-square text-center font-headline text-2xl font-bold bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-md text-on-surface shadow-inner" maxlength="1" placeholder="0" type="text"/>
<input name="codigoChar4" class="w-full aspect-square text-center font-headline text-2xl font-bold bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-md text-on-surface shadow-inner" maxlength="1" placeholder="0" type="text"/>
<input name="codigoChar5" class="w-full aspect-square text-center font-headline text-2xl font-bold bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-md text-on-surface shadow-inner" maxlength="1" placeholder="0" type="text"/>
<input name="codigoChar6" class="w-full aspect-square text-center font-headline text-2xl font-bold bg-surface-container-low border-none focus:ring-2 focus:ring-primary rounded-md text-on-surface shadow-inner" maxlength="1" placeholder="0" type="text"/>
</div>
</div>
<!-- Actions -->
<div class="space-y-4">
    <p id="erro" style='font-size: 17px; color:red'><?php if(isset($responseError)) echo $responseError?></p>
<button name="verificar" class="w-full signature-gradient text-white py-4 font-headline font-bold uppercase tracking-widest text-sm rounded-md shadow-lg active:scale-[0.98] transition-transform flex items-center justify-center gap-2">
                            Verify Identity
                            <span class="material-symbols-outlined text-lg">verified_user</span>
</button>
<div class="flex items-center justify-between pt-4">
<button class="text-on-surface-variant font-label text-[10px] uppercase tracking-widest hover:text-primary transition-colors flex items-center gap-2">
<span class="material-symbols-outlined text-sm">refresh</span>
                                Resend Token
                            </button>
<a class="text-primary font-label text-[10px] uppercase tracking-widest font-bold border-b-2 border-primary/20 hover:border-primary transition-all" href="#">
                                Support Terminal
                            </a>
</div>
</div>
</form>
<!-- System Metadata Footer -->
<div class="mt-20 flex flex-col gap-6">
<div class="h-[1px] w-full bg-surface-container-highest"></div>
<div class="flex items-center gap-4 text-on-surface-variant/40">
<div class="flex flex-col">
<span class="font-headline text-[9px] uppercase font-bold tracking-widest">Protocol</span>
<span class="font-body text-[11px]">AES-256 Industrial Grade</span>
</div>
<div class="w-1 h-1 bg-surface-container-highest rounded-full"></div>
<div class="flex flex-col">
<span class="font-headline text-[9px] uppercase font-bold tracking-widest">Instance</span>
<span class="font-body text-[11px]">TITAN-SEC-442</span>
</div>
</div>
</div>
</div>
<!-- Absolute Bottom Corner Technical Decoration -->
<div class="absolute bottom-4 right-4 opacity-10 pointer-events-none hidden lg:block">
<span class="material-symbols-outlined text-[120px]" style="font-variation-settings: 'wght' 100;">lock_open</span>
</div>
</section>
</main>
<!-- Global Footer Fragment (Partial Injection) -->
<footer class="bg-on-surface w-full py-6 px-12 flex flex-col md:flex-row justify-between items-center fixed bottom-0 left-0 right-0 z-50 mix-blend-difference md:mix-blend-normal md:bg-transparent">
<p class="font-body text-[10px] uppercase tracking-[0.2em] text-surface-container/30">
            ©2024 HEAVY INDUSTRIES. PRECISION BRUTALISM SYSTEMS.
        </p>
<div class="hidden md:flex gap-8">
<span class="font-body text-[10px] uppercase tracking-[0.2em] text-surface-container/30">Safety Protocols</span>
<span class="font-body text-[10px] uppercase tracking-[0.2em] text-surface-container/30">Machine Ethics</span>
</div>
</footer>
</body></html>
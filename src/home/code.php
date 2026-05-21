<?php

//require "verification.php";

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

        .bento-grid {
            display: grid;
            grid-template-columns: repeat(12, 1fr);
            gap: 1.5rem;
        }
    </style>
</head>

<body class="bg-surface text-on-surface font-body selection:bg-primary-container selection:text-on-primary-container">
    <!-- TopAppBar -->
    <header id="header"></header>
    <main>
        <!-- Hero Section -->
        <section class="relative min-h-[870px] flex items-center overflow-hidden bg-surface">
            <div class="absolute inset-0 z-0">
                <img class="w-full h-full object-cover opacity-20 grayscale scale-105" data-alt="Cinematic shot of a heavy yellow excavator on a construction site at dusk with dramatic industrial lighting and dust particles in the air" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDkQR2gY1qSWGbdz_2m-iES5MC7FO30YUfoTvl0pVeuF1_CS2NtRDK5-jllz0zK79Xaul3DjyUQ2nU53qzleg5y-3RNtPwHKjiv0C6FcQr5bUeMw99DBe5z4p-ccotQojHGB24UY5Vmy3rq7dOasSoFCW6pNaile9vo7UeHck-qaus3fp5j7aJ5pncmx_M8VbkOzYWoM9yZlzD-BnLYW0qEg7Y-ibtIgtoo8zWOfwbjyFVkj8ELgbwTryHAzqFaoIflBp6FQNgGFw1t" />
                <div class="absolute inset-0 bg-gradient-to-r from-surface via-surface/80 to-transparent"></div>
            </div>
            <div class="container mx-auto px-8 relative z-10">
                <div class="max-w-4xl">
                    <span class="font-headline font-bold uppercase tracking-[0.3em] text-primary mb-6 block text-sm">Precisão Industrial</span>
                    <h1 class="font-headline text-7xl md:text-8xl font-black leading-[0.9] tracking-tighter text-on-surface mb-8">
                        A MAIOR FROTA <br /> <span class="text-primary-container">AO SEU ALCANCE.</span>
                    </h1>
                    <!-- Search & Filter Bar -->
                    <div class="bg-surface-container-lowest/80 backdrop-blur-xl p-2 rounded-md shadow-2xl flex flex-col md:flex-row gap-2 max-w-3xl mt-12">
                        <div class="flex-1 flex items-center px-4 bg-surface-container-low rounded-sm">
                            <span class="material-symbols-outlined text-outline">search</span>
                            <input class="w-full bg-transparent border-none focus:ring-0 font-body py-4 placeholder:text-outline-variant" placeholder="Qual máquina você precisa hoje?" type="text" />
                        </div>
                        <button class="bg-primary text-on-primary font-headline font-bold uppercase px-10 py-4 rounded-sm hover:bg-primary-container transition-colors duration-300">
                            Pesquisar
                        </button>
                    </div>
                    <!-- Category Chips -->
                    <div class="flex flex-wrap gap-3 mt-8">
                        <button class="bg-secondary-container text-on-secondary-container px-6 py-2 rounded-full font-label text-xs font-bold uppercase tracking-widest hover:opacity-80 transition-all flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">construction</span> Escavadeiras
                        </button>
                        <button class="bg-surface-container-highest text-on-surface-variant px-6 py-2 rounded-full font-label text-xs font-bold uppercase tracking-widest hover:opacity-80 transition-all flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">precision_manufacturing</span> Guindastes
                        </button>
                        <button class="bg-surface-container-highest text-on-surface-variant px-6 py-2 rounded-full font-label text-xs font-bold uppercase tracking-widest hover:opacity-80 transition-all flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">agriculture</span> Retroescavadeiras
                        </button>
                        <button class="bg-surface-container-highest text-on-surface-variant px-6 py-2 rounded-full font-label text-xs font-bold uppercase tracking-widest hover:opacity-80 transition-all flex items-center gap-2">
                            <span class="material-symbols-outlined text-sm">forklift</span> Tratores
                        </button>
                    </div>
                </div>
            </div>
            <!-- Side Stat -->
            <div class="hidden lg:block absolute right-12 bottom-24 origin-right rotate-90 transform translate-x-1/2">
                <p class="font-headline font-black text-9xl text-surface-container-highest/50 tracking-tighter">PRECISE_01</p>
            </div>
        </section>
        <!-- Featured Machinery Grid -->
        <section class="py-24 bg-surface-container-low">
            <div class="container mx-auto px-8">
                <div class="flex justify-between items-end mb-16">
                    <div>
                        <h2 class="font-headline text-5xl font-black uppercase tracking-tighter">Máquinas em Destaque</h2>
                        <div class="h-1 w-24 bg-primary mt-4"></div>
                    </div>
                    <a class="text-primary font-headline font-bold uppercase tracking-widest text-sm flex items-center gap-2 hover:gap-4 transition-all" href="#">
                        Ver Catálogo Completo <span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                </div>
                <!-- CONTAINER DE CARDS -->
                <div id="cards-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        </section>
        <!-- Why Us Section (Bento Grid) -->
        <section class="py-32 bg-surface">
            <div class="container mx-auto px-8">
                <div class="flex flex-col md:flex-row items-center gap-12 mb-20">
                    <div class="flex-1">
                        <h2 class="font-headline text-6xl font-black uppercase tracking-tighter leading-none mb-6">POR QUE ESCOLHER <br /><span class="text-primary">Heavy Rent?</span></h2>
                        <p class="font-body text-on-surface-variant text-lg max-w-xl leading-relaxed">
                            Criamos uma plataforma que reduz a distância entre demandas gigantes de construção e fornecedores de maquinário de elite. Eficiência está em nossas engrenagens.
                        </p>
                    </div>
                    <div class="flex-none hidden md:block">
                        <span class="material-symbols-outlined text-surface-container-highest text-[12rem]" style="font-variation-settings: 'wght' 200;">settings_input_component</span>
                    </div>
                </div>
                <div class="bento-grid h-[700px]">
                    <!-- Consumer Benefit 1 -->
                    <div class="col-span-12 md:col-span-8 bg-surface-container-high rounded-md p-10 flex flex-col justify-between group overflow-hidden relative">
                        <div class="relative z-10">
                            <span class="material-symbols-outlined text-primary text-5xl mb-6">security</span>
                            <h3 class="font-headline text-3xl font-black uppercase mb-4">Segurança Total</h3>
                            <p class="font-body text-on-surface-variant max-w-md">Cada contrato é garantido por seguro de nível Titan. Nosso sistema escrow libera seus recursos somente após entrega da máquina e confirmação no local.</p>
                        </div>
                        <div class="absolute right-0 bottom-0 opacity-10 group-hover:opacity-20 transition-opacity">
                            <span class="material-symbols-outlined text-[20rem]" style="font-variation-settings: 'FILL' 1;">shield_with_heart</span>
                        </div>
                    </div>
                    <!-- Provider Benefit 1 -->
                    <div class="col-span-12 md:col-span-4 bg-primary text-on-primary rounded-md p-10 flex flex-col justify-center">
                        <span class="material-symbols-outlined text-4xl mb-4">analytics</span>
                        <h3 class="font-headline text-2xl font-black uppercase mb-3">Crescimento do Fornecedor</h3>
                        <p class="font-body text-primary-fixed text-sm">Escalone seu negócio com análises de frota em tempo real e faturamento automatizado. Aumente a utilização das suas máquinas em 40%.</p>
                    </div>
                    <!-- Consumer Benefit 2 -->
                    <div class="col-span-12 md:col-span-4 bg-tertiary text-on-tertiary rounded-md p-10 flex flex-col justify-center">
                        <span class="material-symbols-outlined text-4xl mb-4">compare_arrows</span>
                        <h3 class="font-headline text-2xl font-black uppercase mb-3">Controle de Preço</h3>
                        <p class="font-body text-tertiary-fixed text-sm">Compare cotações em tempo real de fornecedores de ponta em todo o país. Ache o equilíbrio perfeito entre especificações técnicas e custo de locação.</p>
                    </div>
                    <!-- Provider Benefit 2 -->
                    <div class="col-span-12 md:col-span-8 bg-surface-container-low rounded-md p-10 flex items-center justify-between group">
                        <div class="max-w-sm">
                            <span class="material-symbols-outlined text-primary text-5xl mb-6">visibility</span>
                            <h3 class="font-headline text-3xl font-black uppercase mb-4">Visibilidade Global</h3>
                            <p class="font-body text-on-surface-variant">Liste sua frota em nossa rede nacional. Nosso algoritmo coloca suas máquinas na frente dos projetos que mais precisam delas.</p>
                        </div>
                        <div class="hidden lg:block w-48 h-48 rounded-full border-[20px] border-surface-container-highest animate-pulse"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- CTA Section -->
        <section class="py-24 bg-on-background text-surface relative overflow-hidden">
            <div class="absolute inset-0 z-0">
                <div class="absolute inset-0 bg-primary opacity-5 mix-blend-overlay"></div>
            </div>
            <div class="container mx-auto px-8 relative z-10 text-center">
                <h2 class="font-headline text-5xl md:text-7xl font-black uppercase tracking-tighter mb-10">PRONTO PARA CONSTRUIR?</h2>
                <div class="flex flex-col md:flex-row justify-center gap-6">
                    <button class="bg-primary text-on-primary font-headline font-bold uppercase px-12 py-5 text-lg rounded-sm hover:bg-primary-container transition-all hover:scale-105">Encontre uma Máquina</button>
                    <button class="border-2 border-surface text-surface font-headline font-bold uppercase px-12 py-5 text-lg rounded-sm hover:bg-surface hover:text-on-background transition-all hover:scale-105">Liste sua Frota</button>
                </div>
            </div>
        </section>
    </main>
    <footer id="footer"></footer>
    <script src="homefiller.js"></script>
    <script src="../generico/jsgenerico/frame.js"></script>

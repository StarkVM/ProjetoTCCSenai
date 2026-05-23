<!DOCTYPE html>

<html class="light" lang="pt-BR"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;family=Space+Grotesk:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<script id="tailwind-config">
      tailwind.config = {
        darkMode: "class",
        theme: {
          extend: {
            "colors": {
                    "primary-container": "#f9a825",
                    "on-secondary-container": "#5a666d",
                    "on-primary-fixed-variant": "#643f00",
                    "surface-variant": "#e5e2e1",
                    "tertiary": "#006687",
                    "on-surface": "#1c1b1b",
                    "on-primary": "#ffffff",
                    "background": "#fcf9f8",
                    "on-tertiary-fixed": "#001e2b",
                    "inverse-surface": "#313030",
                    "surface-dim": "#dcd9d9",
                    "primary": "#835400",
                    "surface-bright": "#fcf9f8",
                    "on-tertiary-container": "#004f69",
                    "outline-variant": "#d7c3ae",
                    "on-error-container": "#93000a",
                    "outline": "#857462",
                    "on-tertiary-fixed-variant": "#004d66",
                    "inverse-on-surface": "#f3f0ef",
                    "secondary": "#546067",
                    "on-primary-fixed": "#2a1800",
                    "inverse-primary": "#ffb957",
                    "on-tertiary": "#ffffff",
                    "surface-container-lowest": "#ffffff",
                    "surface-container-high": "#ebe7e7",
                    "error": "#ba1a1a",
                    "primary-fixed-dim": "#ffb957",
                    "surface-tint": "#835400",
                    "on-error": "#ffffff",
                    "surface-container-highest": "#e5e2e1",
                    "on-primary-container": "#674100",
                    "on-surface-variant": "#524434",
                    "secondary-fixed-dim": "#bbc8d0",
                    "primary-fixed": "#ffddb5",
                    "surface-container-low": "#f6f3f2",
                    "on-secondary-fixed-variant": "#3c494f",
                    "surface": "#fcf9f8",
                    "on-background": "#1c1b1b",
                    "tertiary-fixed-dim": "#71d2ff",
                    "error-container": "#ffdad6",
                    "secondary-container": "#d7e4ec",
                    "tertiary-fixed": "#c0e8ff",
                    "on-secondary": "#ffffff",
                    "secondary-fixed": "#d7e4ec",
                    "tertiary-container": "#2ac6ff",
                    "surface-container": "#f0edec",
                    "on-secondary-fixed": "#111d23"
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
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .machine-card-gradient {
            background: linear-gradient(180deg, rgba(28, 27, 27, 0) 0%, rgba(28, 27, 27, 0.4) 100%);
        }
        .btn-industrial {
            background: linear-gradient(to bottom right, #835400, #f9a825);
        }
    </style>
</head>
<body class="bg-background text-on-surface font-body selection:bg-primary-container">
    <header id="header"></header>
<!-- SideNavBar -->
<aside class="h-screen w-72 fixed left-0 top-0 bg-[#e5e2e1] dark:bg-zinc-900 flex flex-col py-8 px-6 z-50">
<div class="mb-12">
<h1 class="text-2xl font-black tracking-tighter text-[#1c1b1b] dark:text-zinc-100 font-headline uppercase">Heavy Rent</h1>
<p class="font-['Space_Grotesk'] uppercase tracking-tighter font-bold text-xs opacity-60 text-[#1c1b1b] dark:text-zinc-400">Portal do Vendedor</p>
</div>
<nav class="flex flex-col gap-2 flex-grow">
<!-- Active Navigation -->
<a class="flex items-center gap-4 py-3 px-4 transition-all duration-300 ease-in-out text-[#835400] dark:text-[#f9a825] border-r-[6px] border-[#835400] dark:border-[#f9a825] bg-white/50 dark:bg-black/20 font-headline uppercase tracking-tighter font-bold" href="#">
<span class="material-symbols-outlined" data-icon="inventory_2">inventory_2</span>
<span class="text-sm">Meus anúncios</span>
</a>
<!-- Inactive Navigations -->
<a class="flex items-center gap-4 py-3 px-4 transition-all duration-150 hover:bg-[#fcf9f8] dark:hover:bg-zinc-800 text-[#1c1b1b] dark:text-zinc-400 opacity-70 font-headline uppercase tracking-tighter font-bold" href="#">
<span class="material-symbols-outlined" data-icon="request_quote">request_quote</span>
<span class="text-sm">Minhas propostas</span>
</a>
<a class="flex items-center gap-4 py-3 px-4 transition-all duration-150 hover:bg-[#fcf9f8] dark:hover:bg-zinc-800 text-[#1c1b1b] dark:text-zinc-400 opacity-70 font-headline uppercase tracking-tighter font-bold" href="#">
<span class="material-symbols-outlined" data-icon="engineering">engineering</span>
<span class="text-sm">Aluguéis</span>
</a>
</nav>
<div class="mt-auto pt-8 border-t border-outline-variant/20 flex items-center gap-3">
<img alt="Foto de perfil do vendedor" class="w-10 h-10 rounded-md object-cover" data-alt="close-up headshot of a middle-aged professional man in a workshop setting with industrial equipment in background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBJqzNJk-MSaItidzw63eNTviRk-w62P5J8VFXeuyLREFx3vS9uP2fiF3UCGgJJTaGGE5cNX0kw0y4M27h0A2TKceORvPuXL7osgMtSNpI5fPShciRU2eUoxP675DbAmHz7y0wFMXT29yD4BxFKifwpgntNe9UsVarnfa6wsI3EUiuNDJwrz9EM2ieU7ZloT1tZG2e8S4Tb4bhaNcjp0RixCLQNvRLmJjbFxTUbYPmQfhE2STcllyKOp8NsxZJ_-MmOifSCbFefyziS"/>
<div>
<p class="text-sm font-bold font-headline">Arthur Titan</p>
<p class="text-xs opacity-60">Heavy Rent Ltda.</p>
</div>
</div>
</aside>
<!-- Main Content Area -->
<main class="ml-72 min-h-screen">
<!-- TopAppBar -->
<header class="fixed top-0 right-0 w-[calc(100%-18rem)] h-20 bg-[#fcf9f8]/80 dark:bg-zinc-950/80 backdrop-blur-md flex items-center justify-between px-10 z-40">
<div class="flex items-center bg-surface-container-low px-4 py-2 rounded-md w-96">
<span class="material-symbols-outlined text-outline" data-icon="search">search</span>
<input class="bg-transparent border-none focus:ring-0 text-sm font-body w-full" placeholder="Buscar em meus equipamentos..." type="text"/>
</div>
<div class="flex items-center gap-6">
<button class="relative p-2 hover:bg-black/5 dark:hover:bg-white/5 rounded-md transition-transform active:scale-95">
<span class="material-symbols-outlined text-on-surface" data-icon="notifications">notifications</span>
<span class="absolute top-2 right-2 w-2 h-2 bg-primary rounded-full"></span>
</button>
<button class="p-2 hover:bg-black/5 dark:hover:bg-white/5 rounded-md transition-transform active:scale-95">
<span class="material-symbols-outlined text-on-surface" data-icon="settings">settings</span>
</button>
</div>
</header>
<!-- Content Canvas -->
<div class="pt-32 px-10 pb-20">
<!-- Hero Title & Action -->
<div class="flex justify-between items-end mb-12">
<div class="max-w-2xl">
<p class="text-primary font-headline font-bold uppercase tracking-widest text-sm mb-2">Painel de Gestão</p>
<h2 class="text-6xl font-headline font-black tracking-tighter text-on-surface">Meus anúncios</h2>
</div>
<button class="btn-industrial text-white px-8 py-4 rounded-md font-headline font-bold uppercase tracking-tight flex items-center gap-3 shadow-xl shadow-primary/20 transition-transform active:scale-95">
<span class="material-symbols-outlined" data-icon="add" style="font-variation-settings: 'FILL' 1;">add</span>
                    Criar anúncio
                </button>
</div>
<!-- Dashboard Quick Stats (Asymmetric Layout) -->
<div class="grid grid-cols-12 gap-6 mb-16">
<div class="col-span-12 lg:col-span-8 bg-surface-container-low rounded-md p-8 flex justify-between items-center relative overflow-hidden">
<div class="relative z-10">
<p class="text-on-surface-variant font-label text-sm uppercase font-bold tracking-tight mb-1">Status de Frota</p>
<div class="flex items-baseline gap-2">
<span class="text-5xl font-headline font-black">24</span>
<span class="text-on-surface-variant font-headline font-medium">Equipamentos ativos</span>
</div>
</div>
<div class="flex gap-8 relative z-10">
<div class="text-right">
<p class="text-xs text-on-surface-variant uppercase font-bold">Em Aluguel</p>
<p class="text-2xl font-headline font-bold text-tertiary">18</p>
</div>
<div class="text-right">
<p class="text-xs text-on-surface-variant uppercase font-bold">Disponíveis</p>
<p class="text-2xl font-headline font-bold text-primary">06</p>
</div>
</div>
<!-- Decorative background element -->
<span class="absolute -bottom-10 -right-10 text-[12rem] font-black text-white/40 pointer-events-none font-headline">01</span>
</div>
<div class="col-span-12 lg:col-span-4 bg-primary text-on-primary rounded-md p-8">
<p class="font-label text-sm uppercase font-bold tracking-tight mb-4 opacity-80">Rendimento Mensal</p>
<p class="text-4xl font-headline font-black mb-2">R$ 142.500</p>
<div class="flex items-center gap-2 text-primary-fixed">
<span class="material-symbols-outlined text-sm" data-icon="trending_up">trending_up</span>
<span class="text-sm font-bold">+12% vs mês anterior</span>
</div>
</div>
</div>
<!-- Machinery Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
<!-- Card 1 -->
<div class="group bg-surface-container-lowest rounded-md overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-black/5">
<div class="h-64 relative overflow-hidden">
<img alt="Escavadeira Caterpillar 336" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" data-alt="Modern yellow Caterpillar 336 excavator working on a construction site with clean bright morning lighting and dusty atmosphere" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDW2ZTCt-AR9CcGjtEu3VVm9QAsL8bKSiF6gWCSEqGB3dd7pX9Dn8Ef9kJ8ttWuZtoKBBSViYvw6EKhl9A9naG3XeOOL_DzLdcz0c7OEJSWhdjWTJslirBrm7W-w60t8VbbhLF3ABdGMtLHKC7j12-p7MK2NgVbw677asjWtwVbdWExo57SiCC4sUbthqTFniqjYRZuiYjchdD4uipBX_c8fi23qtPRTSkoUJMm83jD_GiPlwIX9NWoPQO5THl1veUlTqWyRFMx1OgF"/>
<div class="absolute inset-0 machine-card-gradient"></div>
<div class="absolute top-4 right-4 bg-surface/90 backdrop-blur-sm px-3 py-1 rounded-md">
<p class="text-[10px] font-bold uppercase tracking-tighter text-primary">Disponível</p>
</div>
<div class="absolute bottom-4 left-4">
<h3 class="text-xl font-headline font-bold text-white tracking-tight">Escavadeira Caterpillar 336</h3>
</div>
</div>
<div class="p-6">
<p class="text-on-surface-variant text-sm mb-6 line-clamp-2">Ideal para projetos de grande escala, com tecnologia de ponta para eficiência de combustível e produtividade.</p>
<div class="grid grid-cols-2 gap-4 mb-8">
<div class="bg-surface-container-low p-3 rounded-md">
<p class="text-[10px] text-on-surface-variant uppercase font-bold mb-1">Por Hora</p>
<p class="text-lg font-headline font-black text-on-surface">R$ 450</p>
</div>
<div class="bg-surface-container-low p-3 rounded-md">
<p class="text-[10px] text-on-surface-variant uppercase font-bold mb-1">Por Dia</p>
<p class="text-lg font-headline font-black text-on-surface">R$ 3.200</p>
</div>
</div>
<div class="flex gap-2">
<button class="flex-1 py-3 px-4 border border-outline-variant/30 hover:bg-surface-container-low rounded-md transition-colors font-headline font-bold text-xs uppercase">Ver detalhes</button>
<button class="flex-1 py-3 px-4 bg-on-surface text-surface rounded-md transition-all hover:bg-on-surface-variant font-headline font-bold text-xs uppercase flex items-center justify-center gap-2">
<span class="material-symbols-outlined text-sm" data-icon="edit">edit</span>
                                Editar
                            </button>
</div>
</div>
</div>
<!-- Card 2 -->
<div class="group bg-surface-container-lowest rounded-md overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-black/5">
<div class="h-64 relative overflow-hidden">
<img alt="Guindaste Liebherr LTM 1100" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" data-alt="Heavy-duty mobile crane Liebherr LTM 1100 standing tall against a blue sky with architectural steel structures in the background" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCUrUgEb5xba3bBpr9HtTaYTWEX1CxeqXKHpEWNlf30zZngPwPLq6yfK-ud9vF4hr-VWtL5ZnmF4J6bRGf5kG9CNgSY8fqcH5t58m-FBFs0JfGkn39XAiAVtlSZNLTF8xe1IJGBPyCH8gbEyuITZ4XtajnZOQz4gkdpuTVyT-n_ycwa2UAAZFOrFnz6f6HBrKNXrWGLJhD4mVu0Rh16SykflQXhEHWerobt7VhRXCqucJyBQ1vS7EHjZSoMAE_KF2yVGg-745VUz4IL"/>
<div class="absolute inset-0 machine-card-gradient"></div>
<div class="absolute top-4 right-4 bg-tertiary/90 backdrop-blur-sm px-3 py-1 rounded-md">
<p class="text-[10px] font-bold uppercase tracking-tighter text-white">Em Aluguel</p>
</div>
<div class="absolute bottom-4 left-4">
<h3 class="text-xl font-headline font-bold text-white tracking-tight">Guindaste Liebherr LTM 1100</h3>
</div>
</div>
<div class="p-6">
<p class="text-on-surface-variant text-sm mb-6 line-clamp-2">Capacidade de 100 toneladas, ideal para montagens industriais complexas e içamentos técnicos.</p>
<div class="grid grid-cols-2 gap-4 mb-8">
<div class="bg-surface-container-low p-3 rounded-md">
<p class="text-[10px] text-on-surface-variant uppercase font-bold mb-1">Por Hora</p>
<p class="text-lg font-headline font-black text-on-surface">R$ 1.200</p>
</div>
<div class="bg-surface-container-low p-3 rounded-md">
<p class="text-[10px] text-on-surface-variant uppercase font-bold mb-1">Por Dia</p>
<p class="text-lg font-headline font-black text-on-surface">R$ 8.500</p>
</div>
</div>
<div class="flex gap-2">
<button class="flex-1 py-3 px-4 border border-outline-variant/30 hover:bg-surface-container-low rounded-md transition-colors font-headline font-bold text-xs uppercase">Ver detalhes</button>
<button class="flex-1 py-3 px-4 bg-on-surface text-surface rounded-md transition-all hover:bg-on-surface-variant font-headline font-bold text-xs uppercase flex items-center justify-center gap-2">
<span class="material-symbols-outlined text-sm" data-icon="edit">edit</span>
                                Editar
                            </button>
</div>
</div>
</div>
<!-- Card 3 -->
<div class="group bg-surface-container-lowest rounded-md overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-black/5 border-dashed border-2 border-outline-variant/30 flex flex-col items-center justify-center p-8 text-center min-h-[500px]">
<div class="w-16 h-16 bg-surface-container-low rounded-full flex items-center justify-center mb-6 group-hover:bg-primary-fixed transition-colors">
<span class="material-symbols-outlined text-3xl text-outline group-hover:text-primary" data-icon="add_circle">add_circle</span>
</div>
<h3 class="text-2xl font-headline font-black tracking-tight mb-2">Adicionar novo equipamento</h3>
<p class="text-on-surface-variant text-sm mb-8">Amplie sua frota visível e aumente seu faturamento mensal.</p>
<button class="bg-on-surface text-surface px-6 py-3 rounded-md font-headline font-bold uppercase text-xs tracking-wider transition-transform active:scale-95">Começar agora</button>
</div>
<!-- Card 4 -->
<div class="group bg-surface-container-lowest rounded-md overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-black/5">
<div class="h-64 relative overflow-hidden">
<img alt="Rolo Compactador Dynapac CC4200" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" data-alt="Industrial asphalt roller machine on a newly paved road during sunset with warm lens flare and sharp focus on the heavy metal drum" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCVEZevGWIoeZZw30uYlHE4UiImg-WEkRjTUJFSKryMmYsrFKosOiN56uWJPcm6ANiiT-lnfpSsVm_-YE4dF_ximn4oQoFvozayjG8tgOPuIgEn4_ri-X8TETiITdBJ_6UVGQNInnH6wb1SKxHLO_z_dUGDBmNAWCFs43QBpaRgLSOwsqSQRkXv8CyG1aTXQ_Y5CAP52zje-Gd-qA8dDFPF0rsmQtFiEBFoSMwY5Vp0frkGhzdLzrS2MhUAIGUvFV_-NDpDdN7LDkiP"/>
<div class="absolute inset-0 machine-card-gradient"></div>
<div class="absolute top-4 right-4 bg-surface/90 backdrop-blur-sm px-3 py-1 rounded-md">
<p class="text-[10px] font-bold uppercase tracking-tighter text-primary">Disponível</p>
</div>
<div class="absolute bottom-4 left-4">
<h3 class="text-xl font-headline font-bold text-white tracking-tight">Rolo Compactador Dynapac CC4200</h3>
</div>
</div>
<div class="p-6">
<p class="text-on-surface-variant text-sm mb-6 line-clamp-2">Compactador de solo de alta performance para pavimentação asfáltica e bases de solo granular.</p>
<div class="grid grid-cols-2 gap-4 mb-8">
<div class="bg-surface-container-low p-3 rounded-md">
<p class="text-[10px] text-on-surface-variant uppercase font-bold mb-1">Por Hora</p>
<p class="text-lg font-headline font-black text-on-surface">R$ 380</p>
</div>
<div class="bg-surface-container-low p-3 rounded-md">
<p class="text-[10px] text-on-surface-variant uppercase font-bold mb-1">Por Dia</p>
<p class="text-lg font-headline font-black text-on-surface">R$ 2.450</p>
</div>
</div>
<div class="flex gap-2">
<button class="flex-1 py-3 px-4 border border-outline-variant/30 hover:bg-surface-container-low rounded-md transition-colors font-headline font-bold text-xs uppercase">Ver detalhes</button>
<button class="flex-1 py-3 px-4 bg-on-surface text-surface rounded-md transition-all hover:bg-on-surface-variant font-headline font-bold text-xs uppercase flex items-center justify-center gap-2">
<span class="material-symbols-outlined text-sm" data-icon="edit">edit</span>
                                Editar
                            </button>
</div>
</div>
</div>
<!-- Card 5 -->
<div class="group bg-surface-container-lowest rounded-md overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-black/5">
<div class="h-64 relative overflow-hidden">
<img alt="Pá Carregadeira Volvo L120H" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" data-alt="Heavy Volvo front loader machine moving gravel in a stone quarry under overcast sky with realistic mechanical details" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB1Sd6qE2zcdPZMYDDDmL6J98Djwyo56ZtU_5Gn9yK2HY7L2niOEpcjHu94WV_3y2P_1hx3ibrcmP6dijNAxvwVv6LOIpgAdZ63Gx__SxiWrbmbH1eusZS2WAV9ZcGDnhFwZGkxfgLLC5L-es2zf8epH3C0J2F9K8ns25enWQAP7s7wMvDIqyCXYvY3TxUzIq99jEW6ulXBQ0JewDnjA35YBdQLirQNP1L0UzHIIF2TCX2xJf58eect-DdhwsyBufiW5bZvt1VAiaf4"/>
<div class="absolute inset-0 machine-card-gradient"></div>
<div class="absolute top-4 right-4 bg-tertiary/90 backdrop-blur-sm px-3 py-1 rounded-md">
<p class="text-[10px] font-bold uppercase tracking-tighter text-white">Em Aluguel</p>
</div>
<div class="absolute bottom-4 left-4">
<h3 class="text-xl font-headline font-bold text-white tracking-tight">Pá Carregadeira Volvo L120H</h3>
</div>
</div>
<div class="p-6">
<p class="text-on-surface-variant text-sm mb-6 line-clamp-2">Versatilidade absoluta para movimentação de materiais, carregamento de caminhões e terraplanagem.</p>
<div class="grid grid-cols-2 gap-4 mb-8">
<div class="bg-surface-container-low p-3 rounded-md">
<p class="text-[10px] text-on-surface-variant uppercase font-bold mb-1">Por Hora</p>
<p class="text-lg font-headline font-black text-on-surface">R$ 520</p>
</div>
<div class="bg-surface-container-low p-3 rounded-md">
<p class="text-[10px] text-on-surface-variant uppercase font-bold mb-1">Por Dia</p>
<p class="text-lg font-headline font-black text-on-surface">R$ 3.800</p>
</div>
</div>
<div class="flex gap-2">
<button class="flex-1 py-3 px-4 border border-outline-variant/30 hover:bg-surface-container-low rounded-md transition-colors font-headline font-bold text-xs uppercase">Ver detalhes</button>
<button class="flex-1 py-3 px-4 bg-on-surface text-surface rounded-md transition-all hover:bg-on-surface-variant font-headline font-bold text-xs uppercase flex items-center justify-center gap-2">
<span class="material-symbols-outlined text-sm" data-icon="edit">edit</span>
                                Editar
                            </button>
</div>
</div>
</div>
</div>
</div>
</main>
<footer id="footer"></footer>
<script src="../generico/jsgenerico/frame.js"></script>
</body></html>

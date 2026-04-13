<?php

$error = $_GET['er'] ?? 404;

?>


<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<link href="https://fonts.googleapis.com" rel="preconnect"/>
<link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect"/>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800;900&amp;family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
        vertical-align: middle;
      }
      .brutal-shadow {
        box-shadow: 12px 12px 0px 0px rgba(28, 27, 27, 0.05);
      }
      .btn-gradient {
        background: linear-gradient(135deg, #835400 0%, #f9a825 100%);
      }
    </style>
</head>
<body class="bg-background font-body text-on-surface overflow-x-hidden min-h-screen flex flex-col">
<!-- TopNavBar: Execution of Shared Component JSON -->
<!-- Shell Visibility & Relevance: TopNavBar included as standard global anchor -->
<header class="fixed top-0 w-full z-50 bg-[#fcf9f8]/80 dark:bg-[#1c1b1b]/80 backdrop-blur-md">
<nav class="flex justify-between items-center px-8 py-4 w-full max-w-full mx-auto">
<div class="flex items-center gap-8">
<a class="text-2xl font-black italic tracking-tighter text-[#1c1b1b] dark:text-[#fcf9f8]" href="#">HEAVY_EQUIP</a>
<div class="hidden lg:flex gap-6">
<a class="font-['Space_Grotesk'] tracking-tight text-sm uppercase font-bold text-[#1c1b1b] dark:text-[#fcf9f8] opacity-60 hover:opacity-100 hover:text-[#835400] transition-all duration-300" href="#">Fleet</a>
<a class="font-['Space_Grotesk'] tracking-tight text-sm uppercase font-bold text-[#1c1b1b] dark:text-[#fcf9f8] opacity-60 hover:opacity-100 hover:text-[#835400] transition-all duration-300" href="#">Projects</a>
<a class="font-['Space_Grotesk'] tracking-tight text-sm uppercase font-bold text-[#1c1b1b] dark:text-[#fcf9f8] opacity-60 hover:opacity-100 hover:text-[#835400] transition-all duration-300" href="#">About</a>
<a class="font-['Space_Grotesk'] tracking-tight text-sm uppercase font-bold text-[#1c1b1b] dark:text-[#fcf9f8] opacity-60 hover:opacity-100 hover:text-[#835400] transition-all duration-300" href="#">Support</a>
</div>
</div>
<div class="flex items-center gap-4">
<button class="font-['Space_Grotesk'] tracking-tight text-sm uppercase font-bold text-[#1c1b1b] dark:text-[#fcf9f8] hover:text-[#835400] transition-all">Contact</button>
<button class="bg-[#835400] text-white px-6 py-2 font-['Space_Grotesk'] tracking-tight text-sm uppercase font-bold hover:scale-95 duration-75">Login</button>
</div>
</nav>
<div class="bg-[#e5e2e1] dark:bg-[#2d2c2c] h-[1px] w-full"></div>
</header>
<main class="flex-grow flex items-center justify-center pt-24 px-6 md:px-12 relative overflow-hidden">
<!-- Background Elements: Asymmetric Layers -->
<div class="absolute top-1/4 -right-20 w-[500px] h-[500px] bg-primary-container opacity-5 rounded-full blur-[120px]"></div>
<div class="absolute bottom-1/4 -left-20 w-[300px] h-[300px] bg-tertiary opacity-5 rounded-full blur-[80px]"></div>
<div class="container max-w-7xl mx-auto flex flex-col lg:flex-row items-center gap-12 relative z-10">
<!-- Content Column -->
<div class="w-full lg:w-1/2 text-center lg:text-left order-2 lg:order-1">
<div class="inline-flex items-center gap-2 bg-surface-container-high px-4 py-2 rounded-sm mb-6">
<span class="material-symbols-outlined text-primary text-xl" style="font-variation-settings: 'FILL' 1;">warning</span>
<span class="font-headline font-bold text-xs uppercase tracking-widest text-on-surface-variant">Maintenance Required</span>
</div>
<h1 class="font-headline text-8xl md:text-[10rem] font-black text-on-surface leading-[0.8] mb-8 tracking-tighter opacity-10">
                    <?php if(isset($error)) echo $error?>
                </h1>
<div class="relative -mt-16 md:-mt-24 mb-12">
<h2 class="font-headline text-4xl md:text-6xl font-extrabold text-on-surface leading-tight">
                        System <span class="text-primary italic">Anomaly</span> Detected
                    </h2>
<p class="font-body text-xl text-on-surface-variant mt-6 max-w-lg mx-auto lg:mx-0">
                        The resource you are attempting to retrieve is currently unavailable or has been decommissioned from the fleet.
                    </p>
</div>
<div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
<a class="btn-gradient px-8 py-4 text-on-primary font-headline font-bold uppercase tracking-widest text-sm flex items-center justify-center gap-3 active:scale-95 transition-all brutal-shadow" href="#">
<span class="material-symbols-outlined">home_work</span>
                        Return to Headquarters
                    </a>
<a class="bg-surface-container-highest px-8 py-4 text-on-surface font-headline font-bold uppercase tracking-widest text-sm flex items-center justify-center gap-3 hover:bg-surface-container-high transition-all" href="#">
<span class="material-symbols-outlined">support_agent</span>
                        Contact Terminal
                    </a>
</div>
<!-- Technical Specs Display -->
<div class="mt-16 grid grid-cols-2 gap-8 border-t border-outline-variant/20 pt-8 opacity-60">
<div>
<p class="font-headline text-[10px] uppercase tracking-widest text-primary font-bold">Error Protocol</p>
<p class="font-headline text-lg font-bold">X-J88-MISSING</p>
</div>
<div>
<p class="font-headline text-[10px] uppercase tracking-widest text-primary font-bold">Terminal ID</p>
<p class="font-headline text-lg font-bold">SITE-04-A</p>
</div>
</div>
</div>
<!-- Graphic Column -->
<div class="w-full lg:w-1/2 order-1 lg:order-2">
<div class="relative aspect-square max-w-[500px] mx-auto">
<!-- Layered Image Effect -->
<div class="absolute inset-0 bg-surface-container-low translate-x-4 translate-y-4"></div>
<div class="absolute inset-0 overflow-hidden brutal-shadow">
<img alt="Broken heavy machinery" class="w-full h-full object-cover grayscale contrast-125 mix-blend-multiply opacity-80" data-alt="Close-up of industrial heavy machinery with visible hydraulic failure, oil leaks, and metal distress in a brutalist warehouse setting with dramatic lighting" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCdhCcHQT71GOtmAx7XZbeu9aNAmgphla2b-slo2AgkIbj-HCkCo0YP_rvygptEEBZ-nHyKKZqyrzEblVuefZyaNBQUlw7qwfuC3lfZ_NcXeMyWzbvF0np_HP4Trh4J6K6D9wTrV4NrKVddkvT0kRVPgIonESnEEkrkoxA8ntlEmN9A6FyfKNneSXX5MR9GsdSbG9HzzJo-s2AbgMcomVX7uR8eBS4VSgmOTUyJzsGikRmIvyTJE-3xetMFgnAuQw925iLJg1slo07w"/>
<!-- Caution Overlay -->
<div class="absolute top-0 left-0 w-full h-full bg-primary/20 pointer-events-none"></div>
<!-- Diagonal Stripes -->
<div class="absolute -bottom-10 -right-10 w-48 h-12 bg-primary-container -rotate-45 flex items-center justify-center overflow-hidden">
<div class="w-full h-full bg-[repeating-linear-gradient(45deg,transparent,transparent_10px,#000_10px,#000_20px)] opacity-20"></div>
</div>
</div>
<!-- Floating Indicator -->
<div class="absolute -top-6 -left-6 bg-surface-container-lowest p-6 brutal-shadow border-l-4 border-primary">
<span class="material-symbols-outlined text-4xl text-primary" style="font-variation-settings: 'FILL' 1;">construction</span>
<p class="font-headline text-xs font-black uppercase mt-2">Link Breached</p>
</div>
</div>
</div>
</div>
</main>
<!-- Footer: Execution of Shared Component JSON -->
<footer class="w-full border-t border-[#f9a825]/20 bg-[#1c1b1b] dark:bg-[#000000]">
<div class="flex flex-col md:flex-row justify-between items-center px-12 py-10 w-full">
<div class="mb-6 md:mb-0">
<p class="font-['Inter'] text-[10px] uppercase tracking-[0.2em] text-[#fcf9f8]/40">
                    ©2024 HEAVY INDUSTRIES. PRECISION BRUTALISM SYSTEMS.
                </p>
</div>
<div class="flex flex-wrap justify-center gap-8">
<a class="font-['Inter'] text-[10px] uppercase tracking-[0.2em] text-[#fcf9f8]/40 hover:text-[#fcf9f8] transition-colors" href="#">Terms of Service</a>
<a class="font-['Inter'] text-[10px] uppercase tracking-[0.2em] text-[#fcf9f8]/40 hover:text-[#fcf9f8] transition-colors" href="#">Machine Ethics</a>
<a class="font-['Inter'] text-[10px] uppercase tracking-[0.2em] text-[#fcf9f8]/40 hover:text-[#fcf9f8] transition-colors" href="#">Safety Protocols</a>
<a class="font-['Inter'] text-[10px] uppercase tracking-[0.2em] text-[#fcf9f8]/40 hover:text-[#fcf9f8] transition-colors" href="#">Contact Terminal</a>
</div>
</div>
</footer>
</body></html>
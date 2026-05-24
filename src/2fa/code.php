<?php

session_start();

$er = $_GET['er'] ?? null;

if(isset($er) && !empty($er))
{
    if($er == "1") $responseError = "Não foi possível verificar o código informado.";
    else if($er == "2") $responseError = "Erro ao validar os dados.";
    else $responseError = "Ocorreu um erro. Tente novamente.";
}
?>

<!DOCTYPE html>

<html class="light" lang="pt-BR">

<head>

<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>

<title>Heavy Rent</title>

<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>

<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

<script id="tailwind-config">

tailwind.config = {
    darkMode: "class",

    theme: {
        extend: {

            colors: {

                "outline-variant": "#d7c3ae",
                "on-surface": "#1c1b1b",
                "background": "#fcf9f8",
                "surface-container": "#f0edec",
                "surface-variant": "#e5e2e1",
                "surface-container-lowest": "#ffffff",
                "surface-container-highest": "#e5e2e1",
                "on-surface-variant": "#5f5f5f",
                "primary-container": "#f9a825",
                "primary": "#835400",
                "surface": "#fcf9f8",
                "outline": "#857462",
                "surface-container-high": "#ebe7e7"

            },

            borderRadius: {
                "DEFAULT": "0.125rem",
                "lg": "0.25rem",
                "xl": "0.5rem",
                "full": "0.75rem"
            },

            fontFamily: {
                "headline": ["Space Grotesk"],
                "body": ["Inter"],
                "label": ["Inter"]
            }

        }
    }
}

</script>

<style>

.material-symbols-outlined {
    font-variation-settings:
    'FILL' 1,
    'wght' 400,
    'GRAD' 0,
    'opsz' 24;
}

.signature-gradient {
    background: linear-gradient(135deg, #835400 0%, #f9a825 100%);
}

</style>

</head>

<body class="bg-background font-body text-on-surface antialiased">
<header id="header"></header>
<main class="min-h-screen grid grid-cols-1 md:grid-cols-2">

    <!-- ESQUERDA -->
    <section class="hidden md:flex relative items-end p-12 overflow-hidden bg-black">

        <!-- IMAGEM -->
        <img


    src="https://images.unsplash.com/photo-1629807473015-41699c4471b5?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
    class="absolute inset-0 w-full h-full object-cover opacity-70"

        />

        <!-- OVERLAY -->
        <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-black/10"></div>

        <!-- CONTEÚDO -->
        <div class="relative z-10 max-w-lg">

            <div class="mb-8">

                <span class="text-primary-container font-headline font-black italic tracking-tighter text-5xl block mb-4">
                    Heavy Rent
                </span>

                <div class="h-1 w-24 bg-primary-container rounded-full"></div>

            </div>

        </div>

    </section>

    <!-- DIREITA -->
    <section class="bg-surface flex items-center justify-center p-8 md:p-16 relative">

        <!-- MOBILE -->
        <div class="absolute top-8 left-8 md:hidden">

            <span class="text-on-surface font-headline font-black italic tracking-tighter text-2xl">
                Heavy Rent
            </span>

        </div>

        <div class="w-full max-w-md">

            <!-- TOPO -->
            <div class="mb-12">

                <div class="inline-flex items-center justify-center w-16 h-16 bg-surface-container-highest mb-6 rounded-xl">

                    <span class="material-symbols-outlined text-primary text-3xl">
                        shield
                    </span>

                </div>

                <h2 class="font-headline text-3xl font-bold tracking-tight text-on-surface mb-3 uppercase">
                    Verificação
                </h2>

                <p class="text-on-surface-variant text-sm leading-relaxed">

                    Digite o código enviado para o email
                    <b>
                        <?php echo $_SESSION['email'] ?? "EMAIL NÃO CARREGADO"; ?>
                    </b>

                </p>

            </div>

            <!-- FORM -->
            <form class="space-y-8" method="post" action="2fa.php">

                <div>

                    <label class="block font-headline text-[11px] uppercase tracking-[0.2em] font-bold text-on-surface-variant mb-4">
                        Código de Verificação
                    </label>

                    <div class="flex gap-2 sm:gap-3">

                        <input
                            name="codigoChar1"
                            maxlength="1"
                            type="text"
                            placeholder="0"
                            class="w-full aspect-square text-center font-headline text-2xl font-bold bg-surface-container-lowest border border-surface-container-high rounded-xl text-on-surface focus:ring-2 focus:ring-primary shadow-inner"
                        />

                        <input
                            name="codigoChar2"
                            maxlength="1"
                            type="text"
                            placeholder="0"
                            class="w-full aspect-square text-center font-headline text-2xl font-bold bg-surface-container-lowest border border-surface-container-high rounded-xl text-on-surface focus:ring-2 focus:ring-primary shadow-inner"
                        />

                        <input
                            name="codigoChar3"
                            maxlength="1"
                            type="text"
                            placeholder="0"
                            class="w-full aspect-square text-center font-headline text-2xl font-bold bg-surface-container-lowest border border-surface-container-high rounded-xl text-on-surface focus:ring-2 focus:ring-primary shadow-inner"
                        />

                        <input
                            name="codigoChar4"
                            maxlength="1"
                            type="text"
                            placeholder="0"
                            class="w-full aspect-square text-center font-headline text-2xl font-bold bg-surface-container-lowest border border-surface-container-high rounded-xl text-on-surface focus:ring-2 focus:ring-primary shadow-inner"
                        />

                        <input
                            name="codigoChar5"
                            maxlength="1"
                            type="text"
                            placeholder="0"
                            class="w-full aspect-square text-center font-headline text-2xl font-bold bg-surface-container-lowest border border-surface-container-high rounded-xl text-on-surface focus:ring-2 focus:ring-primary shadow-inner"
                        />

                        <input
                            name="codigoChar6"
                            maxlength="1"
                            type="text"
                            placeholder="0"
                            class="w-full aspect-square text-center font-headline text-2xl font-bold bg-surface-container-lowest border border-surface-container-high rounded-xl text-on-surface focus:ring-2 focus:ring-primary shadow-inner"
                        />

                    </div>

                </div>

                <!-- ERRO -->
                <p id="erro" class="text-red-600 text-sm font-medium">
                    <?php if(isset($responseError)) echo $responseError ?>
                </p>

                <!-- BOTÃO -->
                <button
                    name="verificar"
                    class="w-full signature-gradient text-white py-4 font-headline font-bold uppercase tracking-widest text-sm rounded-xl shadow-lg active:scale-[0.98] transition-transform flex items-center justify-center gap-2"
                >

                    Verificar Código

                    <span class="material-symbols-outlined text-lg">
                        verified_user
                    </span>

                </button>

                <!-- AÇÕES -->
                <div class="flex items-center justify-between pt-2">

                    <button
                        type="button"
                        class="text-on-surface-variant font-label text-[11px] uppercase tracking-widest hover:text-primary transition-colors flex items-center gap-2"
                    >

                        <span class="material-symbols-outlined text-sm">
                            refresh
                        </span>

                        Reenviar Código

                    </button>

                </div>

            </form>

        
        </div>
        <!-- ÍCONE DECORATIVO -->
        <div class="absolute bottom-4 right-4 opacity-10 pointer-events-none hidden lg:block">

            <span class="material-symbols-outlined text-[120px]" style="font-variation-settings: 'wght' 100;">
                lock
            </span>

        </div>

    </section>

</main>
<footer id="footer"></footer>
<script src="../generico/jsgenerico/frame.js"></script>
</body>

</html>
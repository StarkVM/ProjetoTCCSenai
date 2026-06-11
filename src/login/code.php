<?php
require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTCCSenai/src/config/session.php';

if (isset($_SESSION["logado"]) && $_SESSION["logado"] == true) {
    header("Location: /ProjetoTCCSenai/src/home/code.php");
    exit();
}
$er = $_GET['er'] ?? null;
if (isset($er) && !empty($er)) {
    if ($er == "1")
        $responseError = "Não foi possivel completar o login!";
    else if ($er == "2")
        $responseError = "Ocorreu um erro ao efetuar o login, verifique os dados e tente novamente.";
    else if ($er == "3")
        $responseError = "A senha informada precisa ter no mínimo 8 caracteres!";
    else
        $responseError = "Houve um erro ao processar os dados! Por favor, tente novamente.";
}
?>


<!DOCTYPE html>

<html class="light" lang="pt-BR">

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
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
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
    <header id="header"></header>
    <main class="min-h-screen flex items-center justify-center relative overflow-hidden px-4">
        <!-- Background Decorative Elements -->
        <div class="absolute inset-0 industrial-grid opacity-40 pointer-events-none"></div>
        <div
            class="absolute top-0 right-0 w-full h-full hidden lg:block opacity-10 pointer-events-none grayscale contrast-125">
            <img class="w-full h-full "
                data-alt="high-contrast monochromatic close-up of heavy duty construction crane gears and hydraulic pistons with clean industrial lines"
                src="https://lh3.googleusercontent.com/aida-public/AB6AXuCEsC6amGXv6pFd4VpTR3Cq3Pr2Rm21kYtmmavrIaScfMESq9aiBGfPg4MHJL_925YZVOY93lJxmRrrBYQ0knD8_XP2gtkV8uEpIJHhF4ukTCC6XrvA9VkvpKjd5iBKrCVShRatUq5PwolCTe-A3a6c82SqBkC0HBgPfPzcNnu3X4b_k5mjecL3wCVH5Zk8HNKApQLrMHZUPPM4aHuMQEsJNLTh1kT0rjhq3algKVeS9limikHhxMFaTo-wkV-PynhpU5in66BgElW5" />
        </div>
        <!-- Login Container -->
        <div class="w-full max-w-[1200px] grid grid-cols-1 lg:grid-cols-12 gap-0 relative z-10">
            <!-- Left Branding Side -->
            <div
                class="lg:col-span-5 bg-on-surface p-12 flex flex-col justify-center items-center rounded-l-lg lg:rounded-r-none">
                <div>
                    <h1
                        class="font-headline font-black text-4xl tracking-tighter text-surface uppercase leading-none mb-4">
                        <img src="../img/Heavyrentlogo.png" width="285px" alt="">
                    </h1>
                    <div class="h-1 w-19 bg-primary mb-8"></div>
                    <p class="font-headline text-2xl font-light text-surface-container tracking-tight leading-snug">
                        JUNTE-SE AO HEAVYTEAM! <br />

                    </p>
                </div>
                <div class="mt-20">
                    <div class="flex items-center gap-4 mb-6">
                        <div
                            class="w-12 h-12 flex items-center justify-center bg-surface-container-highest/10 rounded-sm">
                            <span class="material-symbols-outlined text-primary"
                                style="font-variation-settings: 'FILL' 1;">precision_manufacturing</span>
                        </div>
                        <div>
                            <p class="font-headline text-xs font-bold text-surface-variant uppercase tracking-widest">
                                Locação de máquinas pesadas</p>
                            <p class="text-surface-container-low text-sm font-light">Acesse especificações de maquinário
                                profissional e agendamento de locações.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right Form Side -->
            <div
                class="lg:col-span-7 bg-surface-container-lowest p-8 md:p-16 rounded-r-lg lg:rounded-l-none border-y lg:border-y-0 lg:border-r border-surface-container-highest">
                <div class=" max-w-md mx-auto">
                    <div class="mb-12">
                        <h2 class="font-headline text-3xl font-bold text-on-surface tracking-tight mb-2">Entrar</h2>
                        <p class="text-on-surface-variant text-sm uppercase tracking-widest font-semibold">Portal de
                            Clientes Industriais</p>
                    </div>
                    <form class="space-y-6" method="post" action="login.php">
                        <!-- Email Field -->
                        <div class="space-y-2">
                            <label
                                class="font-headline text-xs font-bold text-on-surface uppercase tracking-widest flex items-center gap-2"
                                for="email">
                                <span class="material-symbols-outlined text-[16px]">alternate_email</span>
                                Email
                            </label>
                            <input
                                class="w-full bg-surface-container-low border-none rounded-sm px-4 py-4 font-headline text-base focus:ring-2 focus:ring-primary transition-all placeholder:text-outline/50"
                                id="email" name="email" placeholder="lorranbobo@heavyteam.com" required="" type="email"
                                value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" />
                        </div>
                        <!-- Password Field -->
                        <div class="space-y-2">
                            <div class="flex justify-between items-end">
                                <label
                                    class="font-headline text-xs font-bold text-on-surface uppercase tracking-widest flex items-center gap-2"
                                    for="password">
                                    <span class="material-symbols-outlined text-[16px]">lock_open</span>
                                    Senha
                                </label>
                                <a class="font-headline text-[10px] font-bold text-primary uppercase tracking-widest hover:text-on-primary-container transition-colors"
                                    href="../NovaSenha/code.php">
                                    Esqueceu a senha?
                                </a>
                            </div>
                            <div class="relative">
                                <input
                                    class="w-full bg-surface-container-low border-none rounded-sm px-4 py-4 pr-14 font-headline text-base focus:ring-2 focus:ring-primary transition-all placeholder:text-outline/50"
                                    id="password" name="senha" placeholder="••••••••••••" required type="password" />

                                <button type="button" onclick="togglePassword()"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-outline hover:text-primary transition-colors">
                                    <span id="eyeIcon" class="material-symbols-outlined">
                                        visibility
                                    </span>
                                </button>
                            </div>
                        </div>

                        <!-- Login Button -->

                        <?php if (isset($responseError)): ?>
                            <div id="erro"
                                class="flex items-center justify-center gap-2 bg-red-50 border border-red-200 text-red-700 text-xs font-bold uppercase tracking-wide px-4 py-3 rounded-sm">
                                <span class="material-symbols-outlined text-sm">error</span>
                                <?= $responseError ?>
                            </div>
                        <?php endif; ?>
                        <div class="pt-4">
                            <button name="loginEntrar"
                                class="group relative w-full bg-primary hover:bg-on-primary-container text-on-primary font-headline font-black text-sm uppercase tracking-[0.2em] py-5 rounded-sm transition-all duration-300 flex items-center justify-center gap-3 overflow-hidden"
                                type="submit">
                                <div
                                    class="absolute inset-0  bg-primary-container opacity-100 group-hover:opacity-50 transition-opacity">
                                </div>
                                <span class="relative z-10">ENTRAR</span>
                                <span
                                    class="material-symbols-outlined relative z-10 text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                            </button>
                        </div>
                    </form>
                    <!-- Footer / Signup -->
                    <div
                        class="mt-12 pt-8 border-t border-surface-container-highest flex flex-col sm:flex-row justify-between items-center gap-4">
                        <p class="font-label text-xs text-on-surface-variant uppercase tracking-widest">
                            Ainda não possui conta?
                        </p>
                        <a class="font-headline text-xs font-bold text-on-surface uppercase tracking-[0.1em] px-6 py-2 border border-outline-variant hover:bg-surface-container-high transition-colors rounded-sm"
                            href="../cadastro/code.php">
                            Criar Conta
                        </a>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </main>
    <!-- Simple Footer (using style tokens from JSON) -->
    <footer id="footer"></footer>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.textContent = 'visibility_off';
            } else {
                passwordInput.type = 'password';
                eyeIcon.textContent = 'visibility';
            }
        }
    </script>
    <script src="../generico/jsgenerico/frame.js?v=vendor-modal-4"></script>
</body>

</html>
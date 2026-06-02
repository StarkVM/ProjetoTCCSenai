<?php
$alugueis = [
    '1' => [
        'titulo' => 'Retroescavadeira CAT 320',
        'periodo' => '12 fev 2026 – 18 fev 2026',
        'cliente' => 'Obras & Concretos S/A',
        'local' => 'Zona Sul, São Paulo',
        'valor' => 'R$ 8.400',
        'status' => 'Concluído',
        'descricao' => 'Equipamento entregue no prazo e devolvido sem avarias. Cliente finalizou obra de terraplanagem.'
    ],
    '2' => [
        'titulo' => 'Perfuratriz DTH 20',
        'periodo' => '02 mar 2026 – 10 mar 2026',
        'cliente' => 'Engenharia Nova Era',
        'local' => 'Guarulhos, SP',
        'valor' => 'R$ 11.200',
        'status' => 'Concluído',
        'descricao' => 'Aluguel utilizado em projeto de infraestrutura. Entrega e retirada dentro do cronograma.'
    ],
    '3' => [
        'titulo' => 'Vibroacabadora Volvo ABG 2820',
        'periodo' => '20 abr 2026 – 30 abr 2026',
        'cliente' => 'Estradas Brasil',
        'local' => 'Campinas, SP',
        'valor' => 'R$ 9.750',
        'status' => 'Concluído',
        'descricao' => 'Equipamento usado em recapeamento de pista. Não foram registradas falhas no equipamento.'
    ]
];

$id = $_GET['id'] ?? null;
$item = $id && isset($alugueis[$id]) ? $alugueis[$id] : null;
?>
<!DOCTYPE html>
<html class="light" lang="pt-BR">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link href="https://fonts.googleapis.com" rel="preconnect" />
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;family=Space+Grotesk:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
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

        .btn-industrial {
            background: linear-gradient(to bottom right, #835400, #f9a825);
        }
    </style>
</head>

<body class="bg-background text-on-surface font-body selection:bg-primary-container">
    <header id="header"></header>
    <main class="min-h-screen py-10">
        <div class="max-w-6xl mx-auto px-6 lg:px-10">
            <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl lg:text-4xl font-headline font-black uppercase tracking-tighter">Detalhes do aluguel</h1>
                    <p class="text-xs font-bold text-primary tracking-[0.2em] uppercase mt-1">Histórico de aluguéis</p>
                </div>
                <button onclick="window.location.href='code.php'" class="btn-industrial px-6 py-3 text-white rounded-md font-headline font-bold uppercase text-xs tracking-wide shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-transform">
                    Voltar ao painel
                </button>
            </div>

            <?php if ($item): ?>
                <div class="bg-surface-container-lowest rounded-3xl border border-outline-variant/10 p-8 shadow-sm">
                    <div class="mb-6 flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                        <div>
                            <span class="text-[10px] uppercase font-bold opacity-40 tracking-widest">Status</span>
                            <h2 class="text-2xl font-headline font-black uppercase mt-2"><?= $item['status'] ?></h2>
                        </div>
                        <div class="rounded-full bg-surface-container-high px-4 py-2 text-[11px] font-bold uppercase text-primary">
                            <?= $item['periodo'] ?>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[1.5fr_1fr]">
                        <div class="space-y-6">
                            <div class="rounded-3xl bg-white p-6 border border-outline-variant/10 shadow-sm">
                                <p class="text-[10px] uppercase font-bold opacity-50 tracking-widest mb-3">Equipamento</p>
                                <p class="text-xl font-headline font-black uppercase"><?= $item['titulo'] ?></p>
                            </div>

                            <div class="rounded-3xl bg-white p-6 border border-outline-variant/10 shadow-sm">
                                <p class="text-[10px] uppercase font-bold opacity-50 tracking-widest mb-3">Descrição</p>
                                <p class="text-sm leading-relaxed text-on-surface/80"><?= $item['descricao'] ?></p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="rounded-3xl bg-surface-container-low p-6 border border-outline-variant/10">
                                <p class="text-[10px] uppercase font-bold opacity-50 tracking-widest mb-3">Cliente</p>
                                <p class="font-bold"><?= $item['cliente'] ?></p>
                            </div>
                            <div class="rounded-3xl bg-surface-container-low p-6 border border-outline-variant/10">
                                <p class="text-[10px] uppercase font-bold opacity-50 tracking-widest mb-3">Local</p>
                                <p class="font-bold"><?= $item['local'] ?></p>
                            </div>
                            <div class="rounded-3xl bg-surface-container-low p-6 border border-outline-variant/10">
                                <p class="text-[10px] uppercase font-bold opacity-50 tracking-widest mb-3">Valor total</p>
                                <p class="text-xl font-headline font-black"><?= $item['valor'] ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="p-16 bg-surface-container-low rounded-xl border-dashed border-2 border-outline-variant/30 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-surface-container-highest mb-4">
                        <span class="material-symbols-outlined text-3xl opacity-40">history</span>
                    </div>
                    <p class="font-headline font-bold uppercase tracking-tighter text-lg">Registro não encontrado</p>
                    <p class="text-sm opacity-60 max-w-xs mx-auto">O histórico solicitado não existe ou foi removido.</p>
                    <button onclick="window.location.href='code.php'" class="mt-8 bg-on-surface text-surface px-6 py-3 rounded-md font-headline font-bold uppercase text-xs tracking-wider transition-transform active:scale-95">Voltar ao painel</button>
                </div>
            <?php endif; ?>
        </div>
    </main>
    <footer id="footer"></footer>
    <script src="../generico/jsgenerico/frame.js"></script>
</body>

</html>

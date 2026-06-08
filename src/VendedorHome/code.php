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

        .machine-card-gradient {
            background: linear-gradient(180deg, rgba(28, 27, 27, 0) 0%, rgba(28, 27, 27, 0.4) 100%);
        }

        .btn-industrial {
            background: linear-gradient(to bottom right, #835400, #f9a825);
        }

        .tab-btn.active {
            color: #835400;
            background-color: white;
            border-right-width: 4px;
            border-color: #835400;
            opacity: 1;
        }

        @media (min-width: 768px) {
            .tab-btn.active {
                border-right-width: 4px;
                background-color: rgba(131, 84, 0, 0.05);
            }
        }
    </style>
</head>

<body class="bg-background text-on-surface font-body selection:bg-primary-container">
    <header id="header"></header>
    <main class=" min-h-screen flex">
        <!-- Vertical Tab Control -->
        <aside class="w-16 md:w-64 border-r border-outline-variant/20 bg-surface-container flex flex-col py-4 sticky top-16 h-[calc(100vh-4rem)] transition-all duration-300">
            <nav class="flex flex-col w-full gap-1">
                <button class="tab-btn active p-4 w-full flex items-center justify-center md:justify-start gap-4 opacity-60 hover:opacity-100 transition-all group" id="btn-inventory" onclick="switchTab('inventory')">
                    <span class="material-symbols-outlined">inventory_2</span>
                    <span class="hidden md:block font-headline font-bold uppercase text-xs tracking-wider">Inventário</span>
                </button>
                <button class="tab-btn p-4 w-full flex items-center justify-center md:justify-start gap-4 opacity-60 hover:opacity-100 transition-all group" id="btn-proposals" onclick="switchTab('proposals')">
                    <span class="material-symbols-outlined">request_quote</span>
                    <span class="hidden md:block font-headline font-bold uppercase text-xs tracking-wider">Propostas</span>
                </button>
                <button class="tab-btn p-4 w-full flex items-center justify-center md:justify-start gap-4 opacity-60 hover:opacity-100 transition-all group" id="btn-rentals" onclick="switchTab('rentals')">
                    <span class="material-symbols-outlined">engineering</span>
                    <span class="hidden md:block font-headline font-bold uppercase text-xs tracking-wider">Aluguéis</span>
                </button>
                <button class="tab-btn p-4 w-full flex items-center justify-center md:justify-start gap-4 opacity-60 hover:opacity-100 transition-all group" id="btn-history" onclick="switchTab('history')">
                    <span class="material-symbols-outlined">history</span>
                    <span class="hidden md:block font-headline font-bold uppercase text-xs tracking-wider">Histórico</span>
                </button>
            </nav>
        </aside>
        <!-- Tab Content Area -->
        <div class="flex-1 p-6 lg:p-10 pb-24 overflow-x-hidden">
            <!-- Header -->
            <div class="mb-8 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                <div>
                    <h2 class="text-3xl lg:text-4xl font-headline font-black tracking-tighter uppercase" id="tab-title">Meus anúncios</h2>
                    <p class="text-xs font-bold text-primary tracking-[0.2em] uppercase mt-1" id="tab-subtitle">Frota Ativa</p>
                </div>
                <div class="tab-content" id="inventory-actions">
                    <button onclick="window.location.href='../CadMaquinas/code.html'" class="btn-industrial px-6 py-3 text-white rounded-md font-headline font-bold uppercase text-xs tracking-wide flex items-center justify-center gap-2 shadow-xl shadow-primary/20 hover:scale-[1.02] active:scale-[0.98] transition-transform">
                        <span class="material-symbols-outlined text-sm">add</span>
                        Cadastrar Máquina
                    </button>
                </div>
            </div>
            <!-- Content Container -->
            <div class="tab-content" id="inventory-content">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="container-card">
                    <!-- Cards injected by JS -->
                </div>
            </div>
            <div class="tab-content hidden" id="proposals-content">
                <div class="p-16 bg-surface-container-low rounded-xl border-dashed border-2 border-outline-variant/30 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-surface-container-highest mb-4">
                        <span class="material-symbols-outlined text-3xl opacity-40">mail</span>
                    </div>
                    <p class="font-headline font-bold uppercase tracking-tighter text-lg">Nenhuma proposta recebida</p>
                    <p class="text-sm opacity-60 max-w-xs mx-auto">Assim que houver interessados em suas máquinas, as propostas aparecerão aqui.</p>
                </div>
            </div>
            <div class="tab-content hidden" id="rentals-content">
                <div class="p-16 bg-surface-container-low rounded-xl border-dashed border-2 border-outline-variant/30 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-surface-container-highest mb-4">
                        <span class="material-symbols-outlined text-3xl opacity-40">key</span>
                    </div>
                    <p class="font-headline font-bold uppercase tracking-tighter text-lg">Sem aluguéis ativos</p>
                    <p class="text-sm opacity-60 max-w-xs mx-auto">Sua frota está pronta para o trabalho. Comece a fechar negócios hoje.</p>
                </div>
            </div>
            <div class="tab-content hidden" id="history-content">
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6" id="history-list">
                    <!-- Histórico de aluguéis injetado por JS -->
                </div>
            </div>
            <div class="tab-content hidden" id="stats-content">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    <div class="bg-surface-container-low rounded-xl p-6 border border-outline-variant/10 hover:shadow-lg transition-shadow">
                        <p class="text-[10px] font-bold uppercase opacity-60 mb-2 tracking-widest">Rendimento Mensal</p>
                        <p class="text-3xl font-headline font-black">R$ 142.500</p>
                        <div class="flex items-center gap-1 text-primary text-[10px] font-bold mt-2 bg-primary/5 inline-flex px-2 py-1 rounded">
                            <span class="material-symbols-outlined text-xs">trending_up</span>
                            <span>+12% vs mês anterior</span>
                        </div>
                    </div>
                    <div class="bg-surface-container-low rounded-xl p-6 border border-outline-variant/10 hover:shadow-lg transition-shadow">
                        <p class="text-[10px] font-bold uppercase opacity-60 mb-2 tracking-widest">Frota Ativa</p>
                        <p class="text-3xl font-headline font-black">24 Máquinas</p>
                        <div class="mt-3 flex items-center gap-4">
                            <div>
                                <p class="text-[10px] font-bold text-primary">18</p>
                                <p class="text-[9px] uppercase opacity-50 font-bold">Alugadas</p>
                            </div>
                            <div class="w-px h-6 bg-outline-variant/20"></div>
                            <div>
                                <p class="text-[10px] font-bold">06</p>
                                <p class="text-[9px] uppercase opacity-50 font-bold">Disponíveis</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-surface-container-low rounded-xl p-6 border border-outline-variant/10 md:col-span-2 lg:col-span-1 hover:shadow-lg transition-shadow">
                        <p class="text-[10px] font-bold uppercase opacity-60 mb-2 tracking-widest">Visualizações</p>
                        <p class="text-3xl font-headline font-black">1.482</p>
                        <p class="text-[10px] opacity-60 mt-2 font-bold uppercase">Últimos 30 dias</p>
                    </div>
                </div>
                <div class="bg-surface-container-low rounded-xl p-6 border border-outline-variant/10">
                    <h3 class="font-headline font-bold uppercase tracking-tight mb-4 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">analytics</span>
                        Análise de Utilização
                    </h3>
                    <div class="h-48 w-full bg-surface-container-highest/50 rounded-lg flex items-end justify-around p-4 gap-2">
                        <div class="w-full bg-primary/20 h-1/4 rounded-t-sm relative group">
                            <div class="absolute -top-6 left-1/2 -translate-x-1/2 text-[9px] font-bold hidden group-hover:block">25%</div>
                        </div>
                        <div class="w-full bg-primary/40 h-2/4 rounded-t-sm relative group">
                            <div class="absolute -top-6 left-1/2 -translate-x-1/2 text-[9px] font-bold hidden group-hover:block">50%</div>
                        </div>
                        <div class="w-full bg-primary/60 h-3/4 rounded-t-sm relative group">
                            <div class="absolute -top-6 left-1/2 -translate-x-1/2 text-[9px] font-bold hidden group-hover:block">75%</div>
                        </div>
                        <div class="w-full bg-primary h-full rounded-t-sm relative group">
                            <div class="absolute -top-6 left-1/2 -translate-x-1/2 text-[9px] font-bold hidden group-hover:block">100%</div>
                        </div>
                        <div class="w-full bg-primary/80 h-4/5 rounded-t-sm relative group">
                            <div class="absolute -top-6 left-1/2 -translate-x-1/2 text-[9px] font-bold hidden group-hover:block">80%</div>
                        </div>
                        <div class="w-full bg-primary/50 h-3/5 rounded-t-sm relative group">
                            <div class="absolute -top-6 left-1/2 -translate-x-1/2 text-[9px] font-bold hidden group-hover:block">60%</div>
                        </div>
                        <div class="w-full bg-primary h-5/6 rounded-t-sm relative group">
                            <div class="absolute -top-6 left-1/2 -translate-x-1/2 text-[9px] font-bold hidden group-hover:block">85%</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal de Edição -->
    <div id="editModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50 overflow-y-auto">
        <div class="bg-surface-container-low rounded-xl shadow-2xl max-w-3xl w-full mx-4 my-8">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-outline-variant/20">
                <h2 class="font-headline text-2xl font-bold uppercase tracking-tight">Editar Máquina</h2>
                <button onclick="closeEditModal()" class="text-on-surface/60 hover:text-on-surface transition-colors">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-8 overflow-y-auto max-h-[calc(100vh-200px)]">
                <form id="editForm" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nome da Máquina -->
                    <div class="flex flex-col gap-2">
                        <label class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">Nome do Ativo</label>
                        <input id="editTitle" class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium" placeholder="Ex: TITAN EX-400" type="text" />
                    </div>

                    <!-- Descrição -->
                    <div class="md:col-span-2 flex flex-col gap-2">
                        <label class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">Descrição</label>
                        <textarea id="editDescription" rows="3" class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium" placeholder="Descreva o equipamento"></textarea>
                    </div>

                    <!-- Preço Diária -->
                    <div class="flex flex-col gap-2">
                        <label class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">Preço Diária (R$)</label>
                        <input id="editDailyPrice" step="0.01" class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium" placeholder="0.00" type="number" />
                    </div>

                    <!-- CEP -->
                    <div class="flex flex-col gap-2">
                        <label class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">CEP</label>
                        <input id="editZipCode" class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium" placeholder="00000-000" type="text" />
                    </div>

                    <!-- Endereço -->
                    <div class="flex flex-col gap-2">
                        <label class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">Rua/Avenida</label>
                        <input id="editStreet" class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium" placeholder="Rua / Av" type="text" />
                    </div>

                    <!-- Número -->
                    <div class="flex flex-col gap-2">
                        <label class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">Número</label>
                        <input id="editNumber" class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium" placeholder="123" type="text" />
                    </div>

                    <!-- Complemento -->
                    <div class="flex flex-col gap-2">
                        <label class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">Complemento</label>
                        <input id="editComplement" class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium" placeholder="Galpão, Apto, etc" type="text" />
                    </div>

                    <!-- Bairro -->
                    <div class="flex flex-col gap-2">
                        <label class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">Bairro</label>
                        <input id="editDistrict" class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium" placeholder="Bairro" type="text" />
                    </div>

                    <!-- Cidade -->
                    <div class="flex flex-col gap-2">
                        <label class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">Cidade</label>
                        <input id="editCity" class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium" placeholder="São Paulo" type="text" />
                    </div>

                    <!-- Estado -->
                    <div class="flex flex-col gap-2">
                        <label class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">Estado</label>
                        <input id="editState" class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium" placeholder="SP" type="text" />
                    </div>

                    <!-- Operador Disponível -->
                    <div class="flex flex-col gap-2">
                        <label class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">Operador Disponível?</label>
                        <select id="editOperatorAvailable" class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium">
                            <option value="false">Não</option>
                            <option value="true">Sim</option>
                        </select>
                    </div>

                    <!-- Preço Operador -->
                    <div id="editOperatorPriceContainer" class="flex flex-col gap-2 hidden">
                        <label class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">Preço Diária Operador (R$)</label>
                        <input id="editOperatorDailyPrice" step="0.01" class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium" placeholder="0.00" type="number" />
                    </div>

                    <!-- Frete Disponível -->
                    <div class="flex flex-col gap-2">
                        <label class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">Frete Disponível?</label>
                        <select id="editFreightAvailable" class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium">
                            <option value="false">Não</option>
                            <option value="true">Sim</option>
                        </select>
                    </div>

                    <!-- Preço Frete -->
                    <div id="editFreightPriceContainer" class="flex flex-col gap-2 hidden">
                        <label class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">Preço Frete (R$)</label>
                        <input id="editFreightFixedPrice" step="0.01" class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium" placeholder="0.00" type="number" />
                    </div>

                    <!-- Frota -->
                    <div class="flex flex-col gap-2">
                        <label class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">Máquina única ou Frota?</label>
                        <select id="editIsFleet" class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium">
                            <option value="false">Única</option>
                            <option value="true">Frota</option>
                        </select>
                    </div>
                </form>
            </div>

            <!-- Modal Footer -->
            <div class="flex gap-4 p-6 border-t border-outline-variant/20 justify-end">
                <button onclick="closeEditModal()" class="px-6 py-3 border border-outline-variant text-on-surface rounded-md font-headline font-bold uppercase text-xs tracking-wide hover:bg-surface-container-highest transition-colors">
                    Cancelar
                </button>
                <button onclick="saveEdit()" class="px-6 py-3 bg-primary text-white rounded-md font-headline font-bold uppercase text-xs tracking-wide hover:bg-primary/90 transition-colors shadow-lg shadow-primary/20">
                    Salvar Alterações
                </button>
            </div>
        </div>
    </div>

    <footer id="footer"></footer>
    <script>
        const dados = [{
  title: "Escavadeira hidráulica CAT 320",
  description: "Máquina em ótimo estado.\nDisponível para aluguel diário.",
  dailyPrice: 850.00,
  images: ["imagem1.jpg", "imagem2.png", "imagem3.webp"],
  pickupCity: "São Paulo",
  pickupState: "SP",
  operatorAvailable: true,
  freightAvailable: true,
  isFleet: false,
  // ... outros campos
}];
        
        // EXEMPLO: Estrutura de dados esperada para cada máquina no inventário
        // Você pode carregar isso via API ou processá-lo no backend e injetar no HTML
        /*
        const dados = [
            {
                title: "Escavadeira hidráulica CAT 320",
                description: "Máquina em ótimo estado.\nDisponível para aluguel diário.",
                dailyPrice: 850.00,
                images: ["imagem1.jpg", "imagem2.png", "imagem3.webp"],
                
                // Informações de localização
                pickupState: "SP",
                pickupCity: "São Paulo",
                pickupDistrict: "Centro",
                pickupStreet: "Rua Exemplo",
                pickupNumber: "123",
                pickupZipCode: "01000-000",
                pickupComplement: "Galpão 2",
                
                // Serviços adicionais
                operatorAvailable: true,
                operatorDailyPrice: 250.00,
                freightAvailable: true,
                freightFixedPrice: 500.00,
                
                // Informações adicionais
                isFleet: false,
                category: 0
            }
        ];
        */

        function renderInventory() {
            const container = document.getElementById('container-card');
            container.innerHTML = dados.map((item, index) => {
                // Usar primeira imagem do array ou fallback
                const imagemPrincipal = item.images && item.images.length > 0 ? item.images[0] : item.imagem || 'placeholder.jpg';
                const priceFormatted = typeof item.dailyPrice === 'number' ? `R$ ${item.dailyPrice.toFixed(2).replace('.', ',')}` : item.precoDia;
                const localizacao = `${item.pickupCity}, ${item.pickupState}`;
                
                // Badges de serviços adicionais
                const servicosBadges = `
                    ${item.operatorAvailable ? `<div class="flex items-center gap-1 px-2 py-1 bg-primary/10 rounded text-[10px] font-bold text-primary"><span class="material-symbols-outlined text-xs">person</span>Operador</div>` : ''}
                    ${item.freightAvailable ? `<div class="flex items-center gap-1 px-2 py-1 bg-tertiary/10 rounded text-[10px] font-bold text-tertiary"><span class="material-symbols-outlined text-xs">local_shipping</span>Frete</div>` : ''}
                `;
                
                return `
                <div class="bg-surface-container-lowest rounded-xl overflow-hidden border border-outline-variant/10 hover:border-primary/30 transition-all hover:shadow-xl group">
                    <div class="h-48 relative overflow-hidden">
                        <img src="${imagemPrincipal}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 machine-card-gradient"></div>
                        <div class="absolute top-4 right-4 flex gap-2 flex-wrap justify-end">
                            ${item.isFleet ? `<div class="bg-white/95 px-3 py-1 rounded text-[10px] font-black text-primary uppercase shadow-sm">Frota</div>` : ''}
                            <div class="bg-white/95 px-3 py-1 rounded text-[10px] font-black text-primary uppercase shadow-sm">Ativo</div>
                        </div>
                    </div>
                    <div class="p-5">
                        <h3 class="font-headline font-bold text-lg uppercase leading-tight mb-1 min-h-[2.5rem] line-clamp-2">${item.title}</h3>
                        <p class="text-[11px] opacity-60 mb-3 flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">location_on</span>
                            ${localizacao}
                        </p>
                        <p class="text-xs opacity-70 mb-4 line-clamp-2 leading-relaxed">${item.description}</p>
                        
                        ${servicosBadges ? `<div class="flex gap-2 flex-wrap mb-4">${servicosBadges}</div>` : ''}
                        
                        <div class="flex items-center justify-between pt-4 border-t border-outline-variant/5">
                            <div>
                                <p class="text-[10px] uppercase font-bold opacity-40 mb-0.5">Diária</p>
                                <p class="text-xl font-headline font-black text-on-surface">${priceFormatted}</p>
                            </div>
                            <button onclick="openEditModal(${index})" class="bg-on-surface hover:bg-primary transition-colors text-white px-4 py-2 rounded text-[10px] font-bold uppercase tracking-widest">Editar</button>
                        </div>
                    </div>
                </div>
                `;
            }).join('');

            if (dados.length <= 0) {
                container.innerHTML = `
                <div id="adicionar-anuncio" class="group bg-surface-container-lowest rounded-md overflow-hidden transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl hover:shadow-black/5 border-dashed border-2 border-outline-variant/30 flex flex-col items-center justify-center p-8 text-center min-h-[500px]">
                <div class="w-16 h-16 bg-surface-container-low rounded-full flex items-center justify-center mb-6 group-hover:bg-primary-fixed transition-colors">
                <span class="material-symbols-outlined text-3xl text-outline group-hover:text-primary" data-icon="add_circle">add_circle</span>
                </div>
                <h3 class="text-2xl font-headline font-black tracking-tight mb-2">Adicionar novo equipamento</h3>
                <p class="text-on-surface-variant text-sm mb-8">Amplie sua frota visível e aumente seu faturamento mensal.</p> <button onclick="window.location.href='../CadMaquinas/code.html'" class="bg-on-surface text-surface px-6 py-3 rounded-md font-headline font-bold uppercase text-xs tracking-wider transition-transform active:scale-95">Começar agora</button>
                </div>
                `;
            }
        }

        const historico = [
            {
                id: '1',
                titulo: 'Retroescavadeira CAT 320',
                periodo: '12 fev 2026 – 18 fev 2026',
                cliente: 'Obras & Concretos S/A',
                local: 'Zona Sul, São Paulo',
                valor: 'R$ 8.400',
                status: 'Concluído',
                link: '../VendedorHome/historico.php?id=1'
            },
            {
                id: '2',
                titulo: 'Perfuratriz DTH 20',
                periodo: '02 mar 2026 – 10 mar 2026',
                cliente: 'Engenharia Nova Era',
                local: 'Guarulhos, SP',
                valor: 'R$ 11.200',
                status: 'Concluído',
                link: '../VendedorHome/historico.php?id=2'
            },
            {
                id: '3',
                titulo: 'Vibroacabadora Volvo ABG 2820',
                periodo: '20 abr 2026 – 30 abr 2026',
                cliente: 'Estradas Brasil',
                local: 'Campinas, SP',
                valor: 'R$ 9.750',
                status: 'Concluído',
                link: '../VendedorHome/historico.php?id=3'
            }
        ];

        function renderHistory() {
            const historyList = document.getElementById('history-list');
            historyList.innerHTML = historico.map(item => `
                <a href="${item.link}" class="group block bg-surface-container-lowest rounded-2xl border border-outline-variant/10 hover:border-primary/30 transition-all hover:shadow-xl overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between gap-4 mb-4">
                            <div>
                                <p class="text-[10px] uppercase font-bold opacity-40 mb-1 tracking-widest">${item.status}</p>
                                <h3 class="text-xl font-headline font-black uppercase leading-tight">${item.titulo}</h3>
                            </div>
                            <span class="text-xs uppercase font-bold text-primary">Ver</span>
                        </div>
                        <p class="text-sm opacity-70 mb-4">${item.cliente}</p>
                        <div class="grid grid-cols-1 gap-3 text-[11px] font-bold uppercase tracking-[0.18em] text-on-surface/80">
                            <div class="flex justify-between"><span>Período</span><span>${item.periodo}</span></div>
                            <div class="flex justify-between"><span>Local</span><span>${item.local}</span></div>
                            <div class="flex justify-between"><span>Valor</span><span>${item.valor}</span></div>
                        </div>
                    </div>
                </a>
            `).join('');

            if (historico.length === 0) {
                historyList.innerHTML = `
                    <div class="col-span-full p-16 bg-surface-container-low rounded-xl border-dashed border-2 border-outline-variant/30 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-surface-container-highest mb-4">
                            <span class="material-symbols-outlined text-3xl opacity-40">history</span>
                        </div>
                        <p class="font-headline font-bold uppercase tracking-tighter text-lg">Ainda não há histórico</p>
                        <p class="text-sm opacity-60 max-w-xs mx-auto">Quando seus aluguéis forem concluídos, o histórico aparecerá aqui.</p>
                    </div>
                `;
            }
        }

        function switchTab(tab) {
            // Content
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));

            const activeContent = document.getElementById(tab + '-content');
            if (activeContent) activeContent.classList.remove('hidden');

            // Show inventory action only on inventory tab
            const actionBtn = document.getElementById('inventory-actions');
            if (actionBtn) actionBtn.classList.toggle('hidden', tab !== 'inventory');

            // Buttons
            document.querySelectorAll('.tab-btn').forEach(el => el.classList.remove('active'));
            const activeButton = document.getElementById('btn-' + tab);
            if (activeButton) activeButton.classList.add('active');

            // Header titles
            const titles = {
                'inventory': ['Meus anúncios', 'Frota Ativa'],
                'proposals': ['Propostas', 'Negociações em curso'],
                'rentals': ['Aluguéis', 'Máquinas em operação'],
                'history': ['Histórico', 'Aluguéis concluídos'],
                'stats': ['Relatórios', 'Performance da frota']
            };
            document.getElementById('tab-title').textContent = titles[tab][0];
            document.getElementById('tab-subtitle').textContent = titles[tab][1];
        }

        // Funções para gerenciar o modal de edição
        let currentEditIndex = null;

        function openEditModal(index) {
            currentEditIndex = index;
            const item = dados[index];
            
            // Preencher os campos do modal com os dados da máquina
            document.getElementById('editTitle').value = item.title || '';
            document.getElementById('editDescription').value = item.description || '';
            document.getElementById('editDailyPrice').value = item.dailyPrice || '';
            document.getElementById('editZipCode').value = item.pickupZipCode || '';
            document.getElementById('editStreet').value = item.pickupStreet || '';
            document.getElementById('editNumber').value = item.pickupNumber || '';
            document.getElementById('editComplement').value = item.pickupComplement || '';
            document.getElementById('editDistrict').value = item.pickupDistrict || '';
            document.getElementById('editCity').value = item.pickupCity || '';
            document.getElementById('editState').value = item.pickupState || '';
            
            // Setar os selects de serviços adicionais
            document.getElementById('editOperatorAvailable').value = item.operatorAvailable ? 'true' : 'false';
            document.getElementById('editFreightAvailable').value = item.freightAvailable ? 'true' : 'false';
            document.getElementById('editIsFleet').value = item.isFleet ? 'true' : 'false';
            
            // Preencher preços adicionais
            document.getElementById('editOperatorDailyPrice').value = item.operatorDailyPrice || '';
            document.getElementById('editFreightFixedPrice').value = item.freightFixedPrice || '';
            
            // Mostrar/ocultar campos condicionais
            toggleOperatorField();
            toggleFreightField();
            
            // Exibir modal
            document.getElementById('editModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeEditModal() {
            document.getElementById('editModal').classList.add('hidden');
            document.body.style.overflow = '';
            currentEditIndex = null;
        }

        function toggleOperatorField() {
            const operatorAvailable = document.getElementById('editOperatorAvailable').value === 'true';
            document.getElementById('editOperatorPriceContainer').classList.toggle('hidden', !operatorAvailable);
        }

        function toggleFreightField() {
            const freightAvailable = document.getElementById('editFreightAvailable').value === 'true';
            document.getElementById('editFreightPriceContainer').classList.toggle('hidden', !freightAvailable);
        }

        function saveEdit() {
            if (currentEditIndex === null) return;
            
            const item = dados[currentEditIndex];
            
            // Atualizar os dados da máquina com os valores do formulário
            item.title = document.getElementById('editTitle').value;
            item.description = document.getElementById('editDescription').value;
            item.dailyPrice = parseFloat(document.getElementById('editDailyPrice').value) || 0;
            item.pickupZipCode = document.getElementById('editZipCode').value;
            item.pickupStreet = document.getElementById('editStreet').value;
            item.pickupNumber = document.getElementById('editNumber').value;
            item.pickupComplement = document.getElementById('editComplement').value;
            item.pickupDistrict = document.getElementById('editDistrict').value;
            item.pickupCity = document.getElementById('editCity').value;
            item.pickupState = document.getElementById('editState').value;
            item.operatorAvailable = document.getElementById('editOperatorAvailable').value === 'true';
            item.freightAvailable = document.getElementById('editFreightAvailable').value === 'true';
            item.isFleet = document.getElementById('editIsFleet').value === 'true';
            item.operatorDailyPrice = parseFloat(document.getElementById('editOperatorDailyPrice').value) || 0;
            item.freightFixedPrice = parseFloat(document.getElementById('editFreightFixedPrice').value) || 0;
            
            // Fechar modal e re-renderizar
            closeEditModal();
            renderInventory();
            
            // Aqui você pode enviar os dados para o servidor via API
            console.log('Máquina atualizada:', item);
        }

        // Event listeners para mostrar/ocultar campos condicionais
        document.getElementById('editOperatorAvailable').addEventListener('change', toggleOperatorField);
        document.getElementById('editFreightAvailable').addEventListener('change', toggleFreightField);

        // Fechar modal ao clicar fora
        document.getElementById('editModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditModal();
            }
        });

        renderInventory();
        renderHistory();
    </script>
    <script src="../generico/jsgenerico/frame.js?v=vendor-modal-4"></script>
</body>

</html>

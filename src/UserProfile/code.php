<?php
// STATUS 3 É SUPER AUTENTICADO
// TYPE 0 USUARIO COMUM E 1 VENDEDOR

error_reporting(0);
require("../auth/auth.php");
require_once("../endpoints.php");
$semDados = "Dados não carregados!";

require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTCCSenai/src/config/session.php';

$dataFormatada = new DateTime($_SESSION['birthDate']);
$createdAt = new DateTime($_SESSION['createdAt']);

$type = $_SESSION['type'] == 0 ? "Cliente" : "Locador";
$status = $_SESSION["status"] == 3 ? '<span class="text-on-surface font-black text-xs uppercase" >Super Verificado & ' . $type . '</span>' : '<span class="text-on-surface font-black text-xs uppercase" style="color: red">Pendente de Verificação & ' . $type . '</span>';

//////////////////////////////////
$endpoints = new Endpoints();
$apiBaseUrl = $endpoints->urlRentals;

$accessToken = $_SESSION["accessToken"];

$rentalActionMessage = null;
$rentalActionError = null;

/**
 * Escapes values for safe HTML output.
 * / Escapa valores para saída segura no HTML.
 */
function h($value): string
{
    return htmlspecialchars((string)($value ?? ""), ENT_QUOTES, "UTF-8");
}

/**
 * Calls the HeavyRent API using the authenticated user's access token.
 * / Chama a API HeavyRent usando o access token do usuário autenticado.
 */
function callHeavyRentApi(
        string $method,
        string $path,
        string $accessToken,
        ?array $body = null
): array
{
    global $apiBaseUrl;



    $headers = [
            "Accept: application/json",
            "Authorization: Bearer " . $accessToken
    ];

    $curl = curl_init($apiBaseUrl . $path);

    curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => strtoupper($method),
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_TIMEOUT => 30
    ]);

    if ($body !== null) {
        $jsonBody = json_encode($body);

        $headers[] = "Content-Type: application/json";

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $jsonBody);
    }

    $responseBody = curl_exec($curl);
    $curlError = curl_error($curl);
    $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

    curl_close($curl);

    if ($responseBody === false) {
        return [
                "success" => false,
                "statusCode" => 0,
                "data" => null,
                "message" => $curlError ?: "Erro ao chamar API."
        ];
    }

    $data = json_decode($responseBody, true);

    if ($httpCode < 200 || $httpCode >= 300) {
        return [
                "success" => false,
                "statusCode" => $httpCode,
                "data" => $data,
                "message" => $data["message"] ?? "Erro ao chamar API."
        ];
    }

    return [
            "success" => true,
            "statusCode" => $httpCode,
            "data" => $data,
            "message" => null
    ];
}

/**
 * Formats money in Brazilian currency.
 * / Formata dinheiro em moeda brasileira.
 */
function formatMoneyBr($value): string
{
    return "R$ " . number_format((float)$value, 2, ",", ".");
}

/**
 * Formats DateOnly values from the API.
 * / Formata valores DateOnly vindos da API.
 */
function formatDateBr($date): string
{
    if (empty($date)) {
        return "-";
    }

    $dateTime = DateTime::createFromFormat("Y-m-d", substr($date, 0, 10));

    if (!$dateTime) {
        return h($date);
    }

    return $dateTime->format("d/m/Y");
}

/**
 * Formats UTC datetime values from the API.
 * / Formata valores DateTime UTC vindos da API.
 */
function formatDateTimeBr($date): string
{
    if (empty($date)) {
        return "-";
    }

    try {
        $dateTime = new DateTime($date);
        return $dateTime->format("d/m/Y H:i");
    } catch (Exception) {
        return h($date);
    }
}

/**
 * Converts rental status to readable text.
 * / Converte o status do aluguel para texto legível.
 */
function getRentalStatusText($status): string
{
    return match ((string)$status) {
        "1", "Approved" => "Aprovado",
        "2", "InProgress" => "Em andamento",
        "3", "Completed" => "Concluído",
        "4", "Cancelled" => "Cancelado",
        default => (string)$status
    };
}

/**
 * Returns badge classes based on rental status.
 * / Retorna classes do selo com base no status do aluguel.
 */
function getRentalStatusBadgeClass($status): string
{
    return match ((string)$status) {
        "1", "Approved" => "bg-blue-100 text-blue-800 border-blue-200",
        "2", "InProgress" => "bg-green-100 text-green-800 border-green-200",
        "3", "Completed" => "bg-stone-100 text-stone-700 border-stone-200",
        "4", "Cancelled" => "bg-red-100 text-red-800 border-red-200",
        default => "bg-stone-100 text-stone-700 border-stone-200"
    };
}

/**
 * Checks if the rental can be completed or cancelled.
 * / Verifica se o aluguel pode ser encerrado ou cancelado.
 */
function canManageRental($status): bool
{
    return in_array((string)$status, ["1", "2", "Approved", "InProgress"], true);
}

/**
 * Handles rental complete/cancel actions.
 * / Manipula ações de encerrar/cancelar aluguel.
 */
if ($_SERVER["REQUEST_METHOD"] === "POST" &&
        isset($_POST["rental_action"], $_POST["rental_id"])) {

    $rentalId = $_POST["rental_id"];
    $action = $_POST["rental_action"];

    if (empty($accessToken)) {
        $rentalActionError = "Token de acesso não encontrado.";
    } elseif (!in_array($action, ["complete", "cancel"], true)) {
        $rentalActionError = "Ação inválida.";
    } else {
        $result = callHeavyRentApi(
                "POST",
                "/" . urlencode($rentalId) . "/" . $action,
                $accessToken
        );

        if ($result["success"]) {
            $rentalActionMessage = $action === "complete"
                    ? "Locação encerrada com sucesso."
                    : "Locação cancelada com sucesso.";
        } else {
            $rentalActionError = $result["message"];
        }
    }
}

/**
 * Loads active rentals for the authenticated user as renter.
 * / Carrega aluguéis ativos do usuário autenticado como locatário.
 */
$activeRentals = [];
$rentalsLoadError = null;

if (empty($accessToken)) {
    $rentalsLoadError = "Token de acesso não encontrado na sessão.";
} else {
    $rentalsResponse = callHeavyRentApi(
            "GET",
            "?Role=Renter&status=Active&page=1&pageSize=10",
            $accessToken
    );

    if ($rentalsResponse["success"]) {
        $activeRentals = $rentalsResponse["data"]["items"] ?? [];
    } else {
        $rentalsLoadError = $rentalsResponse["message"];
    }
}
////////////
///
/**
 * Loads completed and cancelled rentals for the history tab.
 */
$completedRentals = [];
$cancelledRentals  = [];
$historyLoadError  = null;

if (!empty($accessToken)) {
    $completedResponse = callHeavyRentApi(
            "GET",
            "?Role=Renter&status=Completed&page=1&pageSize=20",
            $accessToken
    );
    if ($completedResponse["success"]) {
        $completedRentals = $completedResponse["data"]["items"] ?? [];
    } else {
        $historyLoadError = $completedResponse["message"];
    }

    $cancelledResponse = callHeavyRentApi(
            "GET",
            "?Role=Renter&status=Cancelled&page=1&pageSize=20",
            $accessToken
    );
    if ($cancelledResponse["success"]) {
        $cancelledRentals = $cancelledResponse["data"]["items"] ?? [];
    } elseif (!$historyLoadError) {
        $historyLoadError = $cancelledResponse["message"];
    }
}

?>

<!DOCTYPE html>

<html lang="pt-BR">

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
  <script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          "colors": {
            "tertiary-container": "#2ac6ff",
            "surface-dim": "#dcd9d9",
            "outline-variant": "#d7c3ae",
            "on-tertiary-fixed": "#001e2b",
            "on-surface": "#1c1b1b",
            "tertiary-fixed": "#c0e8ff",
            "primary-fixed": "#ffddb5",
            "error": "#ba1a1a",
            "surface-bright": "#fcf9f8",
            "primary": "#835400",
            "surface": "#fcf9f8",
            "inverse-primary": "#ffb957",
            "surface-container-highest": "#e5e2e1",
            "on-surface-variant": "#524434",
            "surface-variant": "#e5e2e1",
            "on-secondary-container": "#5a666d",
            "primary-container": "#f9a825",
            "inverse-surface": "#313030",
            "on-primary-fixed": "#2a1800",
            "on-secondary": "#ffffff",
            "on-primary-container": "#674100",
            "on-tertiary-container": "#004f69",
            "on-error": "#ffffff",
            "secondary-container": "#d7e4ec",
            "secondary-fixed": "#d7e4ec",
            "background": "#fcf9f8",
            "primary-fixed-dim": "#ffb957",
            "surface-tint": "#835400",
            "on-error-container": "#93000a",
            "tertiary-fixed-dim": "#71d2ff",
            "secondary-fixed-dim": "#bbc8d0",
            "outline": "#857462",
            "on-secondary-fixed": "#111d23",
            "tertiary": "#006687",
            "surface-container-high": "#ebe7e7",
            "on-tertiary": "#ffffff",
            "on-background": "#1c1b1b",
            "error-container": "#ffdad6",
            "inverse-on-surface": "#f3f0ef",
            "surface-container": "#f0edec",
            "surface-container-low": "#f6f3f2",
            "secondary": "#546067",
            "on-tertiary-fixed-variant": "#004d66",
            "on-secondary-fixed-variant": "#3c494f",
            "on-primary-fixed-variant": "#643f00",
            "on-primary": "#ffffff",
            "surface-container-lowest": "#ffffff"
          },
          "borderRadius": {
            "DEFAULT": "0.125rem",
            "lg": "0.25rem",
            "xl": "0.5rem",
            "full": "0.75rem"
          },
          "fontFamily": {
            "headline": ["Space Grotesk"],
            "display": ["Space Grotesk"],
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

    body {
      font-family: 'Inter', sans-serif;
    }

    h1,
    h2,
    h3,
    .font-display {
      font-family: 'Space Grotesk', sans-serif;
    }
  </style>
</head>

<body class="bg-surface text-on-surface selection:bg-primary-container selection:text-on-primary-container">
  <!-- TopAppBar -->
  <header id="header"></header>
  <div class="flex flex-col md:flex-row min-h-screen">
    <!-- SideNavBar -->
    <aside class="bg-[#f6f3f2] dark:bg-[#252423] w-full md:w-72 md:h-screen flex flex-col hidden md:flex">
      <nav class="flex flex-col h-full py-8">
        <div class="px-8 mb-10">
          <p class="text-xs font-bold uppercase tracking-widest text-stone-400 mb-1">Conta</p>
          <h3 class="text-lg font-bold text-on-surface">
            <?php if (isset($_SESSION["firstName"]) && isset($_SESSION["lastName"]))
              echo $_SESSION["firstName"] . " " . $_SESSION["lastName"] ?? $semDados ?>
            </h3>
            <p class="text-xs text-stone-500">Membro desde <?php echo $createdAt->format("M") . " de " . $createdAt->format("Y")?? $semDados?></p>
          </div>
          <div class="space-y-1">
            <button data-tab="perfil"
              class="tab-btn text-[#835400] dark:text-[#f9a825] bg-[#ffffff] dark:bg-[#1c1b1b] border-l-4 border-[#835400] dark:border-[#f9a825] px-8 py-4 flex items-center gap-4 transition-all duration-150 group w-full text-left cursor-pointer">
              <span class="material-symbols-outlined">person</span>
              <span class="font-['Inter'] text-sm font-semibold group-hover:translate-x-1 transition-transform">Meu
                Perfil</span>
            </button>
            <button data-tab="locacoes"
              class="tab-btn text-stone-600 dark:text-stone-400 px-8 py-4 flex items-center gap-4 hover:bg-[#ebe7e7] dark:hover:bg-zinc-800 transition-all duration-150 group w-full text-left cursor-pointer">
              <span class="material-symbols-outlined">request_quote</span>
              <span class="font-['Inter'] text-sm font-semibold group-hover:translate-x-1 transition-transform">Minhas
                Locações</span>
            </button>
            <button data-tab="historico"
              class="tab-btn text-stone-600 dark:text-stone-400 px-8 py-4 flex items-center gap-4 hover:bg-[#ebe7e7] dark:hover:bg-zinc-800 transition-all duration-150 group w-full text-left cursor-pointer">
              <span class="material-symbols-outlined">history</span>
              <span
                class="font-['Inter'] text-sm font-semibold group-hover:translate-x-1 transition-transform">Histórico</span>
            </button>
            <button data-tab="suporte"
              class="tab-btn text-stone-600 dark:text-stone-400 px-8 py-4 flex items-center gap-4 hover:bg-[#ebe7e7] dark:hover:bg-zinc-800 transition-all duration-150 group w-full text-left cursor-pointer">
              <span class="material-symbols-outlined">support_agent</span>
              <span
                class="font-['Inter'] text-sm font-semibold group-hover:translate-x-1 transition-transform">Suporte</span>
            </button>
          </div>
          <div class="border-t border-stone-200 mt-4 pt-4">
            <a class="text-error px-8 py-3 flex items-center gap-4 hover:bg-red-50 transition-all text-xs font-semibold"
              href="../auth/logout.php">
              <span class="material-symbols-outlined text-sm">logout</span>
              Sair
            </a>
          </div>
          <div class="border-t border-stone-200 mt-4 pt-4">
            <a class="text-error px-8 py-3 flex items-center gap-4 hover:bg-red-50 transition-all text-xs font-semibold"
              href="../auth/logout-all-sessions.php">
              <span class="material-symbols-outlined text-sm">logout</span>
              Sair de todas as sessões
            </a>
          </div>
        </nav>
      </aside>
      <!-- Main Content -->
      <main class="w-full flex-1 min-h-screen ">
        <div class="p-8 lg:p-12 max-w-4xl mx-auto space-y-10">
          <!-- Page Header -->
          <header>
            <h1 class="text-5xl md:text-7xl font-black tracking-tighter text-on-surface leading-none uppercase mb-2">
              Meu <span class="text-primary italic">Perfil</span>
            </h1>
            <p class="text-lg text-stone-500 font-light">Gerencie suas informações de acesso e dados cadastrais.</p>
          </header>
          <!-- Tab System -->
          <div class="border-b border-stone-200">
            <nav class="flex gap-8">
              <button id="tab-perfil-btn"
                class="tab-content-btn border-b-4 border-primary pb-4 px-1 text-sm font-black uppercase tracking-tighter text-on-surface"
                data-content-tab="perfil">Dados Pessoais</button>
              <button id="tab-locacoes-btn"
                class="tab-content-btn border-b-4 border-transparent pb-4 px-1 text-sm font-black uppercase tracking-tighter text-stone-400 hover:text-on-surface transition-colors"
                data-content-tab="locacoes">Minhas Locações</button>
              <button id="tab-historico-btn"
                class="tab-content-btn border-b-4 border-transparent pb-4 px-1 text-sm font-black uppercase tracking-tighter text-stone-400 hover:text-on-surface transition-colors"
                data-content-tab="historico">Histórico</button>
              <button id="tab-suporte-btn"
                class="tab-content-btn border-b-4 border-transparent pb-4 px-1 text-sm font-black uppercase tracking-tighter text-stone-400 hover:text-on-surface transition-colors"
                data-content-tab="suporte">Suporte</button>
            </nav>
          </div>
          <!-- Profile Detail View (Dados Pessoais) -->
          <section id="tab-content-perfil"
            class="tab-content bg-surface-container-lowest rounded-md shadow-sm overflow-hidden">
            <!-- Profile Header -->
            <div
              class="p-8 md:p-10 bg-surface-container-low border-b border-stone-100 flex flex-col md:flex-row items-center gap-8">
              <div class="relative group">
                <div class="h-32 w-32 rounded-full overflow-hidden border-4 border-white shadow-xl">
                  <img alt="Ricardo Mendes Profile" class="w-full h-full object-cover"
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBzUDQZl-HKLn1hbcibYx6YX5VTq7eAMYn1QPM01CHamypkVTJOl1k5xkmZRrCKE-ImYbQZtSuZH3P6pUs7BEJHyMRe4bsZl0_qURze9GcGIKaRSSPfIf5zXzOCA8DhWsYs8xPVpIiNgE5LUSzcubC5-IkZqoDQCJZRMQADhQ4LpjwSTl3ZBTeYidDzGISOrBCMdLjg9iFRCe5G5IWGasKNnq3PYVEoBbLPXg0QibzdcOkLRb6MvF_nRLGZOixdrrCjf9-I0Fzb2N8E" />
                </div>
              </div>
              <div class="text-center md:text-left">
                <h2 class="text-3xl font-black uppercase tracking-tighter">
                <?php if (isset($_SESSION["firstName"]) && isset($_SESSION["lastName"]))
              echo $_SESSION["firstName"] . " " . $_SESSION["lastName"] ?? $semDados ?>
                </h2>
              </div>
              <div class="md:ml-auto flex gap-3">
              </div>
            </div>
            <!-- Info Grid -->
            <div class="p-8 md:p-10">
              <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                <div>
                  <label class="text-[10px] font-black uppercase text-stone-400 tracking-widest block mb-1">Email
                    Corporativo</label>
                  <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-stone-300">mail</span>
                    <span
                      class="text-on-surface font-semibold"><?php if (isset($_SESSION["email"]))
              echo $_SESSION["email"] ?? $semDados ?></span>
                  </div>
                </div>
                <div>
                  <label class="text-[10px] font-black uppercase text-stone-400 tracking-widest block mb-1">Localização
                    Principal</label>
                  <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-stone-300">location_on</span>
                    <span
                      class="text-on-surface font-semibold"><?php if (isset($_SESSION["address"]["city"]) && isset($_SESSION["address"]["state"]))
              echo $_SESSION["address"]["city"] . ", " . $_SESSION["address"]["state"] ?? $semDados ?></span>
                  </div>
                </div>
                <div>
                  <label class="text-[10px] font-black uppercase text-stone-400 tracking-widest block mb-1">Data de
                    Nascimento</label>
                  <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-stone-300">calendar_today</span>
                    <span
                      class="text-on-surface font-semibold"><?php if (isset($_SESSION["birthDate"]))
              echo $dataFormatada->format("d/m/Y") ?? $semDados ?></span>
                  </div>
                </div>
                <div>
                  <label class="text-[10px] font-black uppercase text-stone-400 tracking-widest block mb-1">Status da
                    Conta</label>
                  <div class="flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-green-500"></span>
                  <?php if (isset($status))
              echo $status ?? $semDados ?>
                  </div>
                </div>
              </div>
              <div class="mt-12 pt-8 border-t border-stone-100">
                <h4 class="text-xs font-black uppercase tracking-widest text-stone-400 mb-6">Ações da Conta</h4>
                <div class="flex flex-row sm:flex-row gap-4">
                  <button
                    class="inline-flex items-center justify-center border-2 border-red-500 text-red-500 px-4 py-2 rounded-md font-bold text-xs uppercase hover:bg-red-50 transition-colors"
                    onclick="openDisableAccountModal()">Desativar Conta</button>
                  <button
                    class="inline-flex items-center justify-center border-2 border-yellow-500 text-yellow-500 px-4 py-2 rounded-md font-bold text-xs uppercase hover:bg-yellow-50 transition-colors"
                    onclick="window.location.href='../NovaSenha/code.php'">Mudar Senha</button>
                <?php if (isset($_SESSION["type"]) && $_SESSION["type"] == 0)
              echo '<a href="../VendedorHome/code.php" class="inline-flex items-center justify-center border-2 border-[#2ac6ff] text-[#2ac6ff] px-4 py-2 rounded-md font-bold text-xs uppercase hover:bg-[#c0e8ff] transition-colors">Virar vendedor</a>' ?>
                </div>
              </div>
            </div>
          </section>

          <!-- Tab Content: Minhas Locações -->
            <section id="tab-content-locacoes"
                     class="tab-content hidden bg-surface-container-lowest rounded-md shadow-sm overflow-hidden">
                <div class="p-8 md:p-10">

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
                        <div>
                            <h2 class="text-2xl font-black uppercase tracking-tighter">Minhas Locações Ativas</h2>
                            <p class="text-sm text-stone-500 mt-1">
                                Acompanhe seus aluguéis ativos, encerre ou cancele uma locação.
                            </p>
                        </div>

                        <a href="?tab=locacoes"
                           class="inline-flex items-center justify-center gap-2 bg-primary text-white px-4 py-2 rounded-md font-bold text-xs uppercase hover:bg-[#6d4200] transition-colors">
                            <span class="material-symbols-outlined text-sm">refresh</span>
                            Atualizar
                        </a>
                    </div>

                    <?php if ($rentalActionMessage): ?>
                        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 p-4 rounded-md text-sm font-semibold">
                            <?php echo h($rentalActionMessage); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($rentalActionError): ?>
                        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 p-4 rounded-md text-sm font-semibold">
                            <?php echo h($rentalActionError); ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($rentalsLoadError): ?>
                        <div class="bg-red-50 border border-red-200 p-6 rounded-md">
                            <p class="text-red-700 font-bold text-sm uppercase mb-1">Erro ao carregar locações</p>
                            <p class="text-red-600 text-sm"><?php echo h($rentalsLoadError); ?></p>
                        </div>

                    <?php elseif (empty($activeRentals)): ?>
                        <div class="bg-surface-container-low p-6 rounded-md border border-stone-200 flex items-center justify-center min-h-40">
                            <p class="text-stone-400 text-center">Nenhuma locação ativa encontrada.</p>
                        </div>

                    <?php else: ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                            <?php foreach ($activeRentals as $rental): ?>
                                <?php
                                $status = $rental["status"] ?? "";
                                $statusText = getRentalStatusText($status);
                                $statusClass = getRentalStatusBadgeClass($status);
                                $canManage = canManageRental($status);
                                ?>

                                <article class="bg-surface-container-low border border-stone-200 rounded-md overflow-hidden shadow-sm">
                                    <article class="bg-white border border-stone-200 rounded-md overflow-hidden shadow-sm hover:shadow-md transition-all">

                                        <div class="p-5">

                                            <div class="flex justify-between items-start mb-4">

                                                <div>
                                                    <p class="text-[10px] font-black uppercase tracking-widest text-stone-400">
                                                        Locação Ativa
                                                    </p>

                                                    <p class="text-sm font-bold text-stone-600 mt-1">
                                                        <?php echo h($rental["providerName"] ?? "Fornecedor"); ?>
                                                    </p>
                                                </div>

                                                <span class="inline-flex items-center justify-center px-2 py-1 rounded-full border text-[10px] font-black uppercase <?php echo h($statusClass); ?>">
                <?php echo h($statusText); ?>
            </span>

                                            </div>

                                            <div class="space-y-3">

                                                <div class="flex items-center gap-2 text-sm">
                <span class="material-symbols-outlined text-stone-400 text-base">
                    calendar_month
                </span>

                                                    <span>
                    <?php echo formatDateBr($rental["startDate"] ?? null); ?>
                    -
                    <?php echo formatDateBr($rental["endDate"] ?? null); ?>
                </span>
                                                </div>

                                                <div class="flex items-center gap-2 text-sm">
                <span class="material-symbols-outlined text-stone-400 text-base">
                    schedule
                </span>

                                                    <span>
                    <?php echo h($rental["totalDays"] ?? 0); ?> dias
                </span>
                                                </div>

                                                <div class="bg-[#fff8ea] rounded-md p-3 mt-2">
                                                    <p class="text-[10px] uppercase font-black tracking-widest text-[#835400]">
                                                        Total
                                                    </p>

                                                    <p class="text-xl font-black text-[#835400]">
                                                        <?php echo formatMoneyBr($rental["totalAmount"] ?? 0); ?>
                                                    </p>
                                                </div>

                                            </div>

                                            <?php if ($canManage): ?>
                                                <div class="grid grid-cols-2 gap-2 mt-4">

                                                    <form method="POST"
                                                          onsubmit="">

                                                        <input type="hidden"
                                                               name="rental_id"
                                                               value="<?php echo h($rental["rentalId"] ?? ""); ?>">

                                                        <input type="hidden"
                                                               name="rental_action"
                                                               value="complete">

                                                        <button
                                                                type="submit"
                                                                class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded-md text-xs font-bold uppercase">

                                                            Encerrar

                                                        </button>

                                                    </form>

                                                    <form method="POST"
                                                          onsubmit="">

                                                        <input type="hidden"
                                                               name="rental_id"
                                                               value="<?php echo h($rental["rentalId"] ?? ""); ?>">

                                                        <input type="hidden"
                                                               name="rental_action"
                                                               value="cancel">

                                                        <button
                                                                type="submit"
                                                                class="w-full border-2 border-red-500 text-red-500 hover:bg-red-50 py-2 rounded-md text-xs font-bold uppercase">

                                                            Cancelar

                                                        </button>

                                                    </form>

                                                </div>
                                            <?php endif; ?>

                                        </div>

                                    </article>
                                </article>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                </div>
            </section>

          <!-- Tab Content: Histórico -->
            <!-- Tab Content: Histórico -->
            <section id="tab-content-historico"
                     class="tab-content hidden bg-surface-container-lowest rounded-md shadow-sm overflow-hidden">
                <div class="p-8 md:p-10 space-y-10">

                    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                        <div>
                            <h2 class="text-2xl font-black uppercase tracking-tighter">Histórico de Locações</h2>
                            <p class="text-sm text-stone-500 mt-1">Veja todas as suas locações encerradas e canceladas.</p>
                        </div>
                        <a href="?tab=historico"
                           class="inline-flex items-center justify-center gap-2 bg-primary text-white px-4 py-2 rounded-md font-bold text-xs uppercase hover:bg-[#6d4200] transition-colors">
                            <span class="material-symbols-outlined text-sm">refresh</span>
                            Atualizar
                        </a>
                    </div>

                    <?php if ($historyLoadError): ?>
                        <div class="bg-red-50 border border-red-200 p-6 rounded-md">
                            <p class="text-red-700 font-bold text-sm uppercase mb-1">Erro ao carregar histórico</p>
                            <p class="text-red-600 text-sm"><?php echo h($historyLoadError); ?></p>
                        </div>
                    <?php else: ?>

                        <!-- Bloco: Finalizadas -->
                        <div>
                            <div class="flex items-center gap-3 mb-4">
                    <span class="flex items-center justify-center w-7 h-7 rounded-full bg-stone-100 border border-stone-200">
                        <span class="material-symbols-outlined text-stone-500 text-base">check_circle</span>
                    </span>
                                <h3 class="text-sm font-black uppercase tracking-widest text-stone-500">
                                    Finalizadas
                                    <span class="ml-2 text-[10px] bg-stone-100 border border-stone-200 text-stone-500 px-2 py-0.5 rounded-full">
                            <?php echo count($completedRentals); ?>
                        </span>
                                </h3>
                            </div>

                            <?php if (empty($completedRentals)): ?>
                                <div class="bg-surface-container-low p-6 rounded-md border border-stone-200 flex items-center justify-center min-h-32">
                                    <div class="text-center">
                                        <span class="material-symbols-outlined text-stone-300 text-4xl block mb-2">inbox</span>
                                        <p class="text-stone-400 text-sm">Nenhuma locação finalizada ainda.</p>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                                    <?php foreach ($completedRentals as $rental): ?>
                                        <article style="cursor: pointer" onclick="window.location.href = '../PagMaquina/code.php?cd=<?= $rental['listingId'] ?? null?>'" class="bg-white border border-stone-200 rounded-md overflow-hidden shadow-sm hover:shadow-md transition-all">
                                            <div class="h-1 w-full bg-stone-300"></div>
                                            <div class="p-5">
                                                <div class="flex justify-between items-start mb-4">
                                                    <div>
                                                        <p class="text-[10px] font-black uppercase tracking-widest text-stone-400">Locação Encerrada</p>
                                                        <p class="text-sm font-bold text-stone-600 mt-1">
                                                            <?php echo h($rental["providerName"] ?? "Fornecedor"); ?>
                                                        </p>
                                                    </div>
                                                    <span class="inline-flex items-center justify-center px-2 py-1 rounded-full border text-[10px] font-black uppercase bg-stone-100 text-stone-700 border-stone-200">
                                            Concluído
                                        </span>
                                                </div>
                                                <div class="space-y-3">
                                                    <div class="flex items-center gap-2 text-sm text-stone-600">
                                                        <span class="material-symbols-outlined text-stone-400 text-base">calendar_month</span>
                                                        <span>
                                                <?php echo formatDateBr($rental["startDate"] ?? null); ?>
                                                –
                                                <?php echo formatDateBr($rental["endDate"] ?? null); ?>
                                            </span>
                                                    </div>
                                                    <div class="flex items-center gap-2 text-sm text-stone-600">
                                                        <span class="material-symbols-outlined text-stone-400 text-base">schedule</span>
                                                        <span><?php echo h($rental["totalDays"] ?? 0); ?> dias</span>
                                                    </div>
                                                    <div class="bg-[#f4f4f4] rounded-md p-3 mt-2">
                                                        <p class="text-[10px] uppercase font-black tracking-widest text-stone-500">Total pago</p>
                                                        <p class="text-xl font-black text-stone-700">
                                                            <?php echo formatMoneyBr($rental["totalAmount"] ?? 0); ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Divisor -->
                        <div class="border-t border-stone-100"></div>

                        <!-- Bloco: Canceladas -->
                        <div>
                            <div class="flex items-center gap-3 mb-4">
                    <span class="flex items-center justify-center w-7 h-7 rounded-full bg-red-50 border border-red-200">
                        <span class="material-symbols-outlined text-red-400 text-base">cancel</span>
                    </span>
                                <h3 class="text-sm font-black uppercase tracking-widest text-stone-500">
                                    Canceladas
                                    <span class="ml-2 text-[10px] bg-red-50 border border-red-200 text-red-500 px-2 py-0.5 rounded-full">
                            <?php echo count($cancelledRentals); ?>
                        </span>
                                </h3>
                            </div>

                            <?php if (empty($cancelledRentals)): ?>
                                <div class="bg-surface-container-low p-6 rounded-md border border-stone-200 flex items-center justify-center min-h-32">
                                    <div class="text-center">
                                        <span class="material-symbols-outlined text-stone-300 text-4xl block mb-2">check_circle</span>
                                        <p class="text-stone-400 text-sm">Nenhuma locação cancelada. Ótimo!</p>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                                    <?php foreach ($cancelledRentals as $rental): ?>
                                        <article  style="cursor: pointer" onclick="window.location.href = '../PagMaquina/code.php?cd=<?= $rental['listingId'] ?? null?>'" class="bg-white border border-red-100 rounded-md overflow-hidden shadow-sm hover:shadow-md transition-all opacity-80 hover:opacity-100">
                                            <div class="h-1 w-full bg-red-300"></div>
                                            <div class="p-5">
                                                <div class="flex justify-between items-start mb-4">
                                                    <div>
                                                        <p class="text-[10px] font-black uppercase tracking-widest text-stone-400">Locação Cancelada</p>
                                                        <p class="text-sm font-bold text-stone-600 mt-1">
                                                            <?php echo h($rental["providerName"] ?? "Fornecedor"); ?>
                                                        </p>
                                                    </div>
                                                    <span class="inline-flex items-center justify-center px-2 py-1 rounded-full border text-[10px] font-black uppercase bg-red-100 text-red-800 border-red-200">
                                            Cancelado
                                        </span>
                                                </div>
                                                <div class="space-y-3">
                                                    <div class="flex items-center gap-2 text-sm text-stone-600">
                                                        <span class="material-symbols-outlined text-stone-400 text-base">calendar_month</span>
                                                        <span>
                                                <?php echo formatDateBr($rental["startDate"] ?? null); ?>
                                                –
                                                <?php echo formatDateBr($rental["endDate"] ?? null); ?>
                                            </span>
                                                    </div>
                                                    <div class="flex items-center gap-2 text-sm text-stone-600">
                                                        <span class="material-symbols-outlined text-stone-400 text-base">schedule</span>
                                                        <span><?php echo h($rental["totalDays"] ?? 0); ?> dias</span>
                                                    </div>
                                                    <div class="bg-red-50 rounded-md p-3 mt-2">
                                                        <p class="text-[10px] uppercase font-black tracking-widest text-red-400">Valor</p>
                                                        <p class="text-xl font-black text-red-400 line-through decoration-red-300">
                                                            <?php echo formatMoneyBr($rental["totalAmount"] ?? 0); ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                        </div>

                    <?php endif; ?>
                </div>
            </section>

          <!-- Tab Content: Suporte -->
          <section id="tab-content-suporte"
            class="tab-content hidden bg-surface-container-lowest rounded-md shadow-sm overflow-hidden">
            <div class="p-8 md:p-10">
              <h2 class="text-2xl font-black uppercase tracking-tighter mb-6">Suporte</h2>
              <div class="grid grid-cols-1 gap-6">
                <div class="bg-surface-container-low p-6 rounded-md border border-stone-200">
                  <p class="text-stone-400 mb-4">Precisa de ajuda? Entre em contato com nosso time de suporte.</p>
                  <p class="text-stone-600 dark:text-stone-400 mb-4">heavyrent2026@gmail.com</p>
                  <a href="https://mail.google.com/mail/u/2/#inbox?compose=new"
                    class="bg-primary text-white px-4 py-2 rounded-md font-bold text-sm inline-flex items-center gap-2 hover:bg-[#6d4200] transition-colors">
                    <span class="material-symbols-outlined text-sm">mail</span>
                    Enviar Email
                  </a>
                </div>
              </div>
            </div>
          </section>
        </div>
      </main>
    </div>
    <!-- Mobile Bottom Nav -->
    <nav
      class="md:hidden fixed bottom-0 left-0 right-0 bg-surface-container-lowest border-t border-stone-100 flex justify-around items-center py-4 px-6 z-50">
      <a class="text-stone-400 flex flex-col items-center" href="../home/code.php">
        <span class="material-symbols-outlined">dashboard</span>
        <span class="text-[10px] font-bold mt-1 uppercase">Início</span>
      </a>
      <a class="text-stone-400 flex flex-col items-center" href="../VendedorHome/code.php">
        <span class="material-symbols-outlined">calendar_month</span>
        <span class="text-[10px] font-bold mt-1 uppercase">Locações</span>
      </a>
      <a class="text-primary flex flex-col items-center" href="#">
        <span class="material-symbols-outlined">person</span>
        <span class="text-[10px] font-bold mt-1 uppercase">Perfil</span>
      </a>
    </nav>
    <footer id="footer"></footer>
    
    <!-- Modal de Confirmação Desativar Conta -->
    <div id="disableAccountModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
      <div class="bg-white dark:bg-[#1c1b1b] rounded-lg shadow-xl max-w-sm w-full mx-4">
        <div class="p-6 border-b border-stone-200 dark:border-stone-700">
          <h2 class="text-lg font-bold text-on-surface">Desativar Conta</h2>
        </div>
        <div class="p-6 space-y-4">
          <p class="text-stone-600 dark:text-stone-400">Tem certeza que deseja desativar sua conta?</p>
          <div class="bg-red-50 dark:bg-red-950 border border-red-200 dark:border-red-800 rounded p-4">
            <p class="text-xs font-semibold text-red-800 dark:text-red-300 uppercase tracking-widest mb-2">⚠ Atenção</p>
            <p class="text-sm text-red-700 dark:text-red-300">Essa ação desativará sua conta e você não conseguirá acessar o sistema. Seus dados serão preservados, mas você precisará entrar em contato com o suporte para reativar.</p>
          </div>
        </div>
        <div class="p-6 border-t border-stone-200 dark:border-stone-700 flex gap-3">
          <button onclick="closeDisableAccountModal()" class="flex-1 px-4 py-2 border-2 border-stone-300 dark:border-stone-600 text-stone-600 dark:text-stone-400 rounded-md font-bold text-xs uppercase hover:bg-stone-50 dark:hover:bg-stone-900 transition-colors">Cancelar</button>
          <button onclick="confirmDisableAccount()" class="flex-1 px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-md font-bold text-xs uppercase transition-colors">Confirmar Desativação</button>
        </div>
      </div>
    </div>
    
    <script src="../generico/jsgenerico/frame.js?v=vendor-modal-4"></script>
    <script>
      // Funções para gerenciar modal de desativar conta
      function openDisableAccountModal() {
        document.getElementById('disableAccountModal').classList.remove('hidden');
        document.getElementById('disableAccountModal').classList.add('flex');
      }
      
      function closeDisableAccountModal() {
        document.getElementById('disableAccountModal').classList.add('hidden');
        document.getElementById('disableAccountModal').classList.remove('flex');
      }
      
      function confirmDisableAccount() {
        // Redireciona para logout (desativa a conta)
        window.location.href = 'desativarConta.php';
      }
      
      // Fechar modal ao clicar fora dele
      document.addEventListener('click', function(e) {
        const modal = document.getElementById('disableAccountModal');
        if (modal && e.target === modal) {
          closeDisableAccountModal();
        }
      });
      
      document.addEventListener('DOMContentLoaded', function () {
        const tabBtns = document.querySelectorAll('.tab-btn');
        const contentBtns = document.querySelectorAll('.tab-content-btn');
        const contentSections = document.querySelectorAll('.tab-content');

        function showTab(tabName) {
          contentSections.forEach(section => section.classList.add('hidden'));
          contentBtns.forEach(btn => {
            btn.classList.remove('border-primary', 'text-on-surface');
            btn.classList.add('border-transparent', 'text-stone-400');
          });

          const activeSection = document.getElementById(`tab-content-${tabName}`);
          const activeBtn = document.getElementById(`tab-${tabName}-btn`);

          if (activeSection) activeSection.classList.remove('hidden');
          if (activeBtn) {
            activeBtn.classList.add('border-primary', 'text-on-surface');
            activeBtn.classList.remove('border-transparent', 'text-stone-400');
          }

          tabBtns.forEach(btn => {
            if (btn.dataset.tab === tabName) {
              btn.classList.add('text-[#835400]', 'dark:text-[#f9a825]', 'bg-[#ffffff]', 'dark:bg-[#1c1b1b]', 'border-l-4', 'border-[#835400]', 'dark:border-[#f9a825]');
              btn.classList.remove('text-stone-600', 'dark:text-stone-400');
            } else {
              btn.classList.remove('text-[#835400]', 'dark:text-[#f9a825]', 'bg-[#ffffff]', 'dark:bg-[#1c1b1b]', 'border-l-4', 'border-[#835400]', 'dark:border-[#f9a825]');
              btn.classList.add('text-stone-600', 'dark:text-stone-400');
            }
          });

          localStorage.setItem('activeTab', tabName);
        }

        tabBtns.forEach(btn => {
          btn.addEventListener('click', function () {
            showTab(this.dataset.tab);
          });
        });

        contentBtns.forEach(btn => {
          btn.addEventListener('click', function () {
            showTab(this.dataset.contentTab);
          });
        });

        const savedTab = localStorage.getItem('activeTab') || 'perfil';
        showTab(savedTab);
      });
    </script>
  </body>

  </html>

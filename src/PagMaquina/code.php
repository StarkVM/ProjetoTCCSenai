<?php
require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTCCSenai/src/config/session.php';
require_once("../endpoints.php");
$endpoints = new Endpoints();
$listingId = $_GET['cd'];
$erro = isset($_GET['er']) ?? null;
if($erro == 1)
{
    $responseError = "Ocorreu um erro ao alugar, por favor, tente novamente!";
}


$dados = [];

$url = $endpoints->urlListing. "/{$listingId}";


$ch = curl_init($url);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // faz a resposta vir como string
curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json"
]); // tipo do envio

$response = curl_exec($ch);
$statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$data = json_decode($response, true); // tranforma json em array
curl_close($ch);

if ($statusCode >= 200 && $statusCode <= 299) {
    $responseData = json_decode($response, true);

    $dados = $responseData ?? [];
    if($dados == null || empty($dados) || !isset($dados)) {
        header("Location: ../error/code.php?er=404");
        return;
    }


} else {
    header("Location: ../error/code.php?er=404");
    $dados = [];

}
function formatarReais(float $valor): string
{
    return 'R$ ' . number_format($valor, 2, ',', '.');
}

$semDados = "Sem dados";






?>

<!DOCTYPE html>

<html class="light" lang="pt-BR">
<head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>

<title>Heavy Rent | Detalhes da Máquina</title>

<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>

<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

<script id="tailwind-config">
tailwind.config = {
  darkMode: "class",

  theme: {
    extend: {

      colors: {
        background: "#fcf9f8",
        surface: "#fcf9f8",
        "on-background": "#1c1b1b",
        primary: "#835400",
        "primary-container": "#f9a825",
        outline: "#857462",
        "outline-variant": "#d7c3ae",
        "surface-container-lowest": "#ffffff",
        "surface-container-low": "#f6f3f2",
        "surface-container-highest": "#e5e2e1",
        "surface-container": "#f0edec",
        "on-surface": "#1c1b1b",
        "on-surface-variant": "#524434",
        tertiary: "#006687"
      },

      borderRadius: {
        DEFAULT: "0.125rem",
        lg: "0.25rem",
        xl: "0.5rem",
        full: "0.75rem"
      },

      fontFamily: {
        headline: ["Space Grotesk"],
        body: ["Inter"]
      }

    }
  }
}
</script>

<style>

.material-symbols-outlined{
  font-variation-settings:
  'FILL' 0,
  'wght' 400,
  'GRAD' 0,
  'opsz' 24;

  vertical-align: middle;
}

.signature-gradient{
  background: linear-gradient(135deg,#835400 0%,#f9a825 100%);
}

input[type="date"]::-webkit-calendar-picker-indicator{
  cursor:pointer;
}

</style>
</head>

<body class="bg-surface text-on-surface font-body">

<header id="header"></header>

<main class="max-w-[1440px] mx-auto px-6 lg:px-12 py-12">

<!-- TITLE -->
<section class="mb-12">

<div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6">

<div>

<h1
id="nome"
class="text-5xl lg:text-7xl font-headline font-black tracking-tighter uppercase leading-none mb-4"
>
<?= $dados["title"] ?? $semDados; ?>
</h1>

<div class="flex items-center gap-6">

<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-primary">
location_on
</span>

<span id="estado" class="text-sm font-medium">
<?= $dados["pickupCity"] . ", " . $dados["pickupState"]; ?>
</span>
</div>

</div>

</div>

<div class="text-right">

<p class="text-xs uppercase tracking-widest text-outline mb-1">
A partir de
</p>

<p
id="preco"
class="text-4xl font-headline font-bold text-on-surface"
>
R$ <?= $dados["dailyPrice"] ?? $semDados; ?>
</p>

</div>

</div>

</section>

<!-- GALLERY - CAROUSEL -->
<section class="mb-16">

<div class="relative overflow-hidden rounded-md h-[520px] lg:h-[960px] bg-surface-container-low group">

  <!-- Main Image -->
  <img
    id="carouselImage"
    class="w-full h-full object-cover transition-all duration-500"
    alt="Imagem da máquina"
  />

  <!-- Overlay escuro -->
  <div class="absolute inset-0 bg-black/10"></div>

  <!-- Previous Button -->
  <button
    id="prevBtn"
    class="absolute left-4 top-1/2 -translate-y-1/2 z-20 bg-black/50 hover:bg-black/70 text-white p-3 rounded-full transition-all active:scale-95"
    aria-label="Imagem anterior"
  >
    <span class="material-symbols-outlined">
      chevron_left
    </span>
  </button>

  <!-- Next Button -->
  <button
    id="nextBtn"
    class="absolute right-4 top-1/2 -translate-y-1/2 z-20 bg-black/50 hover:bg-black/70 text-white p-3 rounded-full transition-all active:scale-95"
    aria-label="Próxima imagem"
  >
    <span class="material-symbols-outlined">
      chevron_right
    </span>
  </button>

  <!-- Counter -->
  <div class="absolute bottom-4 right-4 bg-black/60 text-white px-3 py-1 rounded-full text-xs font-medium z-20">
    <span id="imageCounter">1</span> /
    <span id="totalImages">5</span>
  </div>

</div>

<!-- Thumbnails -->
<div class="flex justify-center mt-4">
  <div
    id="thumbnailsContainer"
    class="flex gap-2 overflow-x-auto px-2"
  >
  </div>
</div>

</section>

<!-- CONTENT -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-16">

<!-- LEFT -->
<div class="lg:col-span-8 space-y-16">

<!-- ABOUT -->
<div>

<h2 class="text-3xl font-headline font-black uppercase tracking-tighter mb-6">
Sobre esta Máquina
</h2>

<p id="descricao" class="text-on-surface-variant leading-relaxed text-lg max-w-3xl">
O TITAN X-5000 é referência do setor para escavação de alto desempenho.
Projetado para durabilidade extrema em mineração pesada e obras de engenharia civil.
Ideal para valas profundas, preparação de grandes áreas e movimentação de materiais.
</p>

</div>



<!-- LOCATION FOR PICKUP --><!-- Substitua o bloco LOCATION FOR PICKUP -->
    <div>
        <h3 class="text-xl font-headline font-bold uppercase tracking-tight mb-4 text-primary">
            📍 Local para Retirada
        </h3>

        <div class="flex items-center gap-3 bg-surface-container-low p-4 rounded-md">
            <span class="material-symbols-outlined text-primary text-2xl">location_on</span>
            <div>
                <button
                        id="btnLocalizacao"
                        type="button"
                        class="text-base text-tertiary mt-1 hover:underline cursor-pointer font-medium"
                >
                    📍 Ver localização no Google Maps
                </button>
                <p id="estado" class="text-sm text-on-surface mt-1 font-medium"></p>
                <p class="text-xs text-on-surface-variant mt-1">
                    Confirme o local com o vendedor antes de alugar
                </p>
            </div>
        </div>

        <!-- Locador -->
        <div class="flex items-center gap-3 bg-surface-container-low p-4 rounded-md mt-3">
            <span class="material-symbols-outlined text-primary text-2xl">person</span>
            <div>
                <p class="text-[10px] uppercase tracking-widest text-outline font-semibold mb-1">Provedor</p>
                <p id="nomeLocador" class="text-base font-semibold text-on-surface">—</p>
            </div>
        </div>
    </div>

<?php if(!isset($_SESSION["id"]) || $dados["ownerId"] != $_SESSION["id"]):?>
<!-- RIGHT -->
<div class="lg:col-span-4">

<div class="sticky top-24">

<div class="bg-surface-container-lowest p-8 rounded-md shadow-2xl shadow-black/5 border border-outline-variant/20">

<!-- DATE -->
<div class="mb-8">

<p class="text-xs uppercase tracking-widest text-outline mb-4">
Período de Locação
</p>

<div class="grid gap-4">

<!-- START -->
<div class="relative">

<label class="absolute -top-2 left-3 bg-white px-1 text-[10px] uppercase tracking-widest text-outline font-bold">
Data Inicial
</label>

<div class="border-2 border-surface-container-highest rounded p-4">
<input
type="date"
id="startDate"
class="w-full bg-transparent outline-none font-medium"
/>
</div>

</div>

<!-- END -->
<div class="relative">

<label class="absolute -top-2 left-3 bg-white px-1 text-[10px] uppercase tracking-widest text-outline font-bold">
Data Final
</label>

<div class="border-2 border-surface-container-highest rounded p-4">
<input
type="date"
id="endDate"
class="w-full bg-transparent outline-none font-medium"
/>
</div>

</div>

</div>

</div>

<!-- PRICE -->
<div class="space-y-4 mb-8">

  <!-- Extras (operador / frete) - exibidos somente se disponíveis -->
  <div id="extrasOptions" class="mb-2" style="display:none;">
    <div id="operadorOption" class="flex items-center gap-3 mb-1" style="display:none;">
      <input type="checkbox" id="optOperador" />
      <label for="optOperador" class="text-sm">Adicionar operador (<span id="operadorPriceLabel">R$ 0</span>/dia)</label>
    </div>

    <div id="freteOption" class="flex items-center gap-3" style="display:none;">
      <input type="checkbox" id="optFrete" />
      <label for="optFrete" class="text-sm">Adicionar frete (<span id="fretePriceLabel">R$ 0</span>)</label>
    </div>
  </div>

  <div class="flex justify-between text-sm">

    <span class="text-on-surface-variant" id="resumo">
      R$ 0 x 0 dias
    </span>

    <span class="font-bold" id="subtotal">
      R$ 0
    </span>

  </div>



  <div class="flex justify-between text-sm" id="rowOperador" style="display:none;">
    <span class="text-on-surface-variant">Operador</span>
    <span class="font-bold" id="operadorAmount">R$ 0</span>
  </div>

  <div class="flex justify-between text-sm" id="rowFrete" style="display:none;">
    <span class="text-on-surface-variant">Logística / Entrega</span>
    <span class="font-bold text-tertiary" id="freteAmount">GRÁTIS</span>
  </div>

  <div class="h-[1px] bg-surface-container-highest"></div>

  <div class="flex justify-between text-xl font-headline font-black uppercase">

    <span>Preço Total</span>

    <span id="total">
      R$ 0
    </span>

  </div>

</div>

<button onclick="openDisableAccountModal()" class="signature-gradient w-full py-5 rounded-md text-white font-headline font-bold uppercase tracking-widest text-sm active:scale-95 transition-all" >
Alugar Agora
</button>
    <p id="pErro" style="color: red"><?php if(isset($responseError)) echo $responseError;?></p>
</div>

</div>

</div>

</div>
 <?php endif; ?>
</main>

<!-- Modal de Confirmação Desativar Conta -->
<div id="disableAccountModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center z-50">
    <div class="bg-white dark:bg-[#1c1b1b] rounded-lg shadow-xl max-w-sm w-full mx-4">
        <div class="p-6 border-b border-stone-200 dark:border-stone-700">
            <h2 class="text-lg font-bold text-on-surface">Confirmar Aluguel</h2>
        </div>
        <div class="p-6 space-y-4">
            <p class="text-stone-600 dark:text-stone-400">Tem certeza que deseja alugar este equipamento?</p>
            <div class="bg-yellow-50 dark:bg-yellow-950 border border-yellow-200 dark:border-yellow-800 rounded p-4">
                <p class="text-xs font-semibold text-yellow-800 dark:text-yellow-300 uppercase tracking-widest mb-2">⚠ Atenção</p>
                <p class="text-sm text-yellow-700 dark:text-yellow-300">Ao confirmar o aluguel, você concorda com os termos do mesmo e firma um acordo com o provedor.</p>
                <p class="text-sm text-yellow-700 dark:text-yellow-300">termo AKI</p>
            </div>
        </div>
        <div class="p-6 border-t border-stone-200 dark:border-stone-700 flex gap-3">
            <button onclick="closeDisableAccountModal()" class="flex-1 px-4 py-2 border-2 border-stone-300 dark:border-stone-600 text-stone-600 dark:text-stone-400 rounded-md font-bold text-xs uppercase hover:bg-stone-50 dark:hover:bg-stone-900 transition-colors">Cancelar</button>
            <button onclick="confirmDisableAccount()" class="flex-1 px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md font-bold text-xs uppercase transition-colors">Confirmar Aluguel</button>
        </div>
    </div>
</div>
<footer id="footer"></footer>

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

        fetch("/ProjetoTCCSenai/src/PagMaquina/confirmarAluguel.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                listingId: <?php echo json_encode($listingId); ?>,
                startDate: document.getElementById("startDate").value,
                endDate: document.getElementById("endDate").value,
                includeOperator: document.getElementById("optOperador")?.checked,
                includeFreight: document.getElementById("optFrete")?.checked

            })
        }).then(data => {
                if(data.status >= 200 && data.status < 300) {
                    window.location.href = "/ProjetoTCCSenai/src/UserProfile/code.php";
                }
                else{
                    window.location.reload();
                    document.getElementById("pErro").innerText = "Ocorreu um erro ao alugar, por favor, tente novamente!";
                }
            });

    }

    // Fechar modal ao clicar fora dele
    document.addEventListener('click', function(e) {
        const modal = document.getElementById('disableAccountModal');
        if (modal && e.target === modal) {
            closeDisableAccountModal();
        }
    });
// Array com as 5 imagens do carrossel
const dados = <?= json_encode($dados, JSON_UNESCAPED_UNICODE) ?>;


const images = <?= json_encode(
        array_map(
                fn($img) => $img['url'] ?? '',
                $dados['images'] ?? []
        ),
        JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
) ?>;

let currentImageIndex = 0;

// Retorna um objeto `item` normalizado a partir do localStorage


function configurarExtras() {

    const extrasDiv = document.getElementById("extrasOptions");

    const operadorOption =
        document.getElementById("operadorOption");

    const freteOption =
        document.getElementById("freteOption");

    if (dados.operatorAvailable) {

        extrasDiv.style.display = "";

        operadorOption.style.display = "flex";

        document.getElementById(
            "operadorPriceLabel"
        ).textContent =
            `R$ ${Number(
                dados.operatorDailyPrice || 0
            ).toLocaleString("pt-BR")}`;
    }

    if (dados.deliveryAvailable) {

        extrasDiv.style.display = "";

        freteOption.style.display = "flex";

        document.getElementById(
            "fretePriceLabel"
        ).textContent =
            `R$ ${Number(
                dados.deliveryPrice || 0
            ).toLocaleString("pt-BR")}`;
    }

    document
        .getElementById("optOperador")
        ?.addEventListener("change", rentCalc);

    document
        .getElementById("optFrete")
        ?.addEventListener("change", rentCalc);
}

function fillData() {
    document.getElementById("nomeLocador").textContent =
        dados.providerName ?? "Sem dados";
    const enderecoCompleto = [
        dados.pickupZipCode,
        dados.pickupCity,
        dados.pickupState,
        dados.pickupNumber
    ]
        .filter(Boolean)
        .join(", ");

    document
        .getElementById("btnLocalizacao")
        .addEventListener("click", () => {

            window.open(
                "https://www.google.com/maps/search/?api=1&query=" +
                encodeURIComponent(enderecoCompleto),
                "_blank"
            );

        });
    if (!dados) {
        console.warn("Dados da máquina não encontrados.");
        return;
    }

    document.getElementById("nome").textContent =
        dados.title ?? "Sem dados";

    document.getElementById("preco").textContent =
        `R$ ${Number(dados.dailyPrice || 0).toLocaleString("pt-BR", {
            minimumFractionDigits: 2
        })}`;

    document.getElementById("estado").textContent =
        `${dados.pickupZipCode ?? ""} - ${dados.pickupDistrict ?? ""}, ${dados.pickupStreet ?? ""}, n° ${dados.pickupNumber ?? ""}, ${dados.pickupCity ?? ""}, ${dados.pickupState ?? ""}`;

    document.getElementById("descricao").textContent =
        dados.description ?? "Sem descrição disponível.";

    configurarExtras();
}

function initializeCarousel() {
  const carouselImage = document.getElementById("carouselImage");
  const prevBtn = document.getElementById("prevBtn");
  const nextBtn = document.getElementById("nextBtn");
  const imageCounter = document.getElementById("imageCounter");
  const totalImages = document.getElementById("totalImages");
  const thumbnailsContainer = document.getElementById("thumbnailsContainer");

  // Atualizar total de imagens
  totalImages.textContent = images.length;

  // Criar thumbnails
  images.forEach((img, index) => {
    const thumbnail = document.createElement("img");
    thumbnail.src = img;
    thumbnail.alt = `Imagem ${index + 1}`;
    thumbnail.className = `w-24 h-24 object-cover rounded cursor-pointer transition-all ${
      index === 0 ? "ring-2 ring-primary" : "opacity-70 hover:opacity-100"
    }`;
    thumbnail.onclick = () => goToImage(index);
    thumbnailsContainer.appendChild(thumbnail);
  });

  // Função para atualizar a imagem
  function updateImage() {
    carouselImage.src = images[currentImageIndex];
    imageCounter.textContent = currentImageIndex + 1;

    // Atualizar thumbnails
    const thumbnails = thumbnailsContainer.querySelectorAll("img");
    thumbnails.forEach((thumb, index) => {
      if (index === currentImageIndex) {
        thumb.classList.add("ring-2", "ring-primary");
        thumb.classList.remove("opacity-70");
      } else {
        thumb.classList.remove("ring-2", "ring-primary");
        thumb.classList.add("opacity-70");
      }
    });
  }

  // Função para ir para uma imagem específica
  function goToImage(index) {
    currentImageIndex = index;
    updateImage();
  }

  // Botão anterior
  prevBtn.onclick = () => {
    currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
    updateImage();
  };

  // Botão próximo
  nextBtn.onclick = () => {
    currentImageIndex = (currentImageIndex + 1) % images.length;
    updateImage();
  };

  // Inicializar
  updateImage();

  // Navegação com teclado
  document.addEventListener("keydown", (e) => {
    if (e.key === "ArrowLeft") prevBtn.click();
    if (e.key === "ArrowRight") nextBtn.click();
  });
}

function calcularDias(dataInicio, dataFim) {

  const inicio = new Date(dataInicio);
  const fim = new Date(dataFim);

  const diferenca = fim - inicio;

  return Math.ceil(
    diferenca / (1000 * 60 * 60 * 24)
  );
}

function rentCalc() {

    if (!dados) return;

    const startDate =
        document.getElementById("startDate").value;

    const endDate =
        document.getElementById("endDate").value;

    if (!startDate || !endDate)
        return;

    const dias =
        calcularDias(startDate, endDate);

    if (dias <= 0)
        return;

    const precoDiaria =
        Number(dados.dailyPrice || 0);

    const subtotalBase =
        precoDiaria * dias;

    const operadorSelecionado =
        document.getElementById("optOperador")?.checked;

    const freteSelecionado =
        document.getElementById("optFrete")?.checked;

    const operadorValor =
        operadorSelecionado
            ? Number(
            dados.operatorDailyPrice || 0
        ) * dias
            : 0;

    const freteValor =
        freteSelecionado
            ? Number(
                dados.deliveryPrice || 0
            )
            : 0;

    const taxa = 0;

    const total =
        subtotalBase +
        operadorValor +
        freteValor +
        taxa;

    document.getElementById("resumo").textContent =
        `R$ ${precoDiaria.toLocaleString("pt-BR")} x ${dias} dias`;

    document.getElementById("subtotal").textContent =
        `R$ ${subtotalBase.toLocaleString("pt-BR")}`;

    document.getElementById("operadorAmount").textContent =
        `R$ ${operadorValor.toLocaleString("pt-BR")}`;

    document.getElementById("freteAmount").textContent =
        freteValor > 0
            ? `R$ ${freteValor.toLocaleString("pt-BR")}`
            : "GRÁTIS";

    document.getElementById("total").textContent =
        `R$ ${total.toLocaleString("pt-BR")}`;

    document.getElementById("rowOperador").style.display =
        dados.operatorAvailable
            ? ""
            : "none";

    document.getElementById("rowFrete").style.display =
        dados.deliveryAvailable
            ? ""
            : "none";
}



function iniciarAluguel() {
    const dataInicio = document.getElementById("startDate").value;
    const dataFim = document.getElementById("endDate").value;
    const total = document.getElementById("total").textContent;

    if (!dataInicio || !dataFim) {
        console.warn("Por favor, selecione as datas de início e fim da locação.");
        return;
    }

    const item = dados;
    if (!item) {
        console.warn('Erro: Máquina não carregada. Tente novamente.');
        return;
    }

    // Armazenar dados de locação no localStorage (array 'locacoes')
    const dadosLocacao = {
        listingId: dados.id,
        titulo: dados.title,
        precoDiaria: dados.dailyPrice,

        dataInicio,
        dataFim,

        total,

        operador:
            document.getElementById("optOperador")?.checked || false,

        frete:
            document.getElementById("optFrete")?.checked || false
    };

    const locacoes = JSON.parse(localStorage.getItem('locacoes') || '[]');
    locacoes.push(dadosLocacao);
    localStorage.setItem('locacoes', JSON.stringify(locacoes));

    // Atualizar disponibilidade exibida


    // Redirecionar para página de confirmação/checkout
    window.location.href = "../info/code.html";
}

window.addEventListener("DOMContentLoaded", () => {

    fillData();
    initializeCarousel();




    const hoje = new Date();

    const amanha = new Date();
    amanha.setDate(hoje.getDate() + 1);

  function formatar(data) {
    return data.toISOString().split("T")[0];
  }

  document.getElementById("startDate").value =
    formatar(hoje);

  document.getElementById("endDate").value =
    formatar(amanha);

  rentCalc();

  document
    .getElementById("startDate")
    .addEventListener("change", rentCalc);

  document
    .getElementById("endDate")
    .addEventListener("change", rentCalc);

});

</script>

<script src="../generico/jsgenerico/frame.js?v=vendor-modal-4"></script>

</body>
</html>

<?php
error_reporting(0);
require("../auth/auth.php");
require $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTCCSenai/src/config/session.php';

if (isset($_SESSION["type"]) && $_SESSION["type"] != "1") {
  header("Location: /ProjetoTCCSenai/src/modal/code.php");
  exit();
}
$er = $_GET['er'];
$responseError = $er;
?>

<!DOCTYPE html>
<html class="light" lang="pt-BR">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Registrar Equipamentos</title>
  <link
    href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;900&amp;family=Inter:wght@300;400;500;600;700&amp;display=swap"
    rel="stylesheet" />
  <link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
    rel="stylesheet" />
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            background: "#fcf9f8",
            surface: "#fcf9f8",
            "on-background": "#1c1b1b",
            "on-error": "#ffffff",
            "outline-variant": "#d7c3ae",
            "on-secondary": "#ffffff",
            "primary-fixed": "#ffddb5",
            "surface-container-high": "#ebe7e7",
            outline: "#857462",
            "on-primary": "#ffffff",
            "tertiary-container": "#2ac6ff",
            primary: "#835400",
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
            error: "#ba1a1a",
            secondary: "#546067",
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
            tertiary: "#006687",
            "inverse-primary": "#ffb957",
            "surface-container-low": "#f6f3f2",
            "on-tertiary": "#ffffff",
            "error-container": "#ffdad6",
            "on-surface": "#1c1b1b",
            "secondary-fixed": "#d7e4ec",
            "on-primary-container": "#674100"
          },
          borderRadius: {
            DEFAULT: "0.125rem",
            lg: "0.25rem",
            xl: "0.5rem",
            full: "0.75rem"
          },
          fontFamily: {
            headline: ["Space Grotesk"],
            body: ["Inter"],
            label: ["Inter"]
          }
        }
      }
    };
  </script>
  <style>
    .material-symbols-outlined {
      font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    }

    .glass-effect {
      background: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(20px);
    }

    .primary-gradient {
      background: #f9a825;
    }

    .image-slot.has-image {
      border-style: solid;
      border-color: rgba(131, 84, 0, 0.55);
      background: #ffffff;
    }

    .image-slot.has-image .upload-placeholder {
      display: none;
    }

    .image-slot.has-image .image-preview {
      display: block;
    }

    .image-preview {
      display: none;
    }
  </style>
</head>

<body class="bg-surface font-body text-on-surface selection:bg-primary-fixed">
  <header id="header"></header>
  <?php if (isset($responseError)): ?>
    <div
      class="flex items-center justify-center gap-2 bg-red-50 border border-red-200 text-red-700 text-xs font-bold uppercase tracking-wide px-4 py-3 rounded-sm">
      <span class="material-symbols-outlined text-sm">error</span>
      <?= $responseError ?>
    </div>
  <?php endif; ?>
  <main class="max-w-[1440px] mx-auto px-8 py-16 md:py-24">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 mb-20 items-end">
      <div class="lg:col-span-8">
        <h1
          class="font-headline text-6xl md:text-8xl font-black tracking-tighter leading-[0.9] text-on-background mb-6">
          REGISTRAR <span class="text-primary italic">EQUIPAMENTOS.</span>
        </h1>
        <p class="font-body text-lg text-secondary max-w-xl leading-relaxed">
          Registre e gerencie equipamentos pesados com controle total, organiza&ccedil;&atilde;o e agilidade.
          O HeavyRent simplifica a gest&atilde;o da sua frota para opera&ccedil;&otilde;es mais eficientes e
          profissionais.
        </p>
      </div>
      <div class="lg:col-span-4 flex flex-col items-start lg:items-end"></div>
    </div>

    <form class="grid grid-cols-1 lg:grid-cols-12 gap-6" method="post" action="cadastrarAnuncio.php"
      enctype="multipart/form-data">
      <div class="lg:col-span-7 bg-surface-container-low p-8 rounded-md">
        <div class="flex items-center gap-3 mb-8">
          <span class="material-symbols-outlined text-primary"
            style="font-variation-settings: 'FILL' 1;">engineering</span>
          <h2 class="font-headline text-xl font-bold uppercase tracking-tight">Identidade da M&aacute;quina</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div class="flex flex-col gap-2">
            <label for="nomeAtivo" class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">
              Nome do Ativo
            </label>
            <input id="nomeAtivo" name="nomeAtivo" required
              class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium"
              placeholder="Ex: TITAN EX-400" type="text" />
          </div>

          <div class="flex flex-col gap-2">
            <label for="tipoMaquina"
              class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">
              Tipo de M&aacute;quina
            </label>
            <select id="tipoMaquina" name="tipoMaquina" required
              class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium"
              style="cursor: pointer;">
              <option value="0">Desconhecido</option>
              <option value="1">Escavadeira</option>
              <option value="2">Retroescavadeira</option>
              <option value="3">P&aacute; carregadeira</option>
              <option value="4">Empilhadeira</option>
              <option value="5">Guindaste</option>
              <option value="6">Trator de esteira</option>
              <option value="7">Rolo compactador</option>
              <option value="8">Caminh&atilde;o basculante</option>
              <option value="9">Minicarregadeira</option>
              <option value="10">M&aacute;quina agr&iacute;cola</option>
              <option value="99">Outro</option>
            </select>
          </div>

          <div class="flex flex-col gap-2">
            <label for="cep"
              class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">CEP</label>
            <input id="cep" name="cep" required
              class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium"
              placeholder="00000-000" type="text" />
          </div>

          <div class="flex flex-col gap-2">
            <label for="logradouro"
              class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">Endere&ccedil;o</label>
            <input id="logradouro" name="logradouro" readonly required
              class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium"
              placeholder="Rua / Av" type="text" />
          </div>

          <div class="flex flex-col gap-2">
            <label for="bairro"
              class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">Bairro</label>
            <input id="bairro" name="bairro" readonly required
              class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium"
              placeholder="Bairro" type="text" />
          </div>
          <div class="flex flex-col gap-2">
            <label for="numeroCasa"
              class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">Número da
              residência</label>
            <input id="numeroCasa" name="numeroCasa" required
              class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium"
              placeholder="Número da residência" type="text" />
          </div>

          <div class="flex flex-col gap-2">
            <label for="localCidade"
              class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">Cidade</label>
            <input id="localCidade" name="localCidade" readonly required
              class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium"
              placeholder="Cidade" type="text" />
          </div>

          <div class="flex flex-col gap-2">
            <label for="localUF"
              class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">UF</label>
            <input id="localUF" name="localUF" maxlength="2" readonly required
              class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium uppercase"
              placeholder="SP" type="text" />
          </div>

          <div class="md:col-span-2 flex flex-col gap-2">
            <label for="descricao"
              class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">Descri&ccedil;&atilde;o</label>
            <textarea required id="descricao" name="descricao" rows="4"
              class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium"
              placeholder="Descreva o equipamento, condi&ccedil;&otilde;es e observa&ccedil;&otilde;es relevantes"></textarea>
          </div>

          <div class="md:col-span-2 flex flex-col gap-2">
            <label for="precoDiariaMaquina"
              class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">
              Pre&ccedil;o Di&aacute;ria da M&aacute;quina (R$)
            </label>
            <input id="precoDiariaMaquina" name="precoDiariaMaquina" step="0.01" required
              class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium"
              placeholder="0.00" type="number" />
          </div>

          <div class="flex flex-col gap-2">
            <label for="disponibilizaOperador"
              class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">
              Disponibiliza Operador?
            </label>
            <select id="disponibilizaOperador" name="disponibilizaOperador" required
              class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium"
              onchange="
      const container = document.getElementById('container-preco-mao-de-obra');
      const input = document.getElementById('precoDiariaMaoObra');
      const sim = this.value === 'true';
      container.style.display = sim ? '' : 'none';
      input.required = sim;
    ">
              <option value="false">Não</option>
              <option value="true">Sim</option>
            </select>
          </div>

          <div class="flex flex-col gap-2" id="container-preco-mao-de-obra" style="display:none;">
            <label for="precoDiariaMaoObra"
              class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">
              Preço Diária da mão de obra (R$)
            </label>
            <input id="precoDiariaMaoObra" name="precoDiariaMaoObra" step="0.01"
              class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium"
              placeholder="0.00" type="number" />
          </div>

          <div class="flex flex-col gap-2">
            <label for="disponibilizaFrete"
              class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">
              Disponibiliza Frete (Entrega)?
            </label>
            <select id="disponibilizaFrete" name="disponibilizaFrete" required
              class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium"
              onchange="
      const container = document.getElementById('container-preco-frete');
      const input = document.getElementById('precoFrete');
      const sim = this.value === 'true';
      container.style.display = sim ? '' : 'none';
      input.required = sim;
    ">
              <option value="false">Não</option>
              <option value="true">Sim</option>
            </select>
          </div>

          <div class="flex flex-col gap-2" id="container-preco-frete" style="display:none;">
            <label for="precoFrete"
              class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">
              Preço do Frete (R$)
            </label>
            <input id="precoFrete" name="precoFrete" step="0.01"
              class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium"
              placeholder="0.00" type="number" />
          </div>

          <div class="flex flex-col gap-2">
            <label for="tipoUnidade"
              class="font-headline text-[10px] font-bold uppercase tracking-widest text-secondary">
              M&aacute;quina &Uacute;nica ou Frota
            </label>
            <select id="tipoUnidade" name="tipoUnidade" required
              class="bg-surface-container-lowest border-none focus:ring-2 focus:ring-primary-container p-4 rounded-sm font-headline text-sm font-medium">
              <option value="false">&Uacute;nica</option>
              <option value="true">Frota</option>
            </select>
          </div>
        </div>
      </div>

      <div class="lg:col-span-8 bg-surface-container-lowest p-8 rounded-md shadow-sm">
        <div class="flex items-center gap-3 mb-6">
          <span class="material-symbols-outlined text-primary"
            style="font-variation-settings: 'FILL' 1;">add_a_photo</span>
          <h2 class="font-headline text-xl font-bold uppercase tracking-tight">Fotos</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
          <?php for ($i = 1; $i <= 5; $i++) { ?>
            <div class="relative">
              <label for="imagem<?php echo $i; ?>"
                class="image-slot aspect-square bg-surface-container-low rounded-sm border-2 border-dashed border-outline-variant/30 flex flex-col items-center justify-center text-center p-4 hover:bg-surface-container-high transition-colors cursor-pointer overflow-hidden"
                data-slot="<?php echo $i; ?>">
                <img class="image-preview absolute inset-0 h-full w-full object-cover"
                  alt="Pr&eacute;via da imagem <?php echo $i; ?>" />
                <span class="upload-placeholder flex flex-col items-center justify-center gap-2">
                  <span class="material-symbols-outlined text-primary text-3xl">add</span>
                  <span class="font-headline text-[10px] font-bold uppercase tracking-widest">Adicionar imagem</span>
                </span>
              </label>
              <input id="imagem<?php echo $i; ?>" name="imagens[]" type="file" accept="image/*" class="hidden image-input"
                data-slot="<?php echo $i; ?>" multiple />
              <button type="button"
                class="remove-image hidden absolute top-2 right-2 h-8 w-8 rounded-sm bg-on-background/80 text-white items-center justify-center"
                data-slot="<?php echo $i; ?>" aria-label="Remover imagem <?php echo $i; ?>">
                <span class="material-symbols-outlined text-base">close</span>
              </button>
            </div>
          <?php } ?>
        </div>
      </div>

      <div
        class="lg:col-span-12 flex flex-col md:flex-row justify-between items-center gap-8 py-12 border-t border-outline-variant/30 mt-8">
        <button name="registrarMaquina"
          class="w-full md:w-auto px-12 py-6 primary-gradient text-white font-headline text-xl font-black uppercase tracking-tighter rounded-md active:scale-95 transition-all shadow-xl shadow-primary/20 flex items-center justify-center gap-4"
          type="submit">
          REGISTRAR M&Aacute;QUINA
          <span class="material-symbols-outlined">arrow_forward_ios</span>
        </button>
      </div>
    </form>

  </main>

  <footer id="footer"></footer>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      console.log("carregado");
      const form = document.querySelector("form");
      const cepEl = document.getElementById("cep");
      const logradouroEl = document.getElementById("logradouro");
      const bairroEl = document.getElementById("bairro");
      const cidadeEl = document.getElementById("localCidade");
      const ufEl = document.getElementById("localUF");
      const descricaoEl = document.getElementById("descricao");
      const precoDiariaMaquinaEl = document.getElementById("precoDiariaMaquina");
      const disponibilizaOperadorEl = document.getElementById("disponibilizaOperador");
      const containerPrecoMaoObra = document.getElementById("container-preco-mao-de-obra");
      const precoDiariaMaoObraEl = document.getElementById("precoDiariaMaoObra");
      const disponibilizaFreteEl = document.getElementById("disponibilizaFrete");
      const containerPrecoFrete = document.getElementById("container-preco-frete");
      const precoFreteEl = document.getElementById("precoFrete");
      const tipoUnidadeEl = document.getElementById("tipoUnidade");
      const disponibilidadeInicioEl = document.getElementById("disponibilidadeInicio");
      const disponibilidadeFimEl = document.getElementById("disponibilidadeFim");

      async function buscarCEP(cep) {
        const apenasDigitos = cep.replace(/\D/g, "");

        if (apenasDigitos.length !== 8) {
          return;
        }

        try {
          const res = await fetch(`https://viacep.com.br/ws/${apenasDigitos}/json/`);

          if (!res.ok) {
            return;
          }

          const data = await res.json();

          if (data.erro) {
            return;
          }

          logradouroEl.value = data.logradouro || "";
          bairroEl.value = data.bairro || "";
          cidadeEl.value = data.localidade || "";
          ufEl.value = data.uf || "";
        } catch (err) {
          console.warn("Erro ao buscar CEP:", err);
        }
      }

      function atualizarCampoCondicional(selectEl, containerEl, inputEl) {
        console.log("campo atualizado");
        if (!selectEl || !containerEl) {
          return;
        }

        const exibir = selectEl.value === "true";
        containerEl.style.display = exibir ? "block" : "none";
        if (!exibir && inputEl) {
          inputEl.value = "";
        }
      }

      if (disponibilizaOperadorEl) {
        console.log("disponibilizaoperador existe")
        disponibilizaOperadorEl.addEventListener("change", function () {
          atualizarCampoCondicional(disponibilizaOperadorEl, containerPrecoMaoObra, precoDiariaMaoObraEl);
        });
        atualizarCampoCondicional(disponibilizaOperadorEl, containerPrecoMaoObra, precoDiariaMaoObraEl);
      }

      function configurarUploadsDeImagem() {
        document.querySelectorAll(".image-input").forEach(function (input) {
          input.addEventListener("change", function () {
            const slot = input.dataset.slot;
            const file = input.files && input.files[0];
            const label = document.querySelector(`.image-slot[data-slot="${slot}"]`);
            const preview = label ? label.querySelector(".image-preview") : null;
            const removeButton = document.querySelector(`.remove-image[data-slot="${slot}"]`);

            if (!label || !preview || !removeButton) {
              return;
            }

            if (!file) {
              label.classList.remove("has-image");
              preview.removeAttribute("src");
              removeButton.classList.add("hidden");
              removeButton.classList.remove("flex");
              return;
            }

            if (!file.type.startsWith("image/")) {
              alert("Selecione apenas arquivos de imagem.");
              input.value = "";
              label.classList.remove("has-image");
              preview.removeAttribute("src");
              removeButton.classList.add("hidden");
              removeButton.classList.remove("flex");
              return;
            }

            preview.src = URL.createObjectURL(file);
            label.classList.add("has-image");
            removeButton.classList.remove("hidden");
            removeButton.classList.add("flex");
          });
        });

        document.querySelectorAll(".remove-image").forEach(function (button) {
          button.addEventListener("click", function (event) {
            event.preventDefault();
            event.stopPropagation();

            const slot = button.dataset.slot;
            const input = document.querySelector(`.image-input[data-slot="${slot}"]`);
            const label = document.querySelector(`.image-slot[data-slot="${slot}"]`);
            const preview = label ? label.querySelector(".image-preview") : null;

            if (input) {
              input.value = "";
            }

            if (preview) {
              preview.removeAttribute("src");
            }

            if (label) {
              label.classList.remove("has-image");
            }

            button.classList.add("hidden");
            button.classList.remove("flex");
          });
        });
      }

      if (cepEl) {
        cepEl.addEventListener("blur", function () {
          buscarCEP(cepEl.value || "");
        });
      }


      if (disponibilizaFreteEl) {
        disponibilizaFreteEl.addEventListener("change", function () {
          atualizarCampoCondicional(disponibilizaFreteEl, containerPrecoFrete, precoFreteEl);
        });
        atualizarCampoCondicional(disponibilizaFreteEl, containerPrecoFrete, precoFreteEl);
      }

      configurarUploadsDeImagem();

      if (form) {
        form.addEventListener("submit", function () {
          const imagensSelecionadas = Array.from(document.querySelectorAll(".image-input"))
            .map(function (input) {
              return input.files && input.files[0] ? input.files[0].name : "";
            })
            .filter(Boolean);

          const dadosMaquina = {
            nome: (document.getElementById("nomeAtivo")?.value || "").trim(),
            tipo: (document.getElementById("tipoMaquina")?.value || "").trim(),
            marca: (document.getElementById("marca")?.value || "").trim(),
            cep: cepEl?.value || "",
            endereco: {
              logradouro: logradouroEl?.value || "",
              bairro: bairroEl?.value || "",
              cidade: cidadeEl?.value || "",
              uf: ufEl?.value || ""
            },
            descricao: descricaoEl?.value || "",
            precoDiariaMaquina: precoDiariaMaquinaEl?.value || "",
            disponibilizaOperador: disponibilizaOperadorEl?.value === "yes",
            precoDiariaMaoObra: precoDiariaMaoObraEl?.value || "",
            disponibilizaFrete: disponibilizaFreteEl?.value === "yes",
            precoFrete: precoFreteEl?.value || "",
            tipoUnidade: tipoUnidadeEl?.value || "unica",
            disponibilidadeInicio: disponibilidadeInicioEl?.value || "",
            disponibilidadeFim: disponibilidadeFimEl?.value || "",
            imagens: imagensSelecionadas
          };

          localStorage.setItem("maquinaCadastrada", JSON.stringify(dadosMaquina));
        });
      }
    });
  </script>

  <script src="../generico/jsgenerico/frame.js?v=vendor-modal-4"></script>
</body>

</html>
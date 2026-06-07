// carregar header com detecção de idioma (pt-BR ou en)
const userLang = navigator.language || navigator.userLanguage || 'pt-BR';
const lang = userLang.startsWith('en') ? 'en' : 'pt-BR';

function openVendorModal() {
    const vendorModal = document.getElementById("vendorModal");

    if (vendorModal) {
        vendorModal.classList.remove("hidden");
        document.body.classList.add("overflow-hidden");
    }
}

function closeVendorModal() {
    const vendorModal = document.getElementById("vendorModal");

    if (vendorModal) {
        vendorModal.classList.add("hidden");
        document.body.classList.remove("overflow-hidden");
    }
}

function confirmVendor() {
    fetch(`/ProjetoTCCSenai/src/UserProfile/provider.php`)
        .then(resposta => {
            if (!resposta.ok) {
                throw new Error(`Erro HTTP: ${resposta.status}`);
            }
            return resposta.json();
        })
        .then(dados => {
            if (dados.status === "failed") {
                throw new Error('Falha ao confirmar o vendedor');
            }

            // Aqui o fetch foi bem-sucedido e provider.php retornou status success.
            // Se quiser manter a página atual, atualize o DOM ou feche o modal.
            closeVendorModal();
            console.log('Vendor confirmado com sucesso', dados);
        })
        .catch(erro => {
            console.error('Erro na requisição:', erro.message);
        });
}

function initVendorModal() {
    const openButton = document.getElementById("openVendorModalButton");
    const overlay = document.getElementById("vendorModalOverlay");

    if (openButton) {
        openButton.addEventListener("click", openVendorModal);
    }

    if (overlay) {
        overlay.addEventListener("click", closeVendorModal);
    }
}

window.openVendorModal = openVendorModal;
window.closeVendorModal = closeVendorModal;
window.confirmVendor = confirmVendor;

fetch("/ProjetoTCCSenai/src/generico/phpgenerico/statusUsuario.php")
    .then(r => r.json())
    .then(data => {

        let headerPath;

        if (data.status === "logged") {
            headerPath = `/ProjetoTCCSenai/src/generico/htmlgenerico/headerLogado.php`;

        } else if (data.status === "super") {
            headerPath = `/ProjetoTCCSenai/src/generico/htmlgenerico/headersuperautenticado.php`;

        } else {
            headerPath = `/ProjetoTCCSenai/src/generico/htmlgenerico/header.html`;
        }

        return fetch(`${headerPath}?v=vendor-modal-4`);
    })
    .then(r => r.text())
    .then(html => {
        document.getElementById("header").innerHTML = html;
        initVendorModal();
    });

fetch(`/ProjetoTCCSenai/src/generico/htmlgenerico/footer.html`)
    .then(r => r.text())
    .then(html => {
        document.getElementById("footer").innerHTML = html;
    });


// menu mobile
function toggleMenu() {
  const menu = document.getElementById("navMenu");
  menu.classList.toggle("show");
}

// salvar a página onde o usuário está
function salvarUltimaPagina() {
  fetch("/ProjetoTCCSenai/src/controllers/ondeParou.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify({
      url: window.location.pathname
    })
  });
}

// salva a cada 1 segundo
window.addEventListener("beforeunload", () => {
    salvarUltimaPagina();
});

document.addEventListener("keydown", (event) => {
    if (event.key === "Escape") {
        closeVendorModal();
    }
});


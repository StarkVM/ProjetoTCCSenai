// carregar header com detecção de idioma (pt-BR ou en)
const userLang = navigator.language || navigator.userLanguage || 'pt-BR';
const lang = userLang.startsWith('en') ? 'en' : 'pt-BR';

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

        return fetch(headerPath);
    })
    .then(r => r.text())
    .then(html => {
        document.getElementById("header").innerHTML = html;
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
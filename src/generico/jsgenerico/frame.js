// carregar header com detecção de idioma (pt-BR ou en)
const userLang = navigator.language || navigator.userLanguage || 'pt-BR';
const lang = userLang.startsWith('en') ? 'en' : 'pt-BR';

fetch("/ProjetoTCCSenai/src/generico/phpgenerico/statusUsuario.php")
  .then(r => r.json())
  .then(data => {
    let headerPath;

    if (data.status === "logged") {
      headerPath = `/ProjetoTCCSenai/src/generico/htmlgenerico/headerLogado.${lang}.html`;
    } else if (data.status === "super") {
      headerPath = `/ProjetoTCCSenai/src/generico/htmlgenerico/headersuperautenticado.${lang}.html`;
    } else {
      headerPath = `/ProjetoTCCSenai/src/generico/htmlgenerico/header.${lang}.html`;
    }

    return fetch(headerPath);
  })
  .then(r => r.text())
  .then(html => {
    document.getElementById("header").innerHTML = html;
  });

// carregar footer com idioma
fetch(`../generico/htmlgenerico/footer.${lang}.html`)
  .then(r => r.text())
  .then(html => document.getElementById("footer").innerHTML = html);


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
setInterval(() => {
  salvarUltimaPagina();
}, 1000);
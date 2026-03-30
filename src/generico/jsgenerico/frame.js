// carregar header
fetch("../generico/htmlgenerico/header.html")
  .then(r => r.text())
  .then(html => document.getElementById("header").innerHTML = html);

// carregar footer
fetch("../generico/htmlgenerico/footer.html")
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
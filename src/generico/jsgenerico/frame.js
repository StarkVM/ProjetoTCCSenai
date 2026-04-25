// carregar header
fetch("/ProjetoTCCSenai/src/controllers/statusUsuario.php")
  .then(r => r.json())
  .then(data => {
    let headerPath;

    if (data.status === "guest") { //VISITANTE
      headerPath = "../generico/htmlgenerico/header_guest.html";
    } else if (data.status === "logged") { //LOGADO
      headerPath = "../generico/htmlgenerico/headerLogado.html";
    } else if (data.status === "super") { //SUPERAUTENTICADO
      headerPath = "../generico/htmlgenerico/headersuperautenticado.html";
    }

    return fetch(headerPath);
  })
  .then(r => r.text())
  .then(html => {
    document.getElementById("header").innerHTML = html;
  });

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
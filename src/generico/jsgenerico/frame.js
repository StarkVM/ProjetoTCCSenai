fetch("../generico/htmlgenerico/header.html")
  .then(r => r.text())
  .then(html => document.getElementById("header").innerHTML = html);

fetch("../generico/htmlgenerico/footer.html")
  .then(r => r.text())
  .then(html => document.getElementById("footer").innerHTML = html);

  function toggleMenu() {
  const menu = document.getElementById("navMenu");
  menu.classList.toggle("show");
}

// salva a pagina que o usuario está
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

setInterval(() => {
    salvarUltimaPagina();
}, 1000); // a cada 1 segundos
fetch("../generico/htmlgenerico/header.html")
  .then(r => r.text())
  .then(html => document.getElementById("header").innerHTML = html);

fetch("../generico/htmlgenerico/footer.html")
  .then(r => r.text())
  .then(html => document.getElementById("footer").innerHTML = html);
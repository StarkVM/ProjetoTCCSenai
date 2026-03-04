const anuncio = JSON.parse(localStorage.getItem("anuncioSelecionado"));
const container = document.getElementById("anuncioDetalhe");

if (!anuncio) {
  container.innerHTML = "<p>Anúncio não encontrado.</p>";
} else {
  container.innerHTML = `
    <img src="${anuncio.imagem}" alt="${anuncio.nome}">
    <h1>${anuncio.nome}</h1>
    <p class="preco">${anuncio.preco}</p>

    <p class="descricao">
      Máquina em excelente estado, pronta para locação.
      Ideal para obras, construção civil e serviços pesados.
    </p>

    <button>Entrar em contato</button>
  `;
}
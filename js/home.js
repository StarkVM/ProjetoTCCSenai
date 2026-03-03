//PEGAR NO BACK-END LÁ OS  BGL
const anuncios = [
  {
    id: 1,
    nome: "Escavadeira Hidráulica",
    preco: "R$ 1.500 / dia",
    imagem: "https://picsum.photos/400/250?random=1"
  },
  {
    id: 2,
    nome: "Trator Agrícola",
    preco: "R$ 900 / dia",
    imagem: "https://picsum.photos/400/250?random=2"
  },
  {
    id: 3,
    nome: "Guindaste",
    preco: "R$ 2.300/ dia",
    imagem: "https://picsum.photos/400/250?random=3"
  },
  {
    id: 4,
    nome: "AAAAAAAA",
    preço: "AAAAAAA",
    imagem: "https://picsum.photos/400/250?random=4"
  },
    {
    id: 5,
    nome: "AAAAAAAA",
    preço: "AAAAAAA",
    imagem: "https://picsum.photos/400/250?random=5"
  }
];

const grid = document.getElementById("productGrid");

anuncios.forEach(anuncio => {
  const card = document.createElement("div");
  card.className = "product-card";

  card.innerHTML = `
    <img src="${anuncio.imagem}" alt="${anuncio.nome}">
    <h3>${anuncio.nome}</h3>
    <p>${anuncio.preco}</p>
    <button>Ver anúncio</button>
  `;

  card.addEventListener("click", () => {
    localStorage.setItem("anuncioSelecionado", JSON.stringify(anuncio));
    window.location.href = "anuncio.html";
  });

  grid.appendChild(card);
});
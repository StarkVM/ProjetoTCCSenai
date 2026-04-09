const container = document.getElementById('cards-container');

//OBJETO RETORNADO PELO HP
const dados = [
  {
    nome: "Escavadeira CAT 320",
    preco: "R$ 250/h",
    estado: "São Paulo"
  },
  {
    nome: "Retroescavadeira JCB 3CX",
    preco: "R$ 180/h",
    estado: "Rio de Janeiro"
  },
  {
    nome: "Pá Carregadeira Volvo L90",
    preco: "R$ 220/h",
    estado: "Minas Gerais"
  },
  {
    nome: "Mini Escavadeira Bobcat E35",
    preco: "R$ 150/h",
    estado: "Paraná"
  },
  {
    nome: "Trator Massey Ferguson 4292",
    preco: "R$ 120/h",
    estado: "Bahia"
  }
];

function saveData(obj){
  console.log(obj);
  try{
    localStorage.setItem("item", JSON.stringify(obj));
    window.location.href = "../PagMaquina/code.html";
  }
  
  catch{
    console.log("Erro aí");
  }
}

// chama a função
spareData(dados);

//FUNÇÃO QUE GERA OS CARDS. O OBJECTS DEVE SER A LISTA RETORNADA PELO SELECT
function spareData(objects) {
  objects.forEach((object, index) => {
    container.innerHTML += `
<div class="bg-surface-container-lowest rounded-md overflow-hidden group hover:shadow-xl transition-all duration-500">
<div class="relative h-64 overflow-hidden">
<img class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110" data-alt="Side profile of a massive yellow excavator on soft dirt background, high detail of metal textures and hydraulic systems" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD9g0uDW7jGhHadDJ0uWd-nmJ-LdiERqxS-jTKbc3nTExf6wEz9GK9-dmsoiowW-LktsTSoninTrYjORvc_iF2mffDUuet1xHrCNVJBXwFK0kjlGKUg2PQOzyL4aIPkeXEw4g8OSQ-srEjnae8mlNO3X5ajxQqWFGXsQ3Tl521s3zs3mmlg8WC1vR20_0K3u720AsOYIwHrxCiN4WB5YEVMz7zZbVZ7gw_5wN51l7dAmK3hlV7s8v3amdhiMcNoauysaceOANGQARF2"/>
<div class="absolute top-4 left-4 bg-primary text-on-primary text-[10px] font-bold uppercase tracking-[0.2em] px-3 py-1 rounded-sm">Available</div>
</div>
<div class="p-8">
<div class="flex justify-between items-start mb-4">
<h3 class="font-headline text-xl font-bold uppercase tracking-tight">${object.nome}</h3>
<div class="flex items-center gap-1 bg-tertiary-container/20 text-on-tertiary-container px-2 py-1 rounded-sm">
<span class="material-symbols-outlined text-sm" style="font-variation-settings: 'FILL' 1;">verified</span>
<span class="font-label text-xs font-black">9.8</span>
</div>
</div>
<div class="grid grid-cols-2 gap-4 mb-6">
<div class="bg-surface-container px-3 py-2 rounded-sm">
<p class="text-[10px] text-on-surface-variant font-bold uppercase tracking-tighter mb-1">Price/Hour</p>
<p class="font-headline font-bold text-primary">${object.preco}</p>
</div>
<div class="bg-surface-container px-3 py-2 rounded-sm">
<p class="text-[10px] text-on-surface-variant font-bold uppercase tracking-tighter mb-1">Location</p>
<p class="font-headline font-bold text-on-surface truncate">${object.estado}</p>
</div>
</div>
<button class="w-full border-2 border-primary text-primary font-headline font-bold uppercase py-3 rounded-sm hover:bg-primary hover:text-on-primary transition-all duration-300" onclick='saveData(${JSON.stringify(object)})'>
                                Request Rental
                            </button>
</div>
</div>
    `;
    console.log(`${index}: ${object.nome}`);
  });
}
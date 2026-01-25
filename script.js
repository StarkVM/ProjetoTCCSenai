//VIACEP API
let cepField = document.getElementById("cep");

if(cepField){
  cepField.addEventListener("input", function(){
      const cep = cepField.value
    fetch(`https://viacep.com.br/ws/${cep}/json/`)
      .then(response => response.json())
      .then(data => {
        if (data.erro) {
          console.log("CEP não encontrado!");
      
        } else {
          console.log(data); 

          document.getElementById('rua').value = data.logradouro;
          document.getElementById('bairro').value = data.bairro;
          document.getElementById('cidade').value = data.localidade;
          document.getElementById('estado').value = data.uf;
        }
      })
      .catch(error => {
        console.error("Erro na requisição:", error);
      });
  });
}


//MENU HAMBÚRGUER
const menuToggle = document.getElementById("menuToggle");
const navLinks = document.getElementById("navLinks");

menuToggle.addEventListener("click", () => {
  navLinks.classList.toggle("active");
});
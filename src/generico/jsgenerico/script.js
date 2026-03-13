//VIACEP API
let cepField = document.getElementById("cep");
let button = document.getElementById("submitbutton");
button.disabled = true;
if(cepField){
  cepField.addEventListener("input", function(){
      const cep = cepField.value
      if(cep < 8){
        button.disabled = true;
      }
    fetch(`https://viacep.com.br/ws/${cep}/json/`)
      .then(response => response.json())
      .then(data => {
        if (data.erro) {
          document.getElementById("cepErro").innerText = "CEP não encontrado!";
          document.getElementById("cep").value = "";
          console.log("CEP não encontrado!");
          button.disabled = true;
      
        } else {
          console.log(data); 

          document.getElementById('rua').value = data.logradouro;
          document.getElementById('bairro').value = data.bairro;
          document.getElementById('cidade').value = data.localidade;
          document.getElementById('estado').value = data.uf;
          button.disabled = false;
        }
      })
      .catch(error => {
        console.error("Erro na requisição:", error);
      });
  });
}

function mostrarSenha() {
            const senha = document.getElementById("senha");
            if (senha.type === "password") {
                senha.type = "text";
                document.getElementById("mostrarsenha").innerText = "Esconder";
            } else {
                senha.type = "password";
                document.getElementById("mostrarsenha").innerText = "Mostrar";
            }
        }

/*MENU HAMBÚRGUER

const menuToggle = document.getElementById("menuToggle");
const navLinks = document.getElementById("navLinks");

menuToggle.addEventListener("click", () => {
  navLinks.classList.toggle("active");
});

*/
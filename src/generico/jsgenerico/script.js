//Limpar campos ao carregar a página, isso evita alguns bugs:
document.addEventListener("DOMContentLoaded", () => {
  cpfField.value = null;
  cepField.value = null;
  senha1.value = null;
  senha2.value = null;
})


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

//olhinho do "mostrar senha"
function mostrarSenha(pswrd, eye) {
  const senha = document.getElementById(pswrd);
  const elemento = document.getElementById(eye);
  if (senha.type === "password") {
      senha.type = "text";
      elemento.classList.remove("bi-eye-slash")
      elemento.classList.add("bi-eye");
      
  } else {
      senha.type = "password";
      elemento.classList.remove("bi-eye")
      elemento.classList.add("bi-eye-slash");
  }
}

//Confirme sua sneha
let senha1 = document.getElementById("senha1");
let senha2 = document.getElementById("senha2");

if(senha1 || senha2){

  senha1.addEventListener("input", () => confirmarSenha());
  senha2.addEventListener("input", () => confirmarSenha());
  
}

function confirmarSenha(){
  console.log("bostas")
  if(senha1.value == senha2.value){
    button.disabled = false;
  }
  else{
    console.log("Senha diferente");
    button.disabled = true;
  }
}

//VERIFICAÇÃO DE CPF
let cpfField = document.getElementById("cpf");

if(cpfField){
  cpfField.addEventListener("input", () => {
  let cpf = cpfField.value.replace(/\D/g, "");
  
  let valido = TestaCPF(cpf);
  
  if(valido){
    button.disabled = false;
  }
  else{
    button.disabled = true;
  }
});
}

function TestaCPF(strCPF) {
    var Soma;
    var Resto;
    Soma = 0;
  if (strCPF == "00000000000") return false;

  for (let i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
  Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

  Soma = 0;
    for (let i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;

    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
    return true;
}

/*MENU HAMBÚRGUER

const menuToggle = document.getElementById("menuToggle");
const navLinks = document.getElementById("navLinks");

menuToggle.addEventListener("click", () => {
  navLinks.classList.toggle("active");
});

*/
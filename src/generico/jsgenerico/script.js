// limpar campos ao carregar a página
document.addEventListener("DOMContentLoaded", () => {
  if (cpfField) cpfField.value = "";
  if (cepField) cepField.value = "";
  if (senha1) senha1.value = "";
  if (senha2) senha2.value = "";
});

// CAMPOS
const cepField = document.getElementById("cep");
const button = document.getElementById("submitbutton");
const senha1 = document.getElementById("senha1");
const senha2 = document.getElementById("senha2");
const cpfField = document.getElementById("cpf");
const termbox = document.getElementById("termbox");

let cepcondition = false;
let passwordcondition = false;
let cpfcondition = false;
let termboxcondition = false;

// botão começa desativado
if (button) button.disabled = true;

// =========================
// VIACEP API
// =========================
if (cepField) {
  cepField.addEventListener("input", function () {
    const cep = cepField.value.replace(/\D/g, "");

    if (cep.length < 8) {
      cepcondition = false;
      atualizarBotao();
      return;
    }

    fetch(`https://viacep.com.br/ws/${cep}/json/`)
      .then(response => response.json())
      .then(data => {

        if (data.erro) {
          document.getElementById("cepErro").innerText = "CEP não encontrado!";
          cepcondition = false;
          atualizarBotao();
        } else {
          document.getElementById('rua').value = data.logradouro;
          document.getElementById('bairro').value = data.bairro;
          document.getElementById('cidade').value = data.localidade;
          document.getElementById('estado').value = data.uf;
          cepcondition = true;
          console.log("CEP CONFIRMADO")
          atualizarBotao();
        }

      })
      .catch(error => {
        console.error("Erro na requisição:", error);
      });
  });
}

// =========================
// MOSTRAR SENHA (OLHINHO)
// =========================
function toggleSenha(id, element) {
  const input = document.getElementById(id);

  if (input.type === "password") {
    input.type = "text";
    element.textContent = "visibility_off";
  } else {
    input.type = "password";
    element.textContent = "visibility";
  }
}
// =========================
// CONFIRMAR SENHA
// =========================
if (senha1 && senha2) {
  senha1.addEventListener("input", confirmarSenha);
  senha2.addEventListener("input", confirmarSenha);
}
//CAIXA DE TERMOS
if (termbox) {
  termbox.addEventListener("change", (e) => {
    if (e.target.checked) {
      termboxcondition = true;
    } else {
      termboxcondition = false;
    }
    atualizarBotao();
  });
}
function confirmarSenha() {

  function validar() {
    if (senha1.value === senha2.value) {

      if (senha1.value.length < 8) {
        document.getElementById("erroSenha").innerText = "A senha deve ter pelo menos 8 caracteres!";
        passwordcondition = false;
      } else {
        document.getElementById("erroSenha").innerText = "";
        console.log("SENHA CONFIRMADA");
        passwordcondition = true;
      }

    } else {
      document.getElementById("erroSenha").innerText = "As senhas não coincidem!";
      passwordcondition = false;
    }

    atualizarBotao();
  }

  // escuta os DOIS campos
  senha1.addEventListener("input", validar);
  senha2.addEventListener("input", validar);
}

// =========================
// VALIDAÇÃO DE CPF
// =========================
if (cpfField) {
  cpfField.addEventListener("input", () => {
    let cpf = cpfField.value.replace(/\D/g, "");

    if (TestaCPF(cpf)) {
      cpfcondition = true;
      console.log("CPF CONFIRMADA")
      atualizarBotao();
    } else {
      cpfcondition = false;
      atualizarBotao();

    }
  });
}

function atualizarBotao(){
  if(cepcondition && cpfcondition && passwordcondition){
    button.disabled = false;
  }
  else{
    button.disabled = true;
  }  
}


function TestaCPF(strCPF) {
  let Soma = 0;
  let Resto;

  if (strCPF == "00000000000") return false;

  for (let i = 1; i <= 9; i++)
    Soma += parseInt(strCPF.substring(i - 1, i)) * (11 - i);

  Resto = (Soma * 10) % 11;
  if (Resto == 10 || Resto == 11) Resto = 0;
  if (Resto != parseInt(strCPF.substring(9, 10))) return false;

  Soma = 0;

  for (let i = 1; i <= 10; i++)
    Soma += parseInt(strCPF.substring(i - 1, i)) * (12 - i);

  Resto = (Soma * 10) % 11;
  if (Resto == 10 || Resto == 11) Resto = 0;
  if (Resto != parseInt(strCPF.substring(10, 11))) return false;

  return true;
}
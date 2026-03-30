// limpar campos ao carregar a página
document.addEventListener("DOMContentLoaded", () => {
  if (cpfField) cpfField.value = "";
  if (cepField) cepField.value = "";
  if (senha1) senha1.value = "";
  if (senha2) senha2.value = "";
});

// CAMPOS
let cepField = document.getElementById("cep");
let button = document.getElementById("submitbutton");
let senha1 = document.getElementById("senha1");
let senha2 = document.getElementById("senha2");
let cpfField = document.getElementById("cpf");

// botão começa desativado
if (button) button.disabled = true;

// =========================
// VIACEP API
// =========================
if (cepField) {
  cepField.addEventListener("input", function () {
    const cep = cepField.value.replace(/\D/g, "");

    if (cep.length < 8) {
      button.disabled = true;
      return;
    }

    fetch(`https://viacep.com.br/ws/${cep}/json/`)
      .then(response => response.json())
      .then(data => {

        if (data.erro) {
          document.getElementById("cepErro").innerText = "CEP não encontrado!";
          button.disabled = true;
        } else {
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

// =========================
// MOSTRAR SENHA (OLHINHO)
// =========================
function mostrarSenha(idSenha, idIcon) {
  const senha = document.getElementById(idSenha);
  const icon = document.getElementById(idIcon);

  if (senha.type === "password") {
    senha.type = "text";
    icon.classList.remove("bi-eye-slash");
    icon.classList.add("bi-eye");
  } else {
    senha.type = "password";
    icon.classList.remove("bi-eye");
    icon.classList.add("bi-eye-slash");
  }
}

// =========================
// CONFIRMAR SENHA
// =========================
if (senha1 && senha2) {
  senha1.addEventListener("input", confirmarSenha);
  senha2.addEventListener("input", confirmarSenha);
}

function confirmarSenha() {
  if (senha1.value === senha2.value) {
    document.getElementById("erroSenha").innerText = "";
    button.disabled = false;
  } else {
    document.getElementById("erroSenha").innerText = "As senhas não coincidem!";
    button.disabled = true;
  }
}

// =========================
// VALIDAÇÃO DE CPF
// =========================
if (cpfField) {
  cpfField.addEventListener("input", () => {
    let cpf = cpfField.value.replace(/\D/g, "");

    if (TestaCPF(cpf)) {
      button.disabled = false;
    } else {
      button.disabled = true;
    }
  });
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
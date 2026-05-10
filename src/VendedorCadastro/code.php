<?php

session_start();
error_reporting(0);

// VERIFICAR SE O USUÁRIO ESTÁ LOGADO
if (!isset($_SESSION['user'])) {
    header('Location: ../login/code.php');
    exit;
}

// SE OCORRER ALGUM ERRO NO CADASTRO, É GETADO O CODIGO DA URL E É MOSTRADO PARA O CLIENTE
$er = $_GET['er'] ?? null;
if(isset($er) && !empty($er))
{
    switch ($er)
    {
        case "Business profile already exists.":
            $responseError = "Perfil comercial já existe.";
            break;
        case "Database save failed.":
            $responseError = "Ocorreu um erro ao processar os dados, por favor, tente novamente.";
            break;
        case "Invalid user data.":
            $responseError = "Dados do usuário inválidos.";
            break;
        case "0":
            $responseError = "Ocorreu um erro inesperado, por favor, tente novamente.";
            break;
        case "1":
            $responseError = "Falha ao atualizar perfil. Por favor, tente novamente.";
            break;
        default:
            $responseError = "Ocorreu um erro ao processar a requisição, por favor, tente novamente.";
            break;
    }
}

// OBTER DADOS DO USUÁRIO LOGADO
$userData = $_SESSION['user'] ?? [];
$nomeCompleto = $userData['firstName'] . ' ' . $userData['lastName'];

?>

<!DOCTYPE html>

<html class="light" lang="pt-BR"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
<link href="../cadastro/cadastro.css" rel="stylesheet"/>
<style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .signature-gradient {
            background: linear-gradient(135deg, #835400 0%, #f9a825 100%);
        }
        .glass-panel {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
        }
    </style>
</head>
<body class="bg-surface font-body text-on-surface selection:bg-primary-fixed selection:text-on-primary-fixed">
<div class="min-h-screen flex flex-col md:flex-row">
<!-- Left Column: Branding and Imagery -->
<div class="relative w-full md:w-1/2 lg:w-[60%] h-64 md:h-auto overflow-hidden bg-on-background">
<div class="absolute inset-0 z-0">
<img alt="Vendedor de equipamentos" class="w-full h-full object-cover opacity-60 grayscale hover:grayscale-0 transition-all duration-700" src="https://lh3.googleusercontent.com/aida-public/AB6AXuB-6ev4WxiieivgIb66SpWY2arkN2yITvwjeuHuUSuk5VAxB3tno5_EoJIpRYVY62MXErOdcUf5gJlblc0WMV5Mn5tSkJ6dJihHUfjD8MLbYYMb-cBWz5YvTvOyZqP7UMJDC17qOgAQgKKmCIfPlmHKGck9WbsgeZ7GcPmoODX76RJUNnFMJwt6Ml6k-_SldReVycHGjVsN0hWoQCKbEfOgA83ZKWHlac_iucCSpIjtdwFdJQbfGgYv6qvWSrdTTYK1Zmj932-NbVYO"/>
</div>
<div class="absolute inset-0 bg-gradient-to-t from-on-background via-transparent to-transparent opacity-80"></div>
<div class="relative z-10 h-full flex flex-col justify-between p-8 md:p-16">
<div class="flex items-center gap-2">
<span class="font-headline text-3xl font-black tracking-tighter text-surface uppercase">Heavy Rent</span>
</div>
<div class="max-w-xl">
<h1 class="font-headline text-5xl md:text-7xl font-bold text-surface tracking-tighter leading-none mb-6">
                        TORNE-SE UM <span class="text-primary-container">VENDEDOR</span> AGORA.
                    </h1>
<p class="font-label text-surface/70 uppercase tracking-widest text-sm max-w-md">
                        Expanda seus negócios e chegue a mais clientes na plataforma Heavy Rent.
                    </p>
</div>
</div>
</div>
<!-- Right Column: Registration Form -->
<div class="w-full md:w-1/2 lg:w-[40%] flex items-center justify-center p-6 md:p-12 lg:p-20 bg-surface">
<div class="w-full max-w-md">
<div class="mb-10">
<h2 class="font-headline text-3xl font-bold tracking-tight text-on-surface mb-2">CADASTRO VENDEDOR</h2>
<div class="h-1 w-12 bg-primary"></div>
</div>
<form method="POST" class="space-y-10 max-w-2xl mx-auto" action="cadastroVendedorB.php">

<!-- DADOS DO USUÁRIO LOGADO (SOMENTE LEITURA) -->
<div class="space-y-4">
  <h3 class="text-lg font-bold text-on-surface">Seus Dados</h3>

  <input type="text" value="<?php echo $nomeCompleto; ?>" disabled class="input w-full bg-surface-container-low" placeholder="Nome">
  
  <input type="email" value="<?php echo $userData['email'] ?? ''; ?>" disabled class="input w-full bg-surface-container-low" placeholder="Email">
</div>

<!-- DADOS COMERCIAIS -->
<div class="space-y-4">
  <h3 class="text-lg font-bold text-on-surface">Dados Comerciais</h3>

  <input type="text" name="nome_empresa" placeholder="Nome da Empresa" required class="input w-full">
  
  <textarea name="descricao_empresa" placeholder="Descrição da Empresa" required rows="3" class="input w-full p-3"></textarea>

  <input type="text" name="cnpj" id="cnpj" placeholder="CNPJ" maxlength="18" required class="input w-full">

  <input type="text" name="telefone_empresa" id="telefone_empresa" placeholder="Telefone da Empresa" maxlength="15" required class="input w-full">

  <input type="text" name="website" placeholder="Website (Opcional)" class="input w-full">
</div>

<!-- TERMOS DE USO -->
<div class="flex items-start gap-2 text-sm">
  <input type="checkbox" id="termbox" required class="mt-1">
  <label for="termos" class="text-on-surface-variant">
    Eu li e concordo com os 
    <a href="#" class="text-primary font-semibold hover:underline">
      Termos de Uso para Vendedores
    </a> 
    e 
    <a href="#" class="text-primary font-semibold hover:underline">
      Política de Privacidade
    </a>.
  </label>
</div>
<!-- BOTÃO -->
    <p id="responseErro" style="color:red;"><?php if(isset($responseError)) echo $responseError;?></p>
<div class="pt-6">
  <button id="submitbutton" type="submit" 
    class="w-full signature-gradient text-white py-4 rounded-lg font-semibold tracking-wide hover:opacity-90 transition" name="registrar">
    CONTINUAR PARA VERIFICAÇÃO
  </button>
</div>

</form>
<div class="mt-8 text-center">
<p class="font-body text-xs text-on-surface-variant uppercase tracking-widest">
                        Voltar para <a class="text-primary font-bold hover:underline" href="../home/code.php">Home</a>
</p>
</div>
</div>
</div>
</div>
<!-- Footer Segment (Floating Style) -->
<footer id="footer"></footer>
<script src="../generico/jsgenerico/script.js"></script>
<script src="../generico/jsgenerico/frame.js"></script>
<script>
//MÁSCARA DE CNPJ
cnpjField = document.getElementById('cnpj');
cnpjField.addEventListener("input", (e) => {
  let value = e.target.value;

  // remove tudo que não é número
  value = value.replace(/\D/g, "");

  // aplica a máscara
  value = value.replace(/(\d{2})(\d)/, "$1.$2");
  value = value.replace(/(\d{3})(\d)/, "$1.$2");
  value = value.replace(/(\d{3})(\d)/, "$1.$2");
  value = value.replace(/(\d{1,2})$/, "-$&");

  e.target.value = value;
});

//MÁSCARA DE TELEFONE
telefoneField = document.getElementById('telefone_empresa');
telefoneField.addEventListener("input", (e) => {
  let value = e.target.value;

  value = value.replace(/\D/g, "");

  // limita a 11 dígitos
  value = value.substring(0, 11);

  // aplica máscara
  value = value.replace(/^(\d{2})(\d)/g, "($1) $2");
  value = value.replace(/(\d{5})(\d)/, "$1-$2");

  e.target.value = value;
});
</script>
</body></html>

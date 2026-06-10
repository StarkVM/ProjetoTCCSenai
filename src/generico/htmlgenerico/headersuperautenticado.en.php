<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/ProjetoTCCSenai/src/config/session.php';

?>

<!DOCTYPE html>

<html class="light" lang="en"><head>
<meta charset="utf-8"/>
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;900&amp;family=Inter:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet"/>
<script id="tailwind-config"> tailwind.config = { darkMode: "class" } </script>
</head>
<body>
<header class="bg-[#fcf9f8]/80 dark:bg-[#1c1b1b]/80 backdrop-blur-md docked full-width top-0 sticky z-50" id="header">
  <div class="flex justify-between items-center w-full px-8 py-4 max-w-[1920px] mx-auto">
    <div class="text-2xl font-black tracking-tighter text-[#1c1b1b] dark:text-[#fcf9f8] uppercase font-headline">Heavy Rent</div>
    <nav class="hidden md:flex items-center gap-8 font-['Space_Grotesk'] tracking-tight text-sm font-bold uppercase">
      <a class="text-[#4a4949] dark:text-[#a5a09f] hover:text-[#1c1b1b] dark:hover:text-[#fcf9f8] transition-opacity duration-200" href="../home/code.php">Início</a>
      <a class="text-[#4a4949] dark:text-[#a5a09f] hover:text-[#1c1b1b] dark:hover:text-[#fcf9f8] transition-opacity duration-200" href="../catalogoAnuncios/code.html">Catálogo</a>
        <?php if(isset($_SESSION["type"]) && $_SESSION["type"] == "1") echo "<a class='text-[#4a4949] dark:text-[#a5a09f] hover:text-[#1c1b1b] dark:hover:text-[#fcf9f8]' href='../VendedorHome/code.php'>Locações</a>"?>
    </nav>
    <div class="flex items-center gap-4">
        <?php if(isset($_SESSION["type"]) && $_SESSION["type"] == 0) echo '<button type="button" id="openVendorModalButton" class="flex items-center gap-2 px-4 py-2 rounded-md bg-[#835400] text-white font-bold text-xs uppercase hover:scale-105 active:scale-95 transition-all shadow-md">
        <span class="material-symbols-outlined text-sm">storefront</span>
        Ser Vendedor
      </button>';?>
      <div class="relative group flex items-center gap-3 cursor-pointer">
        <span class="hidden md:block font-['Space_Grotesk'] text-sm font-bold text-[#1c1b1b] dark:text-[#fcf9f8]">Olá, <?php echo $_SESSION["firstName"]?? "Sem dados" ?></span>
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSVR3TjkaFI32k7M8OGMye32jOxry45evTmjw&s" alt="User avatar" class="w-10 h-10 rounded object-cover border-2 border-primary">
        <div class="absolute right-0 top-14 w-48 bg-white dark:bg-[#2d2c2c] shadow-lg rounded-md opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
          <a href="../UserProfile/code.php" class="block px-4 py-3 text-sm hover:bg-gray-100 dark:hover:bg-[#3a3939]">Meu Perfil</a>
          <a href="../UserProfile/code.php" class="block px-4 py-3 text-sm hover:bg-gray-100 dark:hover:bg-[#3a3939]">Minhas Locações</a>
          <a href="#" class="block px-4 py-3 text-sm hover:bg-gray-100 dark:hover:bg-[#3a3939] text-red-500">Sair</a>
          <a href="../auth/logout-all-sessions.php" class="block px-4 py-3 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-950 border-t border-gray-200 dark:border-gray-600">Logout de todas as sessões</a>
        </div>
      </div>
    </div>
  </div>
  <div class="bg-[#e5e2e1] dark:bg-[#2d2c2c] h-[1px] w-full"></div>
</header>

<!-- MODAL DE CONFIRMAÇÃO PARA SER VENDEDOR -->
<div aria-labelledby="modal-title" aria-modal="true" class="fixed inset-0 z-[9999] hidden overflow-y-auto" id="vendorModal" role="dialog">
  <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
    <div aria-hidden="true" class="fixed inset-0 transition-opacity bg-stone-900/80" id="vendorModalOverlay"></div>
    <div class="relative inline-block w-full max-w-lg p-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl border border-stone-200 rounded-md">
      <div class="flex flex-col items-center text-center space-y-6">
        <div class="flex items-center justify-center w-16 h-16 rounded-full bg-primary/10">
          <span class="material-symbols-outlined text-primary text-4xl">storefront</span>
        </div>
        <div class="space-y-3">
          <h3 class="text-3xl font-black uppercase tracking-tighter text-on-surface font-headline" id="modal-title">Tornar-se um <span class="text-primary italic">Vendedor</span></h3>
          <p class="text-stone-500 font-body">Ao se tornar um vendedor, você poderá cadastrar seus próprios equipamentos para locação e gerenciar seus ganhos diretamente pela plataforma Alpha-7.</p>
        </div>
        <div class="w-full space-y-3 pt-4">
          <button class="w-full px-6 py-4 bg-primary text-white font-black uppercase text-xs tracking-[0.2em] rounded-md hover:brightness-110 transition-all shadow-lg shadow-primary/20" onclick="confirmVendor()">Confirmar e Prosseguir</button>
          <button class="w-full px-6 py-4 bg-stone-100 text-stone-600 font-bold uppercase text-xs tracking-widest rounded-md hover:bg-stone-200 transition-all" onclick="closeVendorModal()">Agora não</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function openVendorModal() {
    const vendorModal = document.getElementById('vendorModal');

    if (vendorModal) {
      vendorModal.classList.remove('hidden');
      document.body.classList.add('overflow-hidden');
    }
  }
  function closeVendorModal() {
    const vendorModal = document.getElementById('vendorModal');

    if (vendorModal) {
      vendorModal.classList.add('hidden');
      document.body.classList.remove('overflow-hidden');
    }
  }
  function confirmVendor() { window.location.href = '../VendedorHome/code.php'; }

  window.openVendorModal = openVendorModal;
  window.closeVendorModal = closeVendorModal;
  window.confirmVendor = confirmVendor;

  function initVendorModal() {
    document.getElementById('openVendorModalButton')?.addEventListener('click', openVendorModal);
    document.getElementById('vendorModalOverlay')?.addEventListener('click', closeVendorModal);

    document.addEventListener('keydown', (event) => {
      if (event.key === 'Escape') { closeVendorModal(); }
    });
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initVendorModal);
  } else {
    initVendorModal();
  }
</script>
</body>
</html>

<?php

$error = $_GET['er'] ?? 404;

?>

<!DOCTYPE html>

<html class="light" lang="pt-BR">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />

  <link href="https://fonts.googleapis.com" rel="preconnect" />
  <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect" />

  <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet" />

  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />

  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>

  <script id="tailwind-config">
    tailwind.config = {
      darkMode: "class",
      theme: {
        extend: {
          colors: {
            "outline-variant": "#d7c3ae",
            "on-surface": "#1c1b1b",
            "background": "#fcf9f8",
            "surface-container": "#f0edec",
            "surface-container-lowest": "#ffffff",
            "surface-container-highest": "#e5e2e1",
            "surface-container-high": "#ebe7e7",
            "surface-container-low": "#f6f3f2",
            "primary-container": "#f9a825",
            "primary": "#835400",
            "on-primary": "#ffffff",
            "outline": "#857462",
            "surface": "#fcf9f8",
            "on-surface-variant": "#524434",
            "tertiary": "#006687"
          },
          borderRadius: {
            DEFAULT: "0.125rem",
            lg: "0.25rem",
            xl: "0.5rem",
            full: "999px"
          },
          fontFamily: {
            headline: ["Space Grotesk"],
            body: ["Inter"]
          }
        }
      }
    }
  </script>

  <style>
    .material-symbols-outlined {
      font-variation-settings:
        'FILL' 0,
        'wght' 400,
        'GRAD' 0,
        'opsz' 24;
    }

    .soft-shadow {
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    }

    .btn-gradient {
      background: linear-gradient(135deg, #835400 0%, #f9a825 100%);
    }

    .grid-pattern {
      background-image:
        linear-gradient(rgba(0, 0, 0, 0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(0, 0, 0, 0.03) 1px, transparent 1px);
      background-size: 40px 40px;
    }
  </style>
</head>

<body class="bg-background font-body text-on-surface overflow-x-hidden min-h-screen flex flex-col">

  <!-- Header -->
  <header id="header"></header>

  <main class="flex-grow flex items-center justify-center pt-20 pb-20 px-6 md:px-12 relative overflow-hidden grid-pattern">

    <!-- Glow Background -->
    <div class="absolute top-0 right-0 w-[450px] h-[450px] bg-primary-container/20 rounded-full blur-[120px]"></div>
    <div class="absolute bottom-0 left-0 w-[350px] h-[350px] bg-tertiary/10 rounded-full blur-[120px]"></div>

    <div class="container max-w-7xl mx-auto relative z-10">

      <div class="bg-surface-container-lowest soft-shadow overflow-hidden border border-outline-variant/20">

        <div class="grid lg:grid-cols-2 gap-0 items-center">

          <!-- IMAGE -->
          <div class="relative h-full min-h-[400px] lg:min-h-[700px] overflow-hidden order-1">

            <img
              alt="Máquina pesada em manutenção"
              class="absolute inset-0 w-full h-full object-cover"
              src="https://lh3.googleusercontent.com/aida-public/AB6AXuCdhCcHQT71GOtmAx7XZbeu9aNAmgphla2b-slo2AgkIbj-HCkCo0YP_rvygptEEBZ-nHyKKZqyrzEblVuefZyaNBQUlw7qwfuC3lfZ_NcXeMyWzbvF0np_HP4Trh4J6K6D9wTrV4NrKVddkvT0kRVPgIonESnEEkrkoxA8ntlEmN9A6FyfKNneSXX5MR9GsdSbG9HzzJo-s2AbgMcomVX7uR8eBS4VSgmOTUyJzsGikRmIvyTJE-3xetMFgnAuQw925iLJg1slo07w" />

            <!-- Overlay -->
            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/10 to-transparent"></div>

            <!-- Floating Card -->
            <div class="absolute bottom-8 left-8 right-8 bg-white/90 backdrop-blur-md rounded-2xl p-6 soft-shadow">

              <div class="flex items-center gap-4">

                <div class="w-14 h-14 rounded-full bg-primary-container flex items-center justify-center shrink-0">
                  <span class="material-symbols-outlined text-primary text-3xl">
                    construction
                  </span>
                </div>

                <div>
                  <p class="font-headline font-bold text-lg">
                    Página indisponível
                  </p>

                  <p class="text-sm text-on-surface-variant mt-1">
                    Você está diante de uma irregularidade técnica.
                  </p>
                </div>

              </div>

            </div>

          </div>

          <!-- CONTENT -->
          <div class="p-8 md:p-14 lg:p-16 order-2">

            <!-- Badge -->
            <div class="inline-flex items-center gap-2 bg-surface-container-high px-4 py-2 rounded-full mb-8">

              <span
                class="material-symbols-outlined text-primary"
                style="font-variation-settings: 'FILL' 1;">
                warning
              </span>

              <span class="font-headline font-bold text-xs uppercase tracking-widest">
                Erro do Sistema
              </span>

            </div>

            <!-- Error -->
            <div class="flex items-end gap-4 mb-6">

              <h1 class="font-headline text-7xl md:text-8xl font-black text-primary leading-none">
                <?php if (isset($error)) echo $error ?>
              </h1>

              <div class="pb-3">
                <div class="w-3 h-3 rounded-full bg-primary animate-pulse"></div>
              </div>

            </div>

            <!-- Title -->
            <h2 class="font-headline text-4xl md:text-5xl font-extrabold leading-tight mb-6">
              Ops...
            </h2>

            <!-- Description -->
            <p class="text-lg text-on-surface-variant leading-relaxed max-w-xl">
              O endereço acessado pode ter sido removido, alterado ou está temporariamente fora de serviço.
              Você pode retornar para a página inicial para continuar navegando.
            <!-- Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 mt-10">

              <a
                class="btn-gradient px-8 py-4 rounded-xl text-on-primary font-headline font-bold uppercase tracking-wider text-sm flex items-center justify-center gap-3 hover:scale-[1.02] active:scale-95 transition-all soft-shadow"
                href="../home/code.php">

                <span class="material-symbols-outlined">
                  home
                </span>

                Voltar ao início

              </a>
            </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </main>

  <!-- Footer -->
  <footer id="footer"></footer>

  <script src="../generico/jsgenerico/frame.js"></script>

</body>

</html>
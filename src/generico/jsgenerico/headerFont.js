 const links = document.querySelectorAll(".nav-link");

  links.forEach(link => {
    link.addEventListener("click", function () {

      // remove o ativo de todos
      links.forEach(l => {
        l.classList.remove(
          "text-[#835400]",
          "dark:text-[#f9a825]",
          "border-b-2",
          "border-[#835400]",
          "dark:border-[#f9a825]",
          "pb-1"
        );
      });

      // adiciona no clicado
      this.classList.add(
        "text-[#835400]",
        "dark:text-[#f9a825]",
        "border-b-2",
        "border-[#835400]",
        "dark:border-[#f9a825]",
        "pb-1"
      );
    });
  });
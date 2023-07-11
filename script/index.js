document.addEventListener("DOMContentLoaded", function () {
  const navbarToggler = document.querySelector(".nav-toggler");
  const navbarIcon = navbarToggler.querySelector(".navbar-toggler-icon");

  navbarToggler.addEventListener("click", function () {
    navbarIcon.classList.toggle("fa-bars");
    navbarIcon.classList.toggle("fa-times");
  });

  const dropdownItems = document.querySelectorAll(".dropdown");

  dropdownItems.forEach(function (item) {
    item.addEventListener("mouseenter", function () {
      this.classList.add("show");
      const dropdownMenu = this.querySelector(".dropdown-menu");
      dropdownMenu.classList.add("show");
    });

    item.addEventListener("mouseleave", function () {
      this.classList.remove("show");
      const dropdownMenu = this.querySelector(".dropdown-menu");
      dropdownMenu.classList.remove("show");
    });
  });
});

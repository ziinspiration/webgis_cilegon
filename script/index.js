const navbarToggler = document.getElementById("navbarToggler");
const navbarIcon = document.getElementById("navbarIcon");

navbarToggler.addEventListener("click", function () {
  if (navbarIcon.classList.contains("bi-three-dots-vertical")) {
    navbarIcon.classList.remove("bi-three-dots-vertical");
    navbarIcon.classList.add("bi-x-circle");
  } else {
    navbarIcon.classList.remove("bi-x-circle");
    navbarIcon.classList.add("bi-three-dots-vertical");
  }
});

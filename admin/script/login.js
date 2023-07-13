const togglePassword = document.querySelector(".toggle-password");
const passwordInput = document.querySelector("#password");

togglePassword.addEventListener("click", function () {
  if (passwordInput.getAttribute("type") === "password") {
    passwordInput.setAttribute("type", "text");
    togglePassword.classList.remove("bi-eye-fill");
    togglePassword.classList.add("bi-eye-slash-fill");
  } else {
    passwordInput.setAttribute("type", "password");
    togglePassword.classList.remove("bi-eye-slash-fill");
    togglePassword.classList.add("bi-eye-fill");
  }
});

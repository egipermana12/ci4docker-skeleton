let showHidePassword = document.querySelector("#show_hide_pass .eyeshow");
let showHidePasswordIcon = showHidePassword.querySelector("i");
let showHidePasswordInput = document.querySelector("#show_hide_pass input");

showHidePassword.addEventListener("click", function (e) {
  e.preventDefault();
  const isPassword = showHidePasswordInput.type === "password";

  showHidePasswordInput.type = isPassword ? "text" : "password";

  showHidePasswordIcon.classList.remove("fa-eye", "fa-eye-slash");
  showHidePasswordIcon.classList.add(isPassword ? "fa-eye" : "fa-eye-slash");
});

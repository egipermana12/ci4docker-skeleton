import "../scss/theme.scss";

let showHidePassword = document.querySelector("#show_hide_pass .eyeshow");
let showHidePasswordIcon = document.querySelector("#show_hide_pass .eyeshow i");
let showHidePasswordInput = document.querySelector("#show_hide_pass input");
showHidePassword.addEventListener("click", function (e) {
  e.preventDefault();
  if (showHidePasswordInput.type == "password") {
    showHidePasswordInput.type = "text";
    showHidePasswordIcon.classList.remove("fa-solid", "fa-eye-slash");
    showHidePasswordIcon.classList.add("fa-solid", "fa-eye");
  } else if (showHidePasswordInput.type == "text") {
    showHidePasswordInput.type = "password";
    showHidePasswordIcon.classList.remove("fa-solid", "fa-eye");
    showHidePasswordIcon.classList.add("fa-solid", "fa-eye-slash");
  }
});

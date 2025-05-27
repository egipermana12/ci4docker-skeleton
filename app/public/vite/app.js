//for scroll to top
let containerHeight = document.querySelector(".container-hight");

if (containerHeight) {
  window.onscroll = function () {
    scrollFunction();
  };

  function scrollFunction() {
    if (
      document.body.scrollTop > 20 ||
      document.documentElement.scrollTop > 20
    ) {
      document.querySelector(".container-hight").style.paddingTop = "1.2rem";
      document.querySelector(".container-hight").style.paddingBottom = "1.2rem";
    } else {
      document.querySelector(".container-hight").style.paddingTop = "2.4rem";
      document.querySelector(".container-hight").style.paddingBottom = "2.4rem";
    }
  }
}

let showHidePassword = document.querySelector("#show_hide_pass .eyeshow");
if (showHidePassword) {
  let showHidePasswordIcon = showHidePassword.querySelector("i");
  let showHidePasswordInput = document.querySelector("#show_hide_pass input");

  showHidePassword.addEventListener("click", function (e) {
    e.preventDefault();
    const isPassword = showHidePasswordInput.type === "password";

    showHidePasswordInput.type = isPassword ? "text" : "password";

    showHidePasswordIcon.classList.remove("fa-eye", "fa-eye-slash");
    showHidePasswordIcon.classList.add(isPassword ? "fa-eye" : "fa-eye-slash");
  });
}

function refreshToken(tokenName, tokenValue) {
  // Update di form
  $('input[name="' + tokenName + '"]').val(tokenValue);

  // Update header AJAX default
  $.ajaxSetup({
    headers: {
      "X-CSRF-TOKEN": tokenValue,
    },
  });
}

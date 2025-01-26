// Cambio entre formularios
const loginForm = document.querySelector(".login-form");
const registerForm = document.querySelector(".register-form");
const toRegister = document.getElementById("toRegister");
const toLogin = document.getElementById("toLogin");

toRegister.addEventListener("click", () => {
    loginForm.classList.add("hidden");
    registerForm.classList.remove("hidden");
});

toLogin.addEventListener("click", () => {
    registerForm.classList.add("hidden");
    loginForm.classList.remove("hidden");
});



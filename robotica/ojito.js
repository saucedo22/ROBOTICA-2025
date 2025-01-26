//ojito

// Selecciona el campo de contraseña y el ícono del ojito
const passwordInput = document.getElementById("contraseña");
const togglePassword = document.getElementById("togglePassword");

// Añade un evento de clic al ícono
togglePassword.addEventListener("click", function () {
    // Verifica el tipo actual del campo de contraseña
    if (passwordInput.type === "password") {
        passwordInput.type = "text"; // Cambia a texto para mostrar la contraseña
        this.classList.remove("bx-show-alt");
        this.classList.add("bx-hide"); // Cambia el ícono al estado "ocultar"
    } else {
        passwordInput.type = "password"; // Cambia a contraseña para ocultarla
        this.classList.remove("bx-hide");
        this.classList.add("bx-show-alt"); // Cambia el ícono al estado "mostrar"
    }
});
const eyeIcons = document.querySelectorAll(".show-icon");
const passwordInput = document.querySelector('input[name="password"]');

eyeIcons.forEach(eyeIcon => {
    eyeIcon.addEventListener("click", () => {
        const pInput = eyeIcon.parentElement.querySelector("input");
    
        if (pInput.type === "password") {
            eyeIcon.classList.replace("fa-eye", "fa-eye-slash");
            pInput.type = "text";
        } else {
            eyeIcon.classList.replace("fa-eye-slash", "fa-eye");
            pInput.type = "password";
        }
    
        pInput.focus();
    });

});

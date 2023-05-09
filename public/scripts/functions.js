const togglePassword = () => {
    const passwordInput = document.querySelector("#user_password")
    passwordInput.type = passwordInput.type === "text" ? "password" : "text"
    const eyeIcon = document.querySelector("#eye")
    eyeIcon.classList.contains("d-none") ? eyeIcon.classList.remove("d-none") : eyeIcon.classList.add("d-none")
    const eyeSlashIcon = document.querySelector("#eye-slash")
    eyeSlashIcon.classList.contains("d-none") ? eyeSlashIcon.classList.remove("d-none") : eyeSlashIcon.classList.add("d-none")
}

const togglePassword2 = () => {
    const passwordInput2 = document.querySelector("#user_confirm")
    passwordInput2.type = passwordInput2.type === "text" ? "password" : "text"
    const eyeIcon2 = document.querySelector("#eye2")
    eyeIcon2.classList.contains("d-none") ? eyeIcon2.classList.remove("d-none") : eyeIcon2.classList.add("d-none")
    const eyeSlashIcon2 = document.querySelector("#eye-slash2")
    eyeSlashIcon2.classList.contains("d-none") ? eyeSlashIcon2.classList.remove("d-none") : eyeSlashIcon2.classList.add("d-none")
}


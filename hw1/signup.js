// var error = true;

// function check(event) {
//     event.preventDefault();
//     const form= document.querySelector("form");
//     if (checkPassword() && checkPasswordConfirm() && !error) {
//         form.submit();
//         alert("Registrazione completata con successo!")
//     }
// }
function checkPassword(event) {
    const input = document.querySelector(".password input");
    const str = input.value;
    if (str.length < 8 || !/[a-z]/.test(str) || !/[A-Z]/.test(str) || !/\d/.test(str) || !/[\!@#\$%\^&\*\(\)_\+\-=\{\}\[\]:;"'<>,\.\/\?\\|\~`]/.test(input)) {
        input.parentNode.classList.add("error");
        return false;
    }
    input.parentNode.classList.remove("error");
    return true;
}
function checkPasswordConfirm(event) {
    const pswd = document.querySelector(".password input");
    const pswdc = document.querySelector(".password_confirm input");
    if (pswd.value !== pswdc.value) {
        pswdc.parentNode.classList.add("error");
        return false;
    }
    pswdc.parentNode.classList.remove("error");
    return true;
}
function checkUsername(event) {
    const input = document.querySelector(".username input");
    const ris = fetch("check_username.php?q=" + encodeURIComponent(input.value)).then(onResponse).then(jsonCheckUsername)
}
function onResponse(response) {
    if (!response.ok) return null;
    return response.json();
}
function jsonCheckUsername(json) {
    if (!json.exists) {
        document.querySelector(".username").classList.remove("error");
        error = false;
    }
    else {
        document.querySelector(".username").classList.add("error");
        error = true;
    }
}
//MAIN
const password = document.querySelector(".password input");
password.addEventListener("blur", checkPassword);
const password_confirm = document.querySelector(".password_confirm input");
password_confirm.addEventListener("blur", checkPasswordConfirm);
const username = document.querySelector(".username input");
username.addEventListener("blur", checkUsername);

// const form = document.querySelector("form");
// form.addEventListener("submit", check);

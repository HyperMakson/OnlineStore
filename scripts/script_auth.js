// Переключение варианта авторизации

const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});

// Проверка ввода формы

var nameInput = document.querySelector(".input-name");
var emailInput = document.querySelector(".input-email");
var passInput = document.querySelector(".input-pass");

emailInput.addEventListener('keyup', function () {
    let email = emailInput.value;
    if (email !== 'right') {
        emailInput.style.color = "red";
    } else {
        emailInput.style.color = "green";
    }
});
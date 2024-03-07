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
var emailInput = document.querySelectorAll(".input-email");
var passInput = document.querySelectorAll(".input-pass");
var btnInput = document.querySelectorAll(".auth-btn");

var usernameCheck = false;
var btnCheck = false;
var emailCheck = false;
var passCheck = false;

passInput.forEach(elementPass => {
    elementPass.disabled = true;
    elementPass.style.opacity = "0.5";
});

btnInput.forEach(elementBtn => {
    elementBtn.disabled = true;
    elementBtn.style.opacity = "0.5";
});

nameInput.addEventListener('keyup', function () {
    let username = nameInput.value;
    if (username === "" || username.length < 4) {
        nameInput.style.color = "red";
        usernameCheck = false;
    } else {
        nameInput.style.color = "green";
        usernameCheck = true;
    }
});

for (let i = 0; i < 2; i++) {
    emailInput[i].addEventListener('keyup', function () {
        let email = emailInput[i].value;
        if (email === "" || email.length < 5 || email.length > 31) {
            emailInput[i].style.color = "red";
            passInput[i].disabled = true;
            passInput[i].style.opacity = "0.5";
            btnInput[i].disabled = true;
            btnInput[i].style.opacity = "0.5";
            emailCheck = false;
        } else {
            emailInput[i].style.color = "green";
            passInput[i].disabled = false;
            passInput[i].style.opacity = "1";
            btnInput[i].disabled = true;
            btnInput[i].style.opacity = "0.5";
            emailCheck = true;
            if (btnCheck === true) {
                btnInput[i].disabled = false;
                btnInput[i].style.opacity = "1";
            }

        }
    });
    passInput[i].addEventListener('keyup', function () {
        let pass = passInput[i].value;
        if (pass === "" || pass.length < 8) {
            passInput[i].style.color = "red";
            btnInput[i].disabled = true;
            btnInput[i].style.opacity = "0.5";
            passCheck = false;
            btnCheck = false;
        } else {
            passInput[i].style.color = "green";
            btnInput[i].disabled = false;
            btnInput[i].style.opacity = "1";
            passCheck = true;
            btnCheck = true;
            if (btnCheck === true) {
                btnInput[i].disabled = false;
                btnInput[i].style.opacity = "1";
            }
        }
    });
};

var formReg = document.querySelector(".form-reg");
formReg.addEventListener('submit', event => {
    if (usernameCheck !== true || emailCheck !== true || passCheck !== true) {
        event.preventDefault();
        alert("Данные указаны неверно");
    }
});

var formLog = document.querySelector(".form-log");
formLog.addEventListener('submit', event => {
    if (emailCheck !== true || passCheck !== true) {
        event.preventDefault();
        alert("Данные указаны неверно");
    }
});
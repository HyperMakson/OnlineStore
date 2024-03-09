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

const usernameReg = /^[0-9A-ZА-ЯЁ]{4,}$/i;
const isUsername = function (str) {
    return usernameReg.test(str);
}

const emailReg = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-z\-0-9]+\.)+[a-z]{2,}))$/i;
const isEmail = function (str) {
    return emailReg.test(str);
}

const passwordReg = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[-#!$@%^&*_+~=:;?\/])[-\w#!$@%^&*+~=:;?\/]{8,}$/;
const isPassword = function (str) {
    return passwordReg.test(str);
}

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
    if (!isUsername(username)) {
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
        if (!isEmail(email)) {
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
        if (!isPassword(pass)) {
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
        var incorrect = {
            "Имя": usernameCheck,
            "Email": emailCheck,
            "Пароль": passCheck
        };
        var strIncrorrect = "Неверно указано: ";
        Object.entries(incorrect).forEach(([key, value]) => {
            if (value == false) {
                strIncrorrect += key;
            }
        });
        alert(strIncrorrect);
    }
});

var formLog = document.querySelector(".form-log");
formLog.addEventListener('submit', event => {
    if (emailCheck !== true || passCheck !== true) {
        event.preventDefault();
        var incorrect = {
            "Email": emailCheck,
            "Пароль": passCheck
        };
        var strIncrorrect = "Неверно указано: ";
        Object.entries(incorrect).forEach(([key, value]) => {
            if (value == false) {
                strIncrorrect += key;
            }
        });
        alert(strIncrorrect);
    }
});
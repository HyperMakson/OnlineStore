// Выпадающее меню в заголовке

var dropBtn = document.querySelector(".drop-down-btn");
dropBtn.addEventListener('click', function () {
    alert("Hello");
});

//Удаление окна подтверждения

function delWindow() {
    var delWin = document.querySelector(".confirm-buy-win");
    var overlay = document.querySelector(".overlay");
    var bodyStop = document.querySelector("body");
    delWin.parentNode.removeChild(delWin);
    overlay.parentNode.removeChild(overlay);
    bodyStop.classList.remove("stop");
};

var btnDel = document.querySelector(".btn-del-win");
btnDel.addEventListener('click', delWindow);

var btnGoProfile = document.querySelector(".btn-go-profile");
btnGoProfile.addEventListener('click', function () {
    delWindow();
    window.location.href = "http://onlinestore/profile/authorization.php";
});
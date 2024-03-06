// Выпадающее меню в заголовке

var dropBtn = document.querySelector(".drop-down-btn");
dropBtn.addEventListener('click', function () {
    alert("Hello");
});

//Удаление окна подтверждения

var btnDel = document.querySelector(".btn-del-win");
btnDel.addEventListener('click', function () {
    var delWindow = document.querySelector(".confirm-buy-win");
    delWindow.parentNode.removeChild(delWindow);
});
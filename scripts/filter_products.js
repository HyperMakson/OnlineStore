//Ценовой диапазон в фильтрах

var range = document.querySelectorAll('.inputRange');
var field = document.querySelectorAll('.inputNumber');

for (let i = 0; i < 2; i++) {
    range[i].addEventListener('input', function (e) {
        field[i].value = e.target.value;
    });
    field[i].addEventListener('input', function (e) {
        range[i].value = e.target.value;
    });
}
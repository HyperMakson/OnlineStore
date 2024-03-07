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

// Выпадающие фильтры

var dropBtnFilters = document.querySelector(".product-filters-open");
dropBtnFilters.addEventListener('click', function () {
    var sideFilters = document.querySelector(".product-filters");
    sideFilters.style.width = "250px";
    sideFilters.style.padding = "2rem";
    dropBtnCloseFilters.style.display = "block";
    dropBtnFilters.style.display = "none";
});

var dropBtnCloseFilters = document.querySelector(".product-filters-close");
dropBtnCloseFilters.addEventListener('click', function () {
    var sideFilters = document.querySelector(".product-filters");
    sideFilters.style.width = "0";
    sideFilters.style.padding = "0";
    dropBtnCloseFilters.style.display = "none";
    dropBtnFilters.style.display = "block";
});

window.addEventListener('resize', function () {
    var winWidth = window.innerWidth;
    if (winWidth > 720) {
        var sideFilters = document.querySelector(".product-filters");
        sideFilters.style.width = "auto";
        sideFilters.style.padding = "2rem";
        dropBtnCloseFilters.style.display = "none";
        dropBtnFilters.style.display = "none";
    } else {
        var sideFilters = document.querySelector(".product-filters");
        sideFilters.style.width = "0";
        sideFilters.style.padding = "0";
        dropBtnFilters.style.display = "block";
    }
});
jQuery(function ($) {
    $(document).mouseup(function (e) { // событие клика по веб-документу
        var div = $(".popup-form"); // тут указываем ID элемента
        if (!div.is(e.target) // если клик был не по нашему блоку
            && div.has(e.target).length === 0) { // и не по его дочерним элементам
            $('#myPopup').css("height", "0"); // скрываем его
        }
    });
});

jQuery(function ($) {
    var register = $("#myPopup");
    if ($('.invalid-feedback')[0]) {
        register.css("height", "100vh");
    }
});

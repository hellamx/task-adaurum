$("body").on("click", "#nav-show", function (e) {
    e.PreventDefault;
    $("#nav-mobile").css("display", "flex");
})

$("body").on("click", ".closeBtn", function (e) {
    e.PreventDefault;
    $("#nav-mobile").css("display", "none");
})

$("body").on("click", ".common_alerts", function (e) {
    e.PreventDefault;
    $(".common_alerts").fadeOut(300);
});

$("body").on("click", ".alertError", function (e) {
    e.PreventDefault;
    $(this).fadeOut(300);
});

$("body").on("click", ".alerts", function (e) {
    e.PreventDefault;
    $(".alertError").fadeOut(300);
    $(".alertSuccess").fadeOut(300);
});

$("body").on("click", ".addBtn", function (e) {
    e.PreventDefault;
    $(e.currentTarget.nextElementSibling).fadeToggle(300);
});

$("body").on("click", ".addNote", function (e) {
    e.PreventDefault;
    $(e.target.parentNode.parentNode.nextElementSibling).slideToggle(300);
});

$("body").on("click", ".viewDeleteBtn", function (e) {
    $(e.target.closest(".wrapperDelete")).fadeOut(300, function () {
        $(e.target.closest(".wrapperDelete")).remove();
    });
});
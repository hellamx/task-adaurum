$("body").on("click", ".viewDeleteBtn", function (e) {
    
    var id = $(this).data("delete");

    $.ajax({
        url: path + '/note/delete',
        data: {id: id},
        type: 'POST',
        success: function(result) {
            if (result == 1) {
             $(e.target.closest(".wrapperDelete")).fadeOut(300, function () {
                $(e.target.closest(".wrapperDelete")).remove();
                if ($('body .comments__wrapper').is() == false) {
                    var current = window.location.pathname;
                    $('.main__company--comments').html('<p class="emptyField">Комментариев ещё нет</p> \
                    <a class="addBtn" href=' + current + '>Добавить комментарий</a>');
                    
                }
             });  
            }

        },
        error: function() {
            console.log('Unknown server error');
        }
    });
});

$(".noteForm").submit(function (e) {
    e.preventDefault();

    var text = $(this).find("textarea[name=text]").val();
        field = $(this).find("textarea[name=text]").data("field"),
        company_id = $(this).data("company"),
        data_main = $(this).data("main");

    $.ajax({
        url: path + '/note/add',
        data: {text: text, field: field, company_id: company_id, main: data_main},
        type: 'POST',
        success: function(result) {
           result = JSON.parse(result);

           if (result[1] == false) {
                $(e.target.parentNode).after(result[0]);
           } else {
                $(".alertError ").remove();
                $(e.target.parentNode).after("<div id='showNewestWrap'><p>Успешно</p><button>Нажмите, чтобы показать</button></div>");
                $(e.target.parentNode).after(result[0]);
                $(e.currentTarget.parentNode).slideUp(300);
                
                $("body").on("click", "#showNewestWrap", function (e) {
                    $(e.currentTarget.previousElementSibling).fadeIn(300);
                    $(e.currentTarget).remove();
                });
           }
        },
        error: function() {
            console.log('Unknown server error');
        }
    });
});
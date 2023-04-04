$(".addForm").submit(function (e) {
    e.preventDefault();

    var name = $(this).find("input[name=name]").val(),
        inn = $(this).find("input[name=inn]").val(),
        content = $(this).find("input[name=content]").val(),
        director = $(this).find("input[name=director]").val(),
        address = $(this).find("input[name=address]").val(),
        phone = $(this).find("input[name=phone]").val();

    $.ajax({
        url: path + '/company/add',
        data: {name: name, 
               inn: inn, 
               content: content, 
               director: director, 
               address: address,
               phone: phone
              },
        type: 'POST',
        success: function(result) {
            $(".alerts").html(result);

        },
        error: function() {
            console.log('Unknown server error');
        }
    });
});

/*$("body").on("click", ".btnDeleteCompany", function (e) {
    e.preventDefault;
    var id = $(this).data("id");

    $.ajax({
        url: path + '/company/delete',
        data: {id: id},
        type: 'POST',
        success: function(result) {
            if (result) {
                $(e.currentTarget.closest(".content__wrapper")).hide(300, function () {
                    $(e.currentTarget.closest(".content__wrapper")).remove();
                })
            }
        },
        error: function() {
            console.log('Unknown server error');
        }
    });
})*/
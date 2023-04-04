$("body").on("click", "#resetPasswordBtn", function (e) {
    e.PreventDefault;
    $(".formWrapper").fadeToggle(300);
});

$(".signupForm").submit(function (e) {
    e.preventDefault();

    var fullname = $(this).find("input[name=fullname]").val(),
        login = $(this).find("input[name=login]").val(),
        email = $(this).find("input[name=email]").val(),
        password = $(this).find("input[name=password]").val(),
        age = $(this).find("select[name=age]").val(),
        position = $(this).find("select[name=position]").val();

    $.ajax({
        url: path + '/user/signup',
        data: {fullname: fullname, 
               login: login, 
               email: email, 
               password: password, 
               age: age,
               position: position
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

$(".loginForm").submit(function (e) {
    e.preventDefault();

    var login = $(this).find("input[name=login]").val(),
        password = $(this).find("input[name=password]").val();

    $.ajax({
        url: path + '/user/login',
        data: {login: login, password: password},
        type: 'POST',
        success: function(result) {
            result = JSON.parse(result);
            $(".alerts").html(result[0]);

            if (result[1]) {
                window.setTimeout(function(){
                    window.location.href = path + window.location.search.substring(1);
                }, 3000);
            }
        },
        error: function() {
            console.log('Unknown server error');
        }
    });
});

$(".resetForm").submit(function (e) {
    e.preventDefault();

    var login = $(this).find("input[name=login-reset]").val();

    $.ajax({
        url: path + '/user/reset',
        data: {login: login},
        type: 'POST',
        success: function(result) {
            $(".alerts").html(result);
        },
        error: function() {
            console.log('Unknown server error');
        }
    });
});

$(".resaveForm").submit(function (e) {
    e.preventDefault();

    var password = $(this).find("input[name=password]").val();

    $.ajax({
        url: path + '/user/auth',
        data: {password: password},
        type: 'POST',
        success: function(result) {
            $(".alerts").html(result);
        },
        error: function() {
            console.log('Unknown server error');
        }
    });
});
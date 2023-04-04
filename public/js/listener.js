var company_id = window.location.pathname.split("/").pop();

setInterval(function() {
    
    $.ajax({
        url: path + '/company/listener',
        data: {company_id: company_id},
        type: 'POST',
        success: function(data) {
            data = JSON.parse(data);
            if(data.isAdd == true) {
                $(".main__title").after("<ul style='margin-bottom: 20px' class='alerts alertSuccess fade'> \
                        <li>Появился новый комментарий</li> \
                    </ul>");

                for (key in data) {
                    if (data[key] == "main") {
                        $("#main").after(data.main);
                        if($(".emptyField")) {
                            $(".emptyField").remove();
                        }
                    } else {
                        $("#" + key).after(data[key]);
                    }
                }
            }
        }
    });

}, 3000);
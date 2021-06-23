//This file is for display the list of type wheels by cu in a modal 

$(document).ready(function() {
    
    $(".display-list-wheels-type").on("click",function(event) {

        let cuName = $(this).attr('id');

        $(".modal-body").children().remove();

        $.ajax({
            //We retrieve the courant url
            url: $(location).attr("href"),
            type: "POST",
            data: {cuName: cuName},
            dataType: "json",
            async: true,

            success: function(data, status) {
                console.log(data);

                if (data['error']) {
                    $(".modal-body").append(
                        '<div class="row pt-2 pb-2 alert-warning">\
                            <div class="col-12">' + data['error'] + '</div>\
                        </div>'
                    );
                } else {

                    for (let category in data) {
                        $(".modal-body").append(
                            '<div class="row pt-2 pb-2 hover-cel">\
                                <div class="col-6 text-uppercase font-weight-bold">' + category + '</div>\
                                <div class="col-6 ' + category + '"></div>\
                            </div>'
                        );
                        
                        for (let key of Object.keys(data[category])) {
                            
                            $("." + category).append(
                                '<div class="row ">\
                                        <div class="col-12">' + data[category][key].type + '</div>\
                                </div>'
                            );
                        }
                    }
                }
            }
        });
    });

});
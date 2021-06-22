//This file is for display the list of type wheels by cu in a modal 

$(document).ready(function() {
    
    $(".display-list-wheels-type").on("click",function(event) {

        let cuName = $(this).attr('id');

        $.ajax({
            //We retrieve the courant url
            url: $(location).attr("href"),
            type: "POST",
            data: {cuName: cuName},
            dataType: "json",
            async: true,

            success: function(data, status) {
                console.log(data);
                for (let category in data) {
                    $(".modal-body").append(
                        '<div class="row text-center">\
                            <div class="col-3">' + category + '</div>\
                            <div class="col-9 ' + category + '"></div>\
                        </div>'
                    );
                    
                    for (let wheelsType in category) {
                        console.log(category['type']);
                        $("." + category).append(
                            '<div class="row text-center">\
                                    <div class="col-12"></div>\
                            </div>'
                        );
                    }
                }
            }
        });
    });

});
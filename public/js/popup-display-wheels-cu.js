//This file is for display popup of wheels cu by type and update their quantity

$(document).ready(function() {

    //First, we hide the popup
    $(".popup").hide();

    $(".details").on("click", function(event) {

        $(".popup").show();

        //We retrieve id of button we explode it for retrieve the num of id of wheelsCuType
        let idWheelsCuTypeExplode = ($(this).attr('id')).split('-');

        //We retrieve the last element
        let idWheelsCuType = idWheelsCuTypeExplode[idWheelsCuTypeExplode.length - 1];

        $.ajax({
            //We retrieve the courant url
            url: $(location).attr("href"),
            type: "POST",
            data: { idWheelsCuType: idWheelsCuType },
            dataType: "json",
            async: true,

            success: function(data, status) {
                console.log(data);
                for (let wheels of data.wheelsCus) {
                    $('#display-wheels-cu').append(
                        '<div class="col-12 ">\
                            <div class="row border-top border-right head-table text-center pt-2 pb-2">\
                                <div class="col-1">' + wheels['provider'] + '</div>\
                                <div class="col-2">Réference</div>\
                                <div class="col-2">Désignation TAV</div>\
                                <div class="col-1">Grain</div>\
                                <div class="col-1">Diamètre</div>\
                                <div class="col-2">Hauteur / Largeur</div>\
                                <div class="col-1">Stock</div>\
                                <div class="col-2">Actions</div>\
                            </div>\
                        </div>'
                    );
                }
                
            }
        })

    });

    //When we click on close button, the popup close itself
    $(".close-popup").on("click", function(event) {
        $(".popup").hide();
    });
});
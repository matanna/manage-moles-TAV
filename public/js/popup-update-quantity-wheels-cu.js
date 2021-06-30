//This file is for display popup of wheels cu by type and update their quantity

$(document).ready(function() {
    
    $("#display-wheels-cu").on("click", ".change-quantity",function(event) {

        let wheelsId = $(this).attr('id');

        let quantity = $("#quantity" + wheelsId).val();

        $.ajax({
            //We retrieve the courant url
            url: "/change-quantity/" + wheelsId,
            type: "POST",
            data: {quantity: quantity},
            dataType: "json",
            async: true,

            success: function(data, status) {
               
                $("#stock" + wheelsId).replaceWith('<div class="col-1" id="stock' + wheelsId + '">' + data + '</div>');
            }
        });

        $("#display-wheels-cu").children("#change-quantity" + wheelsId).modal("hide");

    });

});
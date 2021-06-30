
$(document).ready(function() {

    //This block code is for adapt list of wheels cu type in terms of cu name in the form for add a new wheels cu
    $("#wheelsCu_cu").on("change", function(event) {

        let cuName = $('#wheelsCu_cu' + ' option:selected').text();

        $.ajax({
            url: "manage/adapt/wheels-cu-type",
            type: "POST",
            data: 'cuName=' + cuName,
            dataType: "json",
            async: true,

            success: function(data, status) {

                wheelsCuTypes = $(data.content).find("#wheelsCu_wheelsCuType").html();
                
                $("#wheelsCu_wheelsCuType").empty().append(wheelsCuTypes);
            }
        })

    });

    //This block code is for adapt list of wheels cu type in terms of cu name in the form for add a edit wheels cu
    $(".edit-wheels-cu").on("change", function(event) {

        let exploseWheelsCuId = $(this).attr('id').split('_');

        let wheelsCuId = exploseWheelsCuId[exploseWheelsCuId.length - 1];
        
        let cuName = $('#_wheelsCu_' + wheelsCuId + '_cu_' + wheelsCuId + ' option:selected').text();
        console.log(cuName);
        $.ajax({
            url: "/manage/adapt/wheels-cu-type",
            type: "POST",
            data: { cuName: cuName, wheelsCuId: wheelsCuId },
            dataType: "json",
            async: true,

            success: function(data, status) {
                
                wheelsCuTypes = $(data.content).find("#wheelsCu_" + wheelsCuId +"_wheelsCuType").html();
                console.log(wheelsCuTypes);
                $("#_wheelsCu_" + wheelsCuId + "_wheelsCuType_" + wheelsCuId).empty().append(wheelsCuTypes);
            }
        })
    });

});
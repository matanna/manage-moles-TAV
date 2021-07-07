
//we retrieve complete url for get route
let url = getRouteByUrl();
console.log(url);
if (url == "manage/wheels-cu") {
    url = "adapt/wheels-cu-type";
}

if (url == "update/stock/cu") {
    url = "../../update/stock/cu";
}

//First, we empty wheelsCuType list on new-wheels-form
$(document).ready(function() {
    $('.category').empty().append('<option value="selected=selected">Catégorie</option>');
    $('.wheelsCuType').empty().append('<option value="selected=selected">Type de meule</option>');
});

$(document).ready(function() {

    //This block code is for adapt list of category cu type in terms of cu name in the form 
    $(".cu").on("change", function(event) {
        
        $('.wheelsCuType').empty().append('<option value="selected=selected">Type de meule</option>');

        let id = (($(this).attr('id')).split('_'));
        id.pop();
        
        id = id.join('_');

        let cuName = $('#' + id + '_cu' + ' option:selected').text();

        $.ajax({
            url: url,
            type: "POST",
            data: 'cuName=' + cuName,
            dataType: "json",
            async: true,

            success: function(data, status) {
                console.log(url);
                if (url == "adapt/wheels-cu-type") {
                    let wheelsCuTypes = $(data.content).find('#' + id + '_wheelsCuType').html();
                    $('#' + id + '_wheelsCuType').empty().append(wheelsCuTypes);

                } else if (url == "../../update/stock/cu") {
                    let wheelsCuTypes = $(data.content).find('#' + id + '_categories').html();
                    $('#' + id + '_categories').empty().append(wheelsCuTypes);
                }
                
            }
        })

    });

    //This block code is for adapt list of wheelsCuType cu type in terms of cu name in the form 
    $(".category").on("change", function(event) {

        let id = (($(this).attr('id')).split('_'));
        id.pop();
        
        id = id.join('_');
    
        let cuName = $('#' + id + '_cu' + ' option:selected').text();
        let categoryName = $('#' + id + '_categories' + ' option:selected').text();

        $.ajax({
            url: url,
            type: "POST",
            data: { cuName: cuName, categoryName: categoryName } ,
            dataType: "json",
            async: true,

            success: function(data, status) {
                
                if(url == "../../update/stock/cu") {
                    let wheelsCuTypes = $(data.content).find('#' + id + '_wheelsCuType').html();
                    $('#' + id + '_wheelsCuType').empty().append(wheelsCuTypes);
                }
            }
        })

    });

    //This block code is for adapt list of wheels cu type in terms of cu name in the form for add a edit wheels cu
    $(".edit-wheels-cu").on("change", function(event) {

        let exploseWheelsCuId = $(this).attr('id').split('_');

        let wheelsCuId = exploseWheelsCuId[exploseWheelsCuId.length - 1];
        
        let cuName = $('#_wheelsCu_' + wheelsCuId + '_cu_' + wheelsCuId + ' option:selected').text();
        
        $.ajax({
            url: url,
            type: "POST",
            data: { cuName: cuName, wheelsCuId: wheelsCuId },
            dataType: "json",
            async: true,

            success: function(data, status) {
                
                let wheelsCuTypes = $(data.content).find("#wheelsCu_" + wheelsCuId +"_wheelsCuType").html();
                $("#_wheelsCu_" + wheelsCuId + "_wheelsCuType_" + wheelsCuId).empty().append(wheelsCuTypes);
            }
        })
    });

});

//This function is for get the route by the current url
function getRouteByUrl() {
    let url = $(location).attr("href").split('//');
    url.shift();
    url = url[0].split('/');
    url.shift();
    return url.join('/'); 
}
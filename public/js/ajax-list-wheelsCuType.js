
//we retrieve complete url for get route
let url = getRouteByUrl();

if (url == "manage/wheels-cu") {
    url = "adapt/wheels-cu-type";
}

if (url == "update/stock/cu") {
    url = "../../update/stock/cu";
}

//First, we empty wheelsCuType list on new-wheels-form
$(document).ready(function() {

    if ($('#add-new-wheels').find('.form-error-message').length == 0){
        $('.category').empty().append('<option value="selected=selected">Catégorie</option>');
        $('.wheelsCuType').empty().append('<option value="selected=selected">Type de meule</option>');
    }
    console.log($('#all-wheels-cu').find('.form-error-message').length);
    if ($('#all-wheels-cu').find('.form-error-message').length > 0) {
        console.log('yse');
        $('.form-error-message').parents('.modal').modal('show');
    }
});

$(document).ready(function() {

    /**
     * This block code is for adapt list of category cu type in terms of cu name in the form
     */ 
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

                let wheelsCuTypes = $(data.content).find('#' + id + '_categories').html();
                $('#' + id + '_categories').empty().append('<option value="selected=selected">Catégorie</option>');
                $('#' + id + '_categories').append(wheelsCuTypes);
                
            }
        })

    });

    /**
     * This block code is for adapt list of wheelsCuType cu type in terms of cu name in the form 
     */ 
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
                
                let wheelsCuTypes = $(data.content).find('#' + id + '_wheelsCuType').html();
                $('#' + id + '_wheelsCuType').empty().append(wheelsCuTypes);
            }
        })

    });

    /**
     * This block code is for adapt list of categories in terms of cu name in the form for edit wheels cu
     */ 
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
    
                let categories = $(data.content).find("#wheelsCu_" + wheelsCuId +"_categories").html();
                $("#_wheelsCu_" + wheelsCuId + "_category_" + wheelsCuId).empty().append('<option value="selected=selected">Catégorie</option>');
                $("#_wheelsCu_" + wheelsCuId + "_category_" + wheelsCuId).append(categories);
            }
        })
    });

    /**
     * This block code is for adapt list of wheels cu type in terms of category in the form for edit wheels cu
     */ 
    $(".edit-wheels-categories").on("change", function(event) {

        let exploseWheelsCuId = $(this).attr('id').split('_');

        let wheelsCuId = exploseWheelsCuId[exploseWheelsCuId.length - 1];

        let cuName = $('#_wheelsCu_' + wheelsCuId + '_cu_' + wheelsCuId + ' option:selected').text();
        let categoryName = $('#_wheelsCu_' + wheelsCuId + '_category_' + wheelsCuId + ' option:selected').text();
        
        $.ajax({
            url: url,
            type: "POST",
            data: { cuName: cuName, categoryName: categoryName, wheelsCuId: wheelsCuId },
            dataType: "json",
            async: true,

            success: function(data, status) {
                console.log(data.content);
                let wheelsCuTypes = $(data.content).find("#wheelsCu_" + wheelsCuId +"_wheelsCuType").html();
                $("#_wheelsCu_" + wheelsCuId + "_wheelsCuType_" + wheelsCuId).empty().append(wheelsCuTypes);
            }
        })
    });

});

/**
 * This function is for get the route by the current url
 */ 
function getRouteByUrl() {
    let url = $(location).attr("href").split('//');
    url.shift();
    url = url[0].split('/');
    url.shift();
    return url.join('/'); 
}
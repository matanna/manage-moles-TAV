//This file is for change name of cuCategory choosed with Ajax

$(document).ready(function() {

    //This block is for add a new category
    $("#button-new-category").on("click", function(event){

        $("#manage-categories").find(".text-warning").remove();

        let addNewCategory = $("#new-category").val();

        var name = addNewCategory.replaceAll(' ', '_');

        $.ajax({
            url: "../../add/cuCategory",
            data: {addNewCategory: name},
            type: "POST",
            dataType: "json",
            async: true,

            success: function(data, status) {
            
                $(".existing-category").append(
                    '<div class="row original-margin">\
                        <div class="col-6" id="name-category-' + data['name'] + '">\
                            <span class="name-category">' + data['name'] + '</span>\
                        </div>\
                        <div class="col-6 text-right">\
                            <a href="#" class="rename-category" id="rename-category-' + data['name'] + '">Renomer</a>\
                            <a href="#" class="ml-3 delete-category" id="delete-category-' + data['name'] + '">Supprimer</a>\
                        </div>\
                    </div>'
                );

                $("#new-category").val('');
            },

            error: function(error, status) {

                for (let message of error.responseJSON) {
                    $(".new-category").append('<p class="text-warning">' + message + '</p>');
                }  
            }
        });
    });

    //This block code is for change name of category in an input for rename the category
    $(".existing-category").on("click",".rename-category", function(event) {

        $("#manage-categories").find(".text-warning").remove();

        let nameCategoryExplode = $(this).attr('id').split('-');

        let nameCategory = nameCategoryExplode[nameCategoryExplode.length - 1];
    
        $("#name-category-" + nameCategory).html(
            '<form action="#" method="POST" class="d-flex">\
                <input name="input-change-name-category-' + nameCategory + '" type="text"  placeholder="' + nameCategory + '" id="input-change-name-category-' + nameCategory + '" required="required" />\
                <button type="button" class="btn btn-sm btn-outline-success" id="button-change-name-category-' + nameCategory + '">Valider</button>\
            </form>'
        );

        $("#button-change-name-category-" + nameCategory).on("click", function(event) {

            $("#manage-categories").find(".text-warning").remove();

            let newNameCategory = $("#input-change-name-category-" + nameCategory).val();

            var name = newNameCategory.replaceAll(' ', '_');

            $.ajax({
                url: "../../rename/cuCategory/" + nameCategory,
                data: {newNameCategory: name},
                type: "POST",
                dataType: "json",
                async: true,

                success: function(data, status) {
                
                    $("#name-category-" + nameCategory).replaceWith(
                        '<div class="col-6" id="name-category-' + data + '">\
                            <span class="name-category" >' + data + '</span>\
                        </div>'
                    );

                    $("#rename-category-" + nameCategory).replaceWith(
                        '<a href="#" class="rename-category" id="rename-category-' + data + '">Renomer</a>'
                    );

                    $("#delete-category-" + nameCategory).replaceWith(
                        '<a href="#" class="ml-3 delete-category" id="delete-category-' + data + '">Supprimer</a>'
                    );
                },
                
                error: function(error, status) {

                    for (let message of error.responseJSON) {
                        $("#name-category-" + nameCategory).append('<p class="text-warning">' + message + '</p>');
                    }  
                }
            });
        });
    });

    //This block is for delete a category
    $(".existing-category").on("click",".delete-category", function(event){

        $("#manage-categories").find(".text-warning").remove();

        let nameCategoryExplode = $(this).attr('id').split('-');

        let nameCategory = nameCategoryExplode[nameCategoryExplode.length - 1];
        
        $.ajax({
            url: "../../delete/cuCategory/" + nameCategory,
            dataType: "json",
            async: true,

            success: function(data, status) {
                
                if (data == false) {
                    $(".existing-category p").parent().append(
                        '<p class="text-warning mt-3">Des types de meules sont liés à cette catégorie, la suppression est impossible</p>'
                    );
                } else {
                    $("#name-category-" + nameCategory).parent(".row").remove();
                } 
            }
        });
    });

    $("#close-categories").on("click", function(event) {
        location.reload();
    })
});

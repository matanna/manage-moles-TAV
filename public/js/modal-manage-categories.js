//This file is for change name of cuCategory choosed with Ajax

$(document).ready(function() {

    //This block is for add a new category
    $("#button-new-category").on("click", function(event){

        let addNewCategory = $("#new-category").val();

        $.ajax({
            url: "../../manage/add/cuCategory",
            data: {addNewCategory: addNewCategory},
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
                            <a href="#" class="ml-3">Supprimer</a>\
                        </div>\
                    </div>'
                );

                $("#new-category").val('');
            }
        });
    });

    //This block code is for change name of category in an input for rename the category
    $(".existing-category").on("click",".rename-category", function(event) {

        let nameCategoryExplode = $(this).attr('id').split('-');

        let nameCategory = nameCategoryExplode[nameCategoryExplode.length - 1];
    
        $("#name-category-" + nameCategory).html(
            '<form action="#" method="POST" class="d-flex">\
                <input name="input-change-name-category-' + nameCategory + '" type="text"  placeholder="' + nameCategory + '" id="input-change-name-category-' + nameCategory + '" />\
                <button type="button" class="btn btn-sm btn-outline-success" id="button-change-name-category-' + nameCategory + '">Valider</button>\
            </form>'
        );

        $("#button-change-name-category-" + nameCategory).on("click", function(event) {

            let newNameCategory = $("#input-change-name-category-" + nameCategory).val();

            $.ajax({
                url: "../../manage/rename/cuCategory/" + nameCategory,
                data: {newNameCategory: newNameCategory},
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
                } 
            });
        });
    });

    //This block is for delete a category
    $(".existing-category").on("click",".delete-category", function(event){

        let nameCategoryExplode = $(this).attr('id').split('-');

        let nameCategory = nameCategoryExplode[nameCategoryExplode.length - 1];
        console.log(nameCategory);
        $.ajax({
            url: "../../manage/delete/cuCategory/" + nameCategory,
            dataType: "json",
            async: true,

            success: function(data, status) {
                if (data == false) {
                    $("#name-category-" + nameCategory).parent(".row").append(
                        '<p>Des types de meules sont liés à cette catégorie, la suppression est impossible</p>'
                    );
                } else {
                    $("#name-category-" + nameCategory).parent(".row").remove();
                }
                

            }
        });
    });
});
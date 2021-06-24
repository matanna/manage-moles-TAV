//This file is for change name of cuCategory choosed with Ajax

$(document).ready(function() {

    //This block code is for change name of category in an input for rename the category
    $(".rename-category").on("click", function(event) {

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
                
                    nameCategory = data;

                    $("#name-category-" + nameCategory).parent().html(
                        '<span class="name-category" id="name-category-' + nameCategory + '">\
                        ' + nameCategory + '\
                        </span>'
                    );
                } 
            });
        });
    });
});
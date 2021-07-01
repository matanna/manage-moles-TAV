//This file is for update he quantity of wheels cu. The form is in the popup

$(document).ready(function() {

    //First, we hide the popup
    $(".popup").hide();
    
    $(".details").on("click", function(event) {

        $(".popup").show();

        $('.wheels-cu').remove();

        //We retrieve cu name by current path
        let urlExplode = ($(location).attr("href")).split('/');
        //we use slice for remove "#" present in the end of cuName
        
        let lastChar = (urlExplode[urlExplode.length - 1]).substr(-1);

        let cuName = '';
        if (lastChar == '#') {
            cuName = (urlExplode[urlExplode.length - 1]).slice(0, -1);
        } else {
            cuName = (urlExplode[urlExplode.length - 1])
        }

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
                for (let wheels of data['wheelsCuType'].wheelsCus) {
                    
                    $('#display-wheels-cu').append(
                        '<div class="col-12 wheels-cu">\
                            <div class="row border-bottom text-center pt-2 pb-2">\
                                <div class="col-1">' + wheels['provider']['name'] + '</div>\
                                <div class="col-2">' + wheels['ref'] + '</div>\
                                <div class="col-3">' + wheels['tavName'] + '</div>\
                                <div class="col-1">' + wheels['grain'] + '</div>\
                                <div class="col-1">' + wheels['diameter'] + '</div>\
                                <div class="col-2">' + wheels['height'] + '</div>\
                                <div class="col-1" id="stock' + wheels['id'] + '">' + wheels['stock'] + '</div>\
                                <div class="col-1">\
                                    <a href="#" data-toggle="modal" data-target="#change-quantity' + wheels['id'] + '">\
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-pencil-square icon" viewBox="0 0 16 16">\
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>\
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>\
                                        </svg>\
                                    </a>\
                                </div>\
                            </div>\
                        </div>\
                        <div class="modal" id="change-quantity' + wheels['id'] + '" tabindex="-1" aria-hidden="true" role="dialog">\
                            <div class="modal-dialog" role="document">\
                                <form method="post" action="#">\
                                    <div class="modal-content">\
                                        <div class="modal-header">\
                                            <h5 class="modal-title">Quantité en stock :</h5>\
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">\
                                                <span aria-hidden="true">&times;</span>\
                                            </button>\
                                        </div>\
                                        <div class="modal-body">\
                                            <input type="number" id="quantity' + wheels['id'] + '" name="quantity" >\
                                        </div>\
                                        <div class="modal-footer">\
                                            <button type="button" class="btn btn-primary change-quantity" id="'+ wheels['id'] + '">Enregistrer</button>\
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>\
                                        </div>\
                                    </div>\
                                </form>\
                            </div>\
                        </div>' 
                    );
                }
                
            }
        })

    });
});
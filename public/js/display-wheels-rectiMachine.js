//This file is for displaying wheels in terms of their rectiMachine and their position

$(document).ready(function() {

    $('#valid-choice').on("click",function(event) {

        let rectiMachineName = $('#choice_position_of_recti_machine_form_rectiMachine option:selected').val();

        let positionName = $('#choice_position_of_recti_machine_form_position option:selected').val();

        $.ajax({

            url: '../stock/rectiMachine/wheels',
            type: "POST",
            data: {rectiMachineName: rectiMachineName, positionName: positionName},
            dataType: "json",
            async: true,

            success: function(data, status) {

                let html = '';

                for (let wheels of data) {
                    html = html + '<div class="row text-center pt-2 pb-2" id="wheels-rectiMachine-' + wheels['id'] + '">\
                                      <div class="col-1">' + wheels['provider']['name'] + '</div>\
                                      <div class="col-2 ref">' + wheels['ref'] + '</div>\
                                      <div class="col-3 tav-name">' + wheels['TAVname'] + '</div>\
                                      <div class="col-1 stock">' + wheels['stock'] + '</div>\
                                      <div class="col-1 maj"></div>\
                                  </div>\
                                  <hr>'
                }
                console.log(html);
                $('#wheels-rectiMachine-head').parent().append(html);

            }
        });

    });

})
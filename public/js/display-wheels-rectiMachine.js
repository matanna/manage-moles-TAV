//This file is for displaying wheels in terms of their rectiMachine and their position

$(document).ready(function() {

    $('#valid-choice').on("click",function(event) {

        

        let rectiMachineName = $('#choice_position_of_recti_machine_form_rectiMachine option:selected').val();

        let positionName = $('#choice_position_of_recti_machine_form_position option:selected').val();

        console.log(positionName);

    });

})
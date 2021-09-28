//First, we empty position list on new-wheels-form
$(document).ready(function() {
    if (!document.getElementById('add-new-wheels').getElementsByClassName('form-error-message')) {
        $('.new-position').empty().append('<option value="selected=selected">Position</option>');
    }
    
    if (document.getElementById('all-wheels-rectiMachine').getElementsByClassName('form-error-message')) {
        $('.form-error-message').parents('.modal').modal('show');
    }

});
console.log($("#add-new-wheels"));
//If violation on form, the modal can not be closed
$('body').on("click", function(event) {
    if ($("#all-wheels-rectiMachine").find('.form-error-message').length > 0) {
        $('.form-error-message').parents('.modal').modal('show');
    }
})

let url = $(location).attr("href");

//This code block is for adapt position list when a machine is choose on add a new whells rectiMachine form page
$(document).ready(function(){

    $(".new-machine").on("change", function(event) {
        
        let id = $(this).attr('id');

        //We retrieve value of select rectiMachine
        let rectiMachineName = $('#' + id + ' option:selected').text();

        let positionName = id.replace('rectiMachine', 'position');

        $.ajax({
            url: url,
            type: "POST",
            data: 'rectiMachineName=' + rectiMachineName,
            dataType: "json",
            async: true,

            success: function(data, status) {

                //We retrieve the form updated with positions linked to choice rectiMachine and we change only the positions field
                let positions = $(data.content).find('#' + positionName);

                $('#' + positionName).replaceWith(positions);
            }
        })
        
    })
});

//This code block is for adapt position list when a machine is choose on edit a new wheels rectiMachine form page
$(document).ready(function(){

    $(".edit-machine").on("change", function(event) {
        
        //We retrieve id of the choice list machine
        let idMachineList = $(this).attr('id');
        
        //We retrieve value of select rectiMachine
        let rectiMachineName = $('#' + idMachineList + ' option:selected').text();

        //We explose the name of rectiMachineList id for get an array
        let exploseNameId = idMachineList.split('_');

        let idPositionList = '';

        //We find id of position field list
        if (exploseNameId[4] == 'rectiMachine') {
            exploseNameId[4] = 'position';
            idPositionList = exploseNameId.join('_');
        }

        $.ajax({
            url: "/manage/wheels-rectiMachine",
            type: "POST",
            data: {rectiMachineName: rectiMachineName},
            dataType: "json",
            async: true,

            success: function(data, status) {

                //We retrieve the form updated with positions linked to choice rectiMachine and we change only the positions field
                let positions = $(data.content).find('#wheels_recti_machine_form_position').html();

                //We replace values in position list in term of recti machine choosed
                $('#' + idPositionList).empty().append(positions);
           }
       })
    })
});
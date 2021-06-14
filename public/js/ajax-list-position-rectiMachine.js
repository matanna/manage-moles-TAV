//This code block is for adapt position list when a machine is choose on add a new whells rectiMachine form page
$(document).ready(function(){
    
    $(".new-machine").on("change", function(event) {
         
        //We retrieve value of select rectiMachine
        let rectiMachineName = $('#wheels_recti_machine_form_rectiMachine' + ' option:selected').text();

        $.ajax({
            url: "/manage/wheels-rectiMachine",
            type: "POST",
            data: 'rectiMachineName=' + rectiMachineName,
            dataType: "json",
            async: true,

            success: function(data, status) {

                //We retrieve the form updated with positions linked to choice rectiMachine and we change only the positions field
                let positions = $(data.content).find('#wheels_recti_machine_form_position');

                $('#wheels_recti_machine_form_position').replaceWith(positions);
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
                let positions = $(data.content).find('#wheels_recti_machine_form_position').parent();
                
                //We replace id by the real id of position list
                positions.attr('id', idPositionList);
               
                $('#' + idPositionList).replaceWith(positions);
           }
       })
    })
});
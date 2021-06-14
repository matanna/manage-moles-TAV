//This file is for adapt position list when a machine is choose on add/edit mole page

$(document).ready(function(){
    
    $(".new-machine").on("change", function(event) {
        
        //We retrieve id of the choice list machine
        let idMachineList = $(this).attr('id');
        
        //We retrieve value of select machine in the edit mole form
        let rectiMachineName = $('#' + idMachineList + ' option:selected').text();

        let idPositionList = idMachineList.replace('rectiMachine', 'position');

        $.ajax({
            url: "/manage/wheels-rectiMachine",
            type: "POST",
            data: 'rectiMachineName=' + rectiMachineName,
            dataType: "json",
            async: true,

            success: function(data, status) {

                //We retrieve the form updated with positions linked to choice rectiMachine and we change only the positions field
                let positions = $(data.content).find('#' + idPositionList);

                $('#' + idPositionList).replaceWith(positions);
                
            }
        })
        
    })
});

$(document).ready(function(){
    
    $(".edit-machine").on("change", function(event) {
        
        //We retrieve id of the choice list machine
        let idMachineList = $(this).attr('id');
        
        //We retrieve value of select machine in the edit mole form
        let rectiMachineName = $('#' + idMachineList + ' option:selected').text();

        //We explose the name of rectiMachineList id for get an array
        let exploseNameId = idMachineList.split('_');

        let idPositionList = '';

        if (exploseNameId[4] == 'rectiMachine') {
            exploseNameId[4] = 'position';
            idPositionList = exploseNameId.join('_');
        }

        console.log(idPositionList);
        /*$.ajax({
            url: "/manage/wheels-rectiMachine",
            type: "POST",
            data: 'rectiMachineName=' + rectiMachineName,
            dataType: "json",
            async: true,*/

            //success: function(data, status) {

                /*//We retrieve the form updated with positions linked to choice rectiMachine and we change only the positions field
                let positions = $(data.content).find('#' + idPositionList);
                console.log(positions);

                $('#' + idPositionList).replaceWith(positions);*/
                
           // }
       // })
        
    })
});
//This file is for adapt position list hen a machine is choose on add/edit mole page

$(document).ready(function(){
    
    $(".machine").on("click", function(event) {
        
        //We retrieve id of the choice list machine
        let idMachineList = $(this).attr('id');

        //We retrieve value of select machine in the edit mole form
        let machineName = $('#' + idMachineList + ' option:selected').text();

        //We replace the word 'machine' per the word 'position' in the id of machine for find the id of position
        let idPositionList = idMachineList.replace('machine', 'position');

        console.log(idPositionList);
        $.ajax({
            url: "/manage/moles-rectiligne",
            type: "POST",
            data: 'machineName=' + machineName,
            dataType: "json",
            async: true,

            success: function(data, status) {

                let positionOption = '';
                $('.position-list').remove();
                let i = 0;
                for (let position of data) {
                    positionOption = positionOption + '<option value="' + position.name + '"class="position-list">' + position.name + '</option>';
                    i++;
                }
                $('#' + idPositionList).append(positionOption);
            }
        })
        
    })
});
$(document).ready(function(){
    
    $("#js-new-mole").on("click", "#machine", function(event) {
        
        //We retrieve value of select machine in the new mole form
        let value = $('#meules_recti_machine option:selected').text();

        $.ajax({
            url: "/manage/moles-rectiligne",
            type: "POST",
            data: 'machineName=' + value,
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
                $('#meules_recti_position').append(positionOption);
            }
        })
        
    })
});

$(document).ready(function(){
    
    $("#js-edit-mole").on("click", ".editMeuleMachine", function(event) {
        
        //We retrieve value of select machine in the new mole form
        let value = $('.editMeuleMachine option:selected').text();

        $.ajax({
            url: "/manage/moles-rectiligne/machine",
            type: "POST",
            data: 'machineName=' + value,
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
                $('.editMeulePosition').append(positionOption);
            }
        })
        
    })
});
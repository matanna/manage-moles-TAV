//This file is for adapt typeMeuleCu list in the choice input in manageMeuleCu page (add a new meuleCu)

$(document).ready(function(){
    
    $(".cu").on("change", function(event) {
        
        //We retrieve id of the choice list machine
        let idCuList = $(this).attr('id');
        
        //We retrieve value of select machine in the edit mole form
        let cuName = $('#' + idCuList + ' option:selected').text();
        
        //We replace the word 'machine' per the word 'position' in the id of machine for find the id of position
        let idTypeMeuleCuList = idCuList.replace('cu', 'typeMeuleCu');
        
        $.ajax({
            url: "/manage/meule-cu",
            type: "POST",
            data: 'cuName=' + cuName,
            dataType: "json",
            async: true,

            success: function(data, status) {
                
                //data is an array of typeMeuleCu received by the controller
                let typeMeuleCuOption = '';
                
                //First, we remove all option in the list
                $("#" + idTypeMeuleCuList).children().remove();

                let i = 0;

                //We initialize an array for add one occurence of each typeMeuleCu
                let typeMeuleList = [];

                for (let typeMeuleCu of data) {
                    
                    //if typeMeuleCu name isn't in typeMeuleList[], we push it in the array and we add a new option value in select tag
                    if (typeMeuleList.indexOf(typeMeuleCu.typeMeule) == -1) {
                        
                        typeMeuleList.push(typeMeuleCu.typeMeule);
                        typeMeuleCuOption ='<option value="' + typeMeuleCu.typeMeule + '">' + typeMeuleCu.typeMeule + '</option>';
                        $('#' + idTypeMeuleCuList).append(typeMeuleCuOption);
                    }
                    i++;
                }
            }
        })
        
    })
});
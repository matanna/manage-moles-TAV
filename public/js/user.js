//This file is for display password input for change it if is needed

$(document).ready(function() {

    $('.edit-user').on("click", '.change-password', function(event) {
        
        $('.password').removeAttr('hidden');
        $('.password').removeAttr('value');

        $('.change-password').remove();

    });

});


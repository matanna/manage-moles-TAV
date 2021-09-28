
$(document).ready(function() {
    
    //If violation on form, the modal is open on page loading 
    if ($("#list-users").find('.form-error-message').length > 0) {
        $('.form-error-message').parents('.modal').modal('show');
    }
    
    //If violation on form, the modal can not be closed
    $('body').on("click", function(event) {
        if ($("#list-users").find('.form-error-message').length > 0) {
            $('.form-error-message').parents('.modal').modal('show');
        }
    })
    
    //For change password of an user
    $('.edit-user').on("click", '.change-password', function(event) {
        
        $('.password').removeAttr('hidden');
        $('.password').removeAttr('value');

        $('.change-password').remove();

    });

});


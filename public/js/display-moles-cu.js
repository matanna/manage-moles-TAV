//When the page is loading
window.onload = function() {

    //We retrieve all elements with class "details"
    const details = document.getElementsByClassName("details");

    //For each "details", we listen click event for retrieve his id
    for(let i = 0; i < details.length; i++) {
        details[i].addEventListener('click', function(){
            let typeId = details[i].getAttribute('id');

            //We replace the word "button" in id by "display" for display the div with moles
            let moleId = typeId.replace('button', 'display');
            
            if (document.getElementById(moleId).getAttribute("hidden")) {
                document.getElementById(moleId).removeAttribute("hidden");

            } else {
                document.getElementById(moleId).setAttribute("hidden", "");
                document.location.reload();
            }

            

        });
    }
    
}

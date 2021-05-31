const details = document.getElementsByClassName("details");

for(let i; i < details.length; i++) {
    details[i].addEventListener('click', function(){
        alert(this.id);
    });
}
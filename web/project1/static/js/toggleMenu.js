function toggleMenu() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}

function clearUserFields() {
    let btnClearUserFields = document.querySelector('#clearUserFields');
    btnClearUserFields.addEventListener('click', function() {
        let elements = document.querySelector('input');
        for (let i=0; i<elements; i++) {
            if (elements[i].type == 'text' && elements[i].type == 'password') {
                elements[i].value = '';
            }
        }
    })
}
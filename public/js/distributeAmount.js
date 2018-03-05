function getNumberOfFormInputs(id){
    var inputfields = document.querySelectorAll('[id^=b' + id +']');
    alert(inputfields[0].value);
    return inputfields.length;
}

function distribute(id) {
    numberOfFormInputs = getNumberOfFormInputs(id);

}


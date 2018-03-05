//TODO: Das auf Vue konvertieren

var counter = 0;
var schueler;
var inserttext = " ";

function printschueler(item, index) {
    inserttext += "<tr>" +
        "<td>" + counter + "</td>" +
        "<td>" + item['vorName'] + " " + item['nachName'] + "</td>" +
        "<td> <input type='number' id='" + counter + "_" + item['id'] + "' name='" + counter + "_" + item['id'] + "' placeholder='Betrag' class='form-control'> </td> " +
        "</tr>";
    //alert(inserttext);
}

function add_fields() {
    counter++;
    inserttext = "<tr><td> <input type='text' name='rechnungspos_" + counter + "' class='form-control' placeholder='Name der Poisition'> </td></tr>" +
        "<tr> <td><input type='number' name='gesamtbetrag_i" + counter + "' id='gesamtbetrag_i" + counter + "' class='form-control' placeholder='Gesamtbetrag'> </td>" +
        "<td> <input type='button' value='Betrag auf alle Schüler aufteilen' class='btn btn-success' onclick='distribute(counter);'> </td> </tr>" +
        "<tr><th>ID</th><th>Name:</th> <th>Betrag:</th></tr>";
    schueler.forEach(printschueler);
    document.getElementById("schueler").innerHTML += inserttext;

}
var insertion = "";
function printqueriedstudents(item, index) {
    insertion += item['vorName'] + " " + item['nachName'] + "<br>";
}

$(".classes").on('click', function () {
    var checkbox_value = "";
    $(":checkbox").each(function () {
        var ischecked = $(this).is(":checked");
        if (ischecked) {
            checkbox_value += $(this).val() + "|";
        }
    });

    $.ajax({
        type: "POST",
        url: "/bill/new",
        data: {
            '_token': $('input[name=_token]').val(),
            'classes': checkbox_value,
        },

        success: function (response) {
            schueler = response['schueler'];
            schueler.forEach(printqueriedstudents);
            document.getElementById('studentlist').innerHTML = insertion;
            insertion = " ";
            //document.write("<pre>"+schueler[1]['vorName']+"<pre>");
        }
    })
});
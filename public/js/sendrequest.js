$(".savebill").on('click', function () {
    $("input.schuelerbetrag").each(function () {
        alert($(this).val());
        var input = $(this); // This is the jquery object of the input, do what you will
    });
    $.ajax({
        type: "POST",
        url: "/bill/save",
        data: {
            '_token': $('input[name=_token]').val(),
            'rechnungsposes': {
                /*
                rechnungspos_1{
                    gesamtbetrag: 1000
                    bezeichnung: Bus
                    schueler:{
                        1: 10               jeweils SchülerID als Namen der
                        2: 30               Variable und den Betrag als Wert
                        64: 20
                        23: 15
                    }
                }
                rechnungspos_2{
                    gesamtbetrag: 1000
                    bezeichnung: Hotes
                    schueler:{
                        1: 10               jeweils SchülerID als Namen der
                        2: 30               Variable und den Betrag als Wert
                        64: 20
                        23: 15
                    }
                }
                usw...
                 */
            }
        },

        success: function (response) {
            schueler = response['schueler'];
            schueler.forEach(printqueriedstudents);
            document.getElementById('studentlist').innerHTML = insertion + "</table> <tr><td> " +
                "<br><input type='button' value='Betrag auf alle Schüler aufteilen' class='btn btn-primary' onclick='checkAll();'> </td> </tr>";
            insertion = " ";
            //document.write("<pre>"+schueler[1]['vorName']+"<pre>");
        }
    })
});
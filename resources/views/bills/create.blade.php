@extends('layouts.master')

@section('content')
    <!-- MASSIVES TODO: Das hier verschönern, eigentlich benutzbar machen ohne das ich mich selber damit verwirre -->
    <h1>Neue Rechnung erstellen:</h1>
    <h2>Klassen auswählen:</h2>
    <div class="container">
        <div class="row">
            <div class="col col-3">
                <form action="/bill/new" method="post">
                    {{csrf_field()}}
                    @foreach($klassen as $klasse)
                        <input type="checkbox" name="{{$klasse->name}}" value="{{$klasse->name}}"> {{$klasse->name}}<br>
                    @endforeach
                    <input type="button" value="Schueler hinzufügen" class="btn btn-primary classes">
                </form>
            </div>
            <div class="col col-3">
                <form action="/bill/fill" method="post">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="grund">Grund:</label>
                        <input type="text" id="text" name="text" placeholder="Zahlungsgrund" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="button" value="Rechnungsposition hinzufügen" class="btn btn-success"
                               onclick="add_fields();" id="rechnungspos_val">
                        <div id="wrapper">

                            <!-- Hier kommen Rechnungspositionen hin (Javascript) -->
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Rechnung Speichern" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Ajax Script -->
    <script !src="">
        var counter = 1;
        var schueler;
        var insertion = "";

        function printschueler(item, index) {

            insertion += '<div class="form-group row">'
                + item['vorName'] + ' ' + item['nachName'] + ': <input type="number" id="'+ counter + '_' + item['id'] + '" name="' + item['id'] + '" placeholder="Betrag" class="form-control"> ' +
                '</div>';
        }

        function add_fields() {
            schueler.forEach(printschueler);
            var divs = '<div id="rechnungswrapper">' +
                '<input type="number" name="gesamtbetrag_' + counter + '" id="gesamtbetrag_' + counter + '" class="form-control" placeholder="Gesamtbetrag">' +
                '<input type="button" value="Betrag auf alle Schüler aufteilen" class="btn btn-success" onclick="distribute(counter);">' +
                '<span>Rechnungsposition: <input type="text" name="rechnungspos' + counter + '" class="form-control" placeholder="Name der Poisition">' +
                insertion +
                '</div>';
            document.getElementById('wrapper').innerHTML += divs;
            counter++;
        }

        $(".classes").on('click', function () {
            var checkbox_value = "";
            $(":checkbox").each(function () {
                var ischecked = $(this).is(":checked");
                if (ischecked) {
                    checkbox_value += $(this).val() + "|";
                }
            });
            //alert(checkbox_value);
            $.ajax({
                type: "POST",
                url: "/bill/new",
                data: {
                    '_token': $('input[name=_token]').val(),
                    'classes': checkbox_value,
                },

                success: function (response) {

                    schueler = response['schueler'];
                }
            })
        });
    </script>
    <script>
        function distribute(id) {
            id=-1;
            console.log(id);
            betrag = document.getElementById("gesamtbetrag_"+id).value;
            console.log(betrag);
        }
    </script>
@endsection
@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Neue Rechnung erstellen:</h1>
    <h2>Klassen auswählen:</h2>
    <div class="row">

        <form action="/bill/new" method="post">
            {{csrf_field()}}
            @foreach($klassen as $klasse)
                <input type="checkbox" name="{{$klasse->name}}" value="{{$klasse->name}}" > {{$klasse->name}}<br>
            @endforeach
            <input type="button" value="Schueler hinzufügen" class="btn btn-primary classes" >
        </form>
    </div>
    <div class="row">
        <form action="/bill/fill" method="post">
            {{csrf_field()}}
            <div class="form-group">
                <label for="grund">Grund:</label>
                <input type="text" id="text" name="text" placeholder="Zahlungsgrund" class="form-control">
            </div>
            <div class="form-group">
                <input type="button" value="Rechnungsposition hinzufügen" class="btn btn-success" onclick="add_fields();">
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
    function printschueler(item, index){
        document.getElementById("wrapper").innerHTML += item['vorName'] + "<br>";
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
            type    :"POST",
            url     :"/bill/new",
            data: {
                '_token': $('input[name=_token]').val(),
                'classes': checkbox_value,
            },

            success :function(response){

                response['schueler'].forEach(printschueler);
            }
        })
    });
</script>
@if($data != null)
<script>
    var counter = 1;
    function add_fields(){
        var name = "rechnungspos"+counter+"_";
        var dummy = '<div id="rechnungswrapper">' +
            '<span>Rechnungsposition: <input type="text" name="rechnungspos' + counter +'" class="form-control" placeholder="Name der Poisition">' +
            '</div>' +
                @foreach($schueler as $s)
                    '<div class="form-group">' +
            '{{$s->vorName}} {{$s->nachName}}<input type="number" id="' + name +'{{$s->id}}" name="' + name +'{{$s->id}}" placeholder="Betrag" class="form-control">' +
            '</div>' +
                @endforeach
                    '';
        document.getElementById('wrapper').innerHTML += dummy;
        counter++;
    }
</script>
@endif
@endsection
@extends('layouts.master')

@section('content')
    <h1>Neue Rechnung:</h1>

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
@endsection
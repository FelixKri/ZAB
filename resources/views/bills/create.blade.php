@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Neue Rechnung erstellen:</h1>
    <h2>Klassen auswählen:</h2>
    <div class="row">
            <div class="col col-md-1"></div>
        <form action="/bill/new" method="post">
            {{csrf_field()}}
            @foreach($klassen as $klasse)
                <input type="checkbox" name="{{$klasse->name}}" value="{{$klasse->name}}" > {{$klasse->name}}<br>
            @endforeach
            <input type="submit" value="Weiter" class="btn btn-primary">
        </form>
    </div>
</div>
@endsection
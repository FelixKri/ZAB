@extends('layouts.master')
@push('scripts')
    <!--<script type="text/javascript" src="{{ URL::asset('js/sendrequest.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/createbill.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/distributeAmount.js') }}"></script> -->
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
@section('content')
    <div class="container">
    <!-- MASSIVES TODO: Das hier verschönern, eigentlich benutzbar machen ohne das ich mich selber damit verwirre -->
    <form action="/bill/new" method="post">
        {{csrf_field()}}
        @foreach($klassen as $klasse)
            <div class="inline-wrapper">
                <input type="checkbox" name="{{$klasse->name}}"
                       value="{{$klasse->name}}"> {{$klasse->name}}<br>
            </div>
        @endforeach
        <br>
        <input type="button" value="Klassen hinzufügen" class="btn btn-primary classes">
    </form>
    <studentform></studentform>
    </div>
@endsection
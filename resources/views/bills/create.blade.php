@extends('layouts.master')
@push('scripts')
    <script xmlns="">
        var Laravel = {
            'csrfToken': '{{csrf_token()}}'
        };
    </script>
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ mix('js/autofill.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

@endpush
@section('headers')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
@endsection
@section('content')
    <div class="container">
        @include('layouts.navbar')
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
        <studentform :id="id" v-if="students != null && students.length > 0"></studentform>
    </div>
    @include('layouts.errors')
@endsection
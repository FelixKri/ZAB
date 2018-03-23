@extends('layouts.master')
@push('scripts')
    <script src="{{ mix('js/adminpanel.js') }}"></script>
@endpush
@section('headers')
    <link rel="stylesheet" href="{{ URL::asset('css/register.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}"/><!-- Ajax stuff -->
@endsection
@section('content')
    <h1 style="text-align:center; margin-top: 15vh;">Schüler hinzufügen</h1>
    <div class="jumbotron">
        <form action="/register" method="post">
            <studentregister></studentregister>
            <input type="submit">
        </form>
    </div>
@endsection

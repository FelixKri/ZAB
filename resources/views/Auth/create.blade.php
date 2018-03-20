@extends('layouts.master')
@push('scripts')

@endpush
@section('headers')
    <link rel="stylesheet" href="{{ URL::asset('css/register.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}"/><!-- Ajax stuff -->
@endsection
@section('content')
    <h1 style="text-align:center; margin-top: 15vh;">Login</h1>
    <div class="row justify-content-center align-items-center">
        <div class="formwrapper d-flex align-items-center text-dark">
            <form action="/register" method="post" enctype="multipart/form-data" class="registerform">
                {{csrf_field()}}
                <input type="text" name="vorName" value="" id="vorName" placeholder="Vorname">
                <input type="text" name="nachName" value="" id="nachName" placeholder="Nachname">
                <input type="email" name="email" value="" id="email" placeholder="Email Adresse der Schule">
                <input type="password" name="password" value="" id="password" placeholder="Wähle ein sicheres Passwort">
                <input type="submit" name="submit" value="Sign Up!" class="btn btn-primary">
                @include('layouts.errors')
            </form>
        </div>
@endsection

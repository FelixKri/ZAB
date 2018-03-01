@extends('layouts.master')

@section('content')

    <h1>Register</h1>
    <form action="/register" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name">Vorname:</label>
            <input type="text" name="vorName" value="" id="vorName" placeholder="Vorname" class="form-control">
        </div>
        <div class="form-group">
            <label for="name">Nachname:</label>
            <input type="text" name="nachName" value="" id="nachName" placeholder="Nachname" class="form-control">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" value="" id="email" placeholder="Email Adresse der Schule" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" value="" id="password" placeholder="Wähle ein sicheres Passwort" class="form-control">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Password Confirmation</label>
            <input type="password" name="password_confirmation" value="" id="password_confirmation" placeholder="Passwort bestätigen" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" name="submit" value="Sign Up!" class="btn btn-primary">
        </div>
        <small>Bereits ein Account? <a href="/login">Anmelden!</a></small>
        @include('layouts.errors')
    </form>
@endsection

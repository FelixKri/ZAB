@extends('layouts.master')
@push('scripts')

@endpush
@section('headers')
    <link rel="stylesheet" href="{{ URL::asset('css/login.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}"/><!-- Ajax stuff -->
@endsection
@section('content')
    <h1 style="text-align:center; margin-top: 15vh;">Login</h1>
    <div class="row justify-content-center align-items-center">
        <div class="formwrapper d-flex align-items-center text-dark">
            <form action="/login" method="post" class="loginform">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="username" class="loginlabel">E-Mail</label>
                    <input type="email" name="email" value="" id="email" class="form-control form-control-lg">
                </div>
                <div class="form-group">
                    <label for="password" class="loginlabel">Password</label>
                    <input type="password" name="password" value="" id="password" class="form-control form-control-lg">
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" name="submit" value="Sign In" class="btn btn-primary btn-lg" style="width: 100%;">
                </div>
                <small> Not a Member yet? <a href="/register"> Sign Up </a></small>
                @include('layouts.errors')
            </form>
        </div>
    </div>
@endsection

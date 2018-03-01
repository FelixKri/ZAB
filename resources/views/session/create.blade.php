@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col col-sm-8">
            <h1> Sign In </h1>
            <form action="/login" method="post">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="username">E-Mail</label>
                    <input type="email" name="email" value="" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" value="" id="password" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Sign In" class="btn btn-primary">
                </div>
                <small> Not a Member yet? <a href="/register"> Sign Up </a></small>
                @include('layouts.errors')
            </form>
        </div>
    </div>
@endsection

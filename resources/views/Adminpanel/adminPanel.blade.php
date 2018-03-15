@extends('layouts.master')
@push('scripts')

@endpush
@section('headers')
    <link rel="stylesheet" href="{{ URL::asset('css/adminpanel.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}"/><!-- Ajax stuff -->
@endsection
@section('content')
    <div class="sidebar">
        <h3>Admin Panel</h3>
        <hr>
        <a href="/student/add" class="btn btn-primary">Schüler hinzufügen</a>

        <div class="acc-information">
            <img src="http://dopa.mn/images/justin-schier-2012-400x400-01.jpg" alt=""
                 style="width: 65px; height: 64px; border-radius: 100%;">
            <span class="align-middle">{{  Auth::user()->vorName }} {{Auth::user()->nachName }}</span>
        </div>
    </div>
    <div class="wrapper">
        <div class="t-wrapper">
            <h3 style="">Offene Abrechnungen:</h3>
            <div class="table-wrapper">
                <table class="rechnungstable table table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Grund</th>
                        <th scope="col">Abrechner</th>
                        <th scope="col">Anzahl Rechnungspos.</th>
                        <th scope="col">Bearbeiten</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($bills as $bill)
                        <tr>
                            <th scope="row">{{$bill->id}}</th>
                            <td>{{$bill->reason}}</td>
                            <td>{{$bill->abrechner->vorName}} {{$bill->abrechner->nachName}}</td>
                            <td>4</td>
                            <td>
                                <small><a href="/">Edit</a></small>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="m-wrapper">
            <h4>Admins:</h4>
            <div class="table-wrapper">
                <table class="admintable table table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Bearbeiten</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($members as $member)
                        <tr>
                            <th scope="row">{{$member->id}}</th>
                            <td>{{$member->vorName}} {{$member->nachName}}</td>
                            <td>{{$member->email}}</td>
                            <td>
                                <small><a href="/">Edit</a></small>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="s-wrapper">
            <h4>Schueler:</h4>
            <div class="table-wrapper">
                <table class="schuelertable table table-hover">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Details</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)
                        <tr>
                            <th scope="row">{{$student->id}}</th>
                            <td>{{$student->vorName}} {{$student->nachName}}</td>
                            <td>
                                <small><a href="/">Details</a></small>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
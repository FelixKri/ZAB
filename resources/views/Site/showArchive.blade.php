@extends('layouts.master')

@section('content')
    <div class="container">
        @include('layouts.navbar')
        <br>
        <h1>Offene Rechnungen:</h1>
        @foreach($bills as $bill)
            <div class="card text-dark" id="r{{$bill[0]}}" style="margin-bottom: 8px;">
                <div class="card-header">
                    <h2 class="card-title">{{$bill[1]}}</h2>
                    <p class="card-subtitle mb-2 text-muted">
                        Abrechner: {{$bill[1]}} {{$bill[2]}}
                    </p>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @foreach($bill as $billpos)
                                @if(isset($billpos['name']))
                                <li class="list-group-item">
                                    <div class="text-dark" id="{{$billpos['rechnungsposid']}}">
                                        <h4 class="card-subtitle">Position: {{$billpos['name']}}</h4>
                                        <p class="card-text">Betrag: {{$billpos['betrag']}}€</p>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
@endsection
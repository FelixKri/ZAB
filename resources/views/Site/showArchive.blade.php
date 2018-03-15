@extends('layouts.master')

@section('content')
<div class="container">
	@include('layouts.navbar')
    <hr>
    <h1>Bezahlte Rechnungen:</h1>
    @foreach($bills as $bill)
    <div class="jumbotron">
		<h4>Name: {{$bill['name']}}</h4>
		<p>Betrag: {{$bill['betrag']}}€</p>
		<p>Abrechner: {{$bill['abrechnerVor']}} {{$bill['abrechnerNach']}}</p>
	</div>
	@endforeach
</div>
@endsection
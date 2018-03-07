@extends('layouts.master')

@section('content')
<div class="container">
    <hr>
    <h1>Offene Rechnungen:</h1>
    @foreach($bills as $bill)
    <div class="jumbotron" id="{{$bill['rechnungsposid']}}">
		<h4>Name: {{$bill['name']}}</h4>
		<p>Betrag: {{$bill['betrag']}}€</p>
		<p>Abrechner: {{$bill['abrechnerVor']}} {{$bill['abrechnerNach']}}</p>
		<form method="post">
			<input type="button" class="btn btn-primary pay" value="Bezahlen" name="{{$bill['rechnungsposid']}}">
		</form>
	</div>
	@endforeach
</div>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<script type="text/javascript" src="{{ URL::asset('js/payBill.js') }}"></script>
@endsection
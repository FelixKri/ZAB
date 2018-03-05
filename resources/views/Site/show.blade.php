@extends('layouts.master')

@section('content')
<div class="container">
    <hr>
    <h1>Offene Rechnungen:</h1>
    @foreach($openBill as $bill)
    <div class="jumbotron">
		<h4>Name: {{$bill['name']}}</h4>
		<p>Betrag: {{$bill['betrag']}}€</p>
		<p>Abrechner: {{$bill['abrechnerVor']}} {{$bill['abrechnerNach']}}</p>
		<form method="post">
			<input type="submit" class="btn btn-primary" name="Bezahlen" value="Bezahlen">
		</form>
	</div>
	@endforeach
</div>
@endsection
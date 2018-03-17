@extends('layouts.master')

@push('scripts')
    <script type="text/javascript" src="{{ mix('js/payBill.js') }}"></script>
@endpush

@section('headers')
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('content')
<div class="container">
	@include('layouts.navbar')
	<br>
    <h1>Offene Rechnungen:</h1>
    @foreach($bills as $bill)
    <div class="jumbotron text-dark" id="{{$bill['rechnungsposid']}}">
		<h4>Name: {{$bill['name']}}</h4>
		<p>Betrag: {{$bill['betrag']}}€</p>
		<p>Abrechner: {{$bill['abrechnerVor']}} {{$bill['abrechnerNach']}}</p>
		<form method="post">
			<input type="button" class="btn btn-primary pay" value="Bezahlen" name="{{$bill['rechnungsposid']}}">
		</form>
	</div>
	@endforeach
</div>
@endsection
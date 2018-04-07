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
    <div class="jumbotron text-dark" id="r{{$bill[0]}}">
    	<h2>Rechnung: {{$bill[1]}}</h2>
	    @foreach($bill as $billpos)
	    	@if(isset($billpos['name']))
		    <div class="jumbotron text-dark" id="{{$billpos['rechnungsposid']}}">
				<h4>Name: {{$billpos['name']}}</h4>
				<p>Betrag: {{$billpos['betrag']}}€</p>
				<p>Abrechner: {{$billpos['abrechnerVor']}} {{$billpos['abrechnerNach']}}</p>
				<form method="post">
					<input type="button" class="btn btn-primary pay" value="Bezahlen" name="{{$billpos['rechnungsposid']}}">
				</form>
			</div>
			@endif
		@endforeach
	</div>
	@endforeach
</div>
@endsection
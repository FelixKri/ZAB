@extends('layouts.master')

@push('scripts')
    
@endpush

@section('headers')

@endsection

@section('content')
<div class="container">
	@include('layouts.navbar')
	<form method="post">
	    <p><h1>Bezeichnung: <input type="text" class="form-control-lg text-dark" value="{{$rechnung->grund->name}}" placeholder="{{$rechnung->grund->name}}"/></h1></p>
	    <h3>Abrechner: {{$rechnung->abrechner->vorName}} {{$rechnung->abrechner->nachName}}</h3>

	    @foreach($rechnungsposes as $rechnungspos)
			<div class="jumbotron text-dark">
		   		<input type="text" class="form-control form-control-lg" value="{{$rechnungspos->bezeichnung}}" placeholder="{{$rechnungspos->bezeichnung}}"/>
		   		<table class="table">
		   			@foreach($rechnungspos->user_has_rechnungspos as $user_has_rechnungspos)
		   			<tr>
		   				<td><h4>{{$user_has_rechnungspos->user->vorName}} {{$user_has_rechnungspos->user->nachName}}</h4></td>
		   				<td><input type="number" class="form-control" value="{{$user_has_rechnungspos->betrag}}" placeholder="{{$user_has_rechnungspos->betrag}}"/></td>
		   				<td><input type="button" class="btn btn-primary" value="Entfernen"/></td>
		   			</tr>
		   			@endforeach
		   			<tr><td><input type="text" class="form-control" placeholder="Name" /></td>
		   				<td><input type="number" class="form-control" placeholder="Betrag" /></td>
		   				<td><input type="button" class="btn btn-primary" value="Schüler hinzufügen"/></td></tr>
		   		</table>

		   	</div>
	    @endforeach
	    <p><input type="button" class="btn btn-primary" value="Rechnungsposition hinzufügen"/>
	   	<input type="submit" align="center" value="Speichern" class="btn btn-success"/></p>
   </form>
</div>
@endsection
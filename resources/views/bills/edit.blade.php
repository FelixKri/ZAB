@extends('layouts.master')

@push('scripts')
    
@endpush

@section('headers')

@endsection

@section('content')
<div class="container">
	@include('layouts.navbar')
	<form method="post">
	    <h1>Rechnungsname / Grund</h1>
	    <h3>Abrechner: Abrechnername</h3>
	   	<div class="jumbotron">
	   		<h2>Rechnungsposname</h2>
	   		<table align="center">
	   			<tr>
	   				<td>Timon Griesfelder</td>
	   				<td><input type="number" value="230" class="form-control form-control-sn"/></td>
	   			</tr>
	   		</table>
	   	</div>
	   	<div class="jumbotron">
	   		<h2>Rechnungsposname 2</h2>
			<table align="center">
	   			<tr>
	   				<td>Hans Peter</td>
	   				<td><input type="number" value="300" class="form-control form-control-sn"/></td>
	   			</tr>
	   			<tr>
	   				<td>Rudi Rüssel</td>
	   				<td><input type="number" value="400" class="form-control form-control-sn"/></td>
	   			</tr>
	   		</table>
	   	</div>
	   	<input type="submit" value="Speichern" class="btn btn-primary" />
   </form>
</div>
@endsection
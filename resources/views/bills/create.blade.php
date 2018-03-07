@extends('layouts.master')
@push('scripts')
    <!--<script type="text/javascript" src="{{ URL::asset('js/sendrequest.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/createbill.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/distributeAmount.js') }}"></script> -->
    <script src="{{ mix('js/app.js') }}"></script>
@endpush
@section('content')
    <!-- MASSIVES TODO: Das hier verschönern, eigentlich benutzbar machen ohne das ich mich selber damit verwirre -->
    <form action="/bill/new" method="post">
        {{csrf_field()}}
        @foreach($klassen as $klasse)
            <div class="inline-wrapper">
                <input type="checkbox" name="{{$klasse->name}}"
                       value="{{$klasse->name}}"> {{$klasse->name}}<br>
            </div>
        @endforeach
        <br>
        <input type="button" value="Klassen hinzufügen" class="btn btn-primary classes">
    </form>
    <studentlist></studentlist>
    <form action="/bill/fill" method="post" id="billform">
        {{csrf_field()}}
        <div class="form-group">
            <input type="button" value="Rechnungsposition hinzufügen" class="btn btn-success"
                   onclick="add_fields();" id="rechnungspos_val">
            <hr>
            <div id="wrapper">
                <table id="schueler">
                    <tr>
                        <td>
                            <input type="text" id="text" name="text" placeholder="Zahlungsgrund"
                                   class="form-control">
                        </td>
                    </tr>


                </table>
                <!-- Hier kommen Rechnungspositionen hin (Javascript) -->
            </div>
        </div>
        <div class="form-group">
            <input type="submit" value="Rechnung Speichern" class="btn btn-primary savebill">
        </div>
    </form>
    </div>
@endsection
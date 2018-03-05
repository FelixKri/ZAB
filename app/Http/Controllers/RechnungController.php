<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Klasse;
use App\User;
class RechnungController extends Controller
{
    public function create(){
        if(Auth::user()->canWrite == true){
            $user = Auth::user();
            $klassen = Klasse::all();
            $data = null;
            return view('bills.create', compact('user','klassen', 'data'));
        }
        else{
            return redirect('/');
        }
    }
    public function fill(){
        //dd(request()->all());
        $user = Auth::user();
        //Klassennamen aus dem request extrahieren
        $klassen_arr = explode("|", request()->classes);
        //id's der ausgewählten klassen filtern;
        $ids = Klasse::whereIn('name',$klassen_arr)->pluck('id');

        //schüler suchen welche den gefilterten Klassen angehören
        $schueler = User::whereIn('klasse_id', $ids)->get();

        return response()->json([
            //request()->all(),
            "schueler" => $schueler,
        ]);
        //return view('bills.fill',compact('user','schueler', 'klassen_arr'));
    }
    public function store(){
        dd(request()->all());
        //validieren

        //speichern

        //weiterleiten
    }
}

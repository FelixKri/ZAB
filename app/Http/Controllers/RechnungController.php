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
            return view('bills.create', compact('user','klassen'));
        }
        else{
            return redirect('/');
        }
    }
    public function fill(){
        $user = Auth::user();
        //Klassennamen aus dem request extrahieren
        $klassen_arr = Array();
        foreach(request()->all() as $request){
            array_push($klassen_arr, $request);
        }
        array_shift($klassen_arr);
        //id's der ausgewählten klassen filtern;
        $ids = Klasse::whereIn('name',$klassen_arr)->pluck('id');

        //schüler suchen welche den gefilterten Klassen angehören
        $schueler = User::whereIn('klasse_id', $ids)->get();

        return view('bills.fill',compact('user','schueler', 'klassen_arr'));
    }
    public function store(){
        dd(request()->all());
        //validieren

        //speichern

        //weiterleiten
    }
}

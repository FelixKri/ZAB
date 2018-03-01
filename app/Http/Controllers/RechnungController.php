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

        //Klassennamen aus dem request extrahieren
        $klassen_arr = Array();
        foreach(request()->all() as $request){
            array_push($klassen_arr, $request);
        }
        array_shift($klassen_arr);
        //id's der ausgewählten klassen filtern
        //dd($klassen_arr);
        $ids = Klasse::where('name',$klassen_arr)->pluck('id');
        dd($ids);


        $klassen = Klasse::all();
        //schüler suchen welche den gefilterten Klassen angehören
        $schueler = User::where('klasse_id', "1,0")->get();

        dd($schueler);
    }
}

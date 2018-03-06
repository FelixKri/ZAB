<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Klasse;
use App\User;
use App\user_has_rechnungspos;
use App\Rechnungspos;
use App\Rechnung;

class RechnungController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $rechnungskopf = Array();
        $grund = request()->text;

        //validieren

        //speichern

        //weiterleiten
    }

    public function show(){
        $user = Auth::user();

        $matchThese = ['user_id' => Auth::user()->id, 'bezahlt' => false];
        $user_has_rechnungspos = user_has_rechnungspos::where($matchThese)->get();
        //dd($user_has_rechnungspos);

        $bills = array();

        for($i = 0;$i < count($user_has_rechnungspos);$i++)
        {
            //Get rechnungspos
            $rechnungspos = Rechnungspos::where('id', $user_has_rechnungspos[$i]->rechnungspos_id)->first();
            //Get rechnung
            if(isset($rechnungspos))
            {
                $rechnung = Rechnung::where('id', $rechnungspos->rechnungs_id)->first();
                //Get abrechner
                $abrechner = User::where('id', $rechnung->abrechner_id)->first();
                //Fill bills
                $bills[$i]["name"] = $rechnungspos->bezeichnung;
                $bills[$i]["betrag"] = $user_has_rechnungspos[$i]->betrag;
                $bills[$i]["abrechnerVor"] = $abrechner->vorName;
                $bills[$i]["abrechnerNach"] = $abrechner->nachName;
                $bills[$i]["rechnunugsposid"] = $rechnungspos->id;
                $bills[$i]["userid"] = $user->id;
            }
        }
        //dd($user, $user_has_rechnungspos, $rechnungsposes);
        //dd($rechnungsposes, $user_has_rechnungspos);
        //dd($bills);
        return view('site/show', compact('user', 'bills'));
    }

    public function pay()
    {
        $match = ['user_id' => request()->userid, 'rechnungspos_id' => request()->rechnungsposid];
        user_has_rechnungspos::where($match)->update('bezahlt', true);

        return response()->json([
            //"r" => $rechnungsposid
        ]);
    }

    public function showArchive()
    {
        $user = Auth::user();

        $matchThese = ['user_id' => Auth::user()->id, 'bezahlt' => true];
        $user_has_rechnungspos = user_has_rechnungspos::where($matchThese)->get();
        //dd($user_has_rechnungspos);

        $bills = array();

        for($i = 0;$i < count($user_has_rechnungspos);$i++)
        {
            //Get rechnungspos
            $rechnungspos = Rechnungspos::where('id', $user_has_rechnungspos[$i]->rechnungspos_id)->first();
            //Get rechnung
            if(isset($rechnungspos))
            {
                $rechnung = Rechnung::where('id', $rechnungspos->rechnungs_id)->first();
                //Get abrechner
                $abrechner = User::where('id', $rechnung->abrechner_id)->first();
                //Fill bills
                $bills[$i]["name"] = $rechnungspos->bezeichnung;
                $bills[$i]["betrag"] = $user_has_rechnungspos[$i]->betrag;
                $bills[$i]["abrechnerVor"] = $abrechner->vorName;
                $bills[$i]["abrechnerNach"] = $abrechner->nachName;
            }
        }
        //dd($user, $user_has_rechnungspos, $rechnungsposes);
        //dd($rechnungsposes, $user_has_rechnungspos);
        //dd($bills);
        return view('site/showArchive', compact('user', 'bills'));
    }
}

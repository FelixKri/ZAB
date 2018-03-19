<?php

namespace App\Http\Controllers;

use App\Klasse;
use App\Rechnung;
use App\Rechnungspos;
use App\User;
use App\user_has_rechnungspos;
use Illuminate\Support\Facades\Auth;

class RechnungController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        if (Auth::user()->canWrite == true) {
            $user = Auth::user();
            $klassen = Klasse::all();
            return view('bills.create', compact('user', 'klassen'));
        } else {
            return redirect('/');
        }
    }

    public function fill()
    {
        //dd(request()->all());
        $user = Auth::user();
        //Klassennamen aus dem request extrahieren
        $klassen_arr = explode("|", request()->classes);
        //id's der ausgewählten klassen filtern;
        $ids = Klasse::whereIn('name', $klassen_arr)->pluck('id');

        //schüler suchen welche den gefilterten Klassen angehören
        $schueler = User::whereIn('klasse_id', $ids)->get();

        return response()->json([
            //request()->all(),
            "schueler" => $schueler,
        ]);
        //return view('bills.fill',compact('user','schueler', 'klassen_arr'));
    }

    public function store()
    {
        $rechnung = new Rechnung;
        $rechnung->reason = "Ausflug";
        $rechnung->abrechner_id = Auth::user()->id;
        $rechnung->save();

        foreach(request()->rechnungspositionen as $rechnungsposdata){
            $rechnungsposition = new Rechnungspos();
            $rechnungsposition->bezeichnung = $rechnungsposdata[0];
            $rechnungsposition->gesamtbetrag = 1000;
            $rechnungsposition->rechnungs_id = $rechnung->id;
            $rechnungsposition->bezahlt = false;
            $rechnungsposition->save();
            $j = 0;
            foreach($rechnungsposdata[2] as $user_ids) {
                $user_has_rechnungspos = new user_has_rechnungspos();
                $user_has_rechnungspos->user_id = (int)$user_ids;
                $user_has_rechnungspos->rechnungspos_id = $rechnungsposition->id;
                $user_has_rechnungspos->bezahlt = false;
                $user_has_rechnungspos->betrag = $rechnungsposdata[1][$j];
                $user_has_rechnungspos->save();
                $j++;
            }
        }
        return response()->json([
            "success" => "oida es geht"
        ]);

    }

    public function show()
    {
        $user = Auth::user();

        $matchThese = ['user_id' => Auth::user()->id, 'bezahlt' => false];
        $user_has_rechnungspos = user_has_rechnungspos::where($matchThese)->get();
        //dd($user_has_rechnungspos);

        $bills = array();

        for ($i = 0; $i < count($user_has_rechnungspos); $i++) {
            //Get rechnungspos
            $rechnungspos = Rechnungspos::where('id', $user_has_rechnungspos[$i]->rechnungspos_id)->first();
            //Get rechnung
            if (isset($rechnungspos)) {
                $rechnung = Rechnung::where('id', $rechnungspos->rechnungs_id)->first();
                //Get abrechner
                $abrechner = User::where('id', $rechnung->abrechner_id)->first();
                //Fill bills
                $bills[$i]["name"] = $rechnungspos->bezeichnung;
                $bills[$i]["betrag"] = $user_has_rechnungspos[$i]->betrag;
                $bills[$i]["abrechnerVor"] = $abrechner->vorName;
                $bills[$i]["abrechnerNach"] = $abrechner->nachName;
                $bills[$i]["rechnungsposid"] = $rechnungspos->id;
            }
        }

        return view('site/show', compact('user', 'bills'));
    }

    public function pay()
    {
        $match = ['user_id' => Auth::user()->id, 'rechnungspos_id' => request()->rechnungsposid];
        user_has_rechnungspos::where($match)
            ->update(['bezahlt' => true]);

        return response()->json([
            "rechnungsposid" => request()->rechnungsposid
        ]);
    }

    public function showArchive()
    {
        $user = Auth::user();

        $matchThese = ['user_id' => Auth::user()->id, 'bezahlt' => true];
        $user_has_rechnungspos = user_has_rechnungspos::where($matchThese)->get();
        //dd($user_has_rechnungspos);

        $bills = array();

        for ($i = 0; $i < count($user_has_rechnungspos); $i++) {
            //Get rechnungspos
            $rechnungspos = Rechnungspos::where('id', $user_has_rechnungspos[$i]->rechnungspos_id)->first();
            //Get rechnung
            if (isset($rechnungspos)) {
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

    public function edit()
    {
        $user = Auth::user();
        return view('bills/edit', compact('user'));
    }
}

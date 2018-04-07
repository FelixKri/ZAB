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
        $user = Auth::user();

        $klassen_arr = explode("|", request()->classes);

        $ids = Klasse::whereIn('name', $klassen_arr)->pluck('id');

        $schueler = User::whereIn('klasse_id', $ids)->get();

        $schuelerdata = array();

        for ($i = 0; $i < count($schueler); $i++) {

            $schuelerdata[$i]['vorName'] = $schueler[$i]->vorName;
            $schuelerdata[$i]['nachName'] = $schueler[$i]->nachName;
            $schuelerdata[$i]['klasse'] = $schueler[$i]->klasse->name;
            $schuelerdata[$i]['id'] = $schueler[$i]->id;

        }

        return response()->json([

            "schueler" => $schuelerdata,

        ]);

    }

    public function store()
    {
        $rechnung = new Rechnung;
        $rechnung->reason = "Ausflug";
        $rechnung->abrechner_id = Auth::user()->id;
        $rechnung->save();

        foreach (request()->rechnungspositionen as $rechnungsposdata) {
            $rechnungsposition = new Rechnungspos();
            $rechnungsposition->bezeichnung = $rechnungsposdata[0];
            $rechnungsposition->gesamtbetrag = 1000;
            $rechnungsposition->rechnungs_id = $rechnung->id;
            $rechnungsposition->bezahlt = false;
            $rechnungsposition->save();
            $j = 0;
            foreach ($rechnungsposdata[2] as $user_ids) {
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

        $bills = array();

        for ($i = 0; $i < count($user_has_rechnungspos); $i++) {

            $rechnungspos = $user_has_rechnungspos[$i]->rechnungspos;
            $rechnung = $rechnungspos->rechnung;
            $abrechner = $rechnung->abrechner;
            $rechnungsid = $rechnung->id;

            if (isset($bills[$rechnungsid]))
                $count = count($bills[$rechnungsid]) + 1;
            else
                $count = 1;

            $bills[$rechnungsid][0] = $rechnung->reason;
            $bills[$rechnungsid][$count]["name"] = $rechnungspos->bezeichnung;
            $bills[$rechnungsid][$count]["betrag"] = $user_has_rechnungspos[$i]->betrag;
            $bills[$rechnungsid][$count]["abrechnerVor"] = $abrechner->vorName;
            $bills[$rechnungsid][$count]["abrechnerNach"] = $abrechner->nachName;
            $bills[$rechnungsid][$count]["rechnungsposid"] = $rechnungspos->id;

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

        $bills = array();

        for ($i = 0; $i < count($user_has_rechnungspos); $i++) {

            $rechnungspos = $user_has_rechnungspos[$i]->rechnungspos;
            $rechnung = $rechnungspos->rechnung;

            $abrechner = $rechnung->abrechner;

            $bills[$i]["name"] = $rechnungspos->bezeichnung;
            $bills[$i]["betrag"] = $user_has_rechnungspos[$i]->betrag;
            $bills[$i]["abrechnerVor"] = $abrechner->vorName;
            $bills[$i]["abrechnerNach"] = $abrechner->nachName;

        }

        return view('site/showArchive', compact('user', 'bills'));

    }

    public function edit()
    {

        $user = Auth::user();
        return view('bills/edit', compact('user'));

    }

    public function autocomplete()
    {
        $term = request()->term;
        $user = User::where('nachName', 'LIKE', '%' . $term . '%')->get();

        if (count($user) == 0) {
            $searchResult = ["Keine Treffer"];
            return $searchResult;
        } else {
            foreach ($user as $key => $value) {
                $searchResult[] = $value->id . " | " . $value->vorName . " " . $value->nachName . " | " . $value->klasse->name;
            }
        }
        return $searchResult;
    }

    public function addStudent()
    {
        dd(request()->all());
    }
}

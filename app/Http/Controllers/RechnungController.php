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
        $this->validate(request(), [

            'rechnungsgrund' => 'required|max:200',
            'rechnungspositionen' => 'required|array',
            'rechnungspositionen.*' => 'required|distinct',
            'rechnungspositionen.*.*' => 'required',
            'rechnungspositionen.*.0' => 'required|distinct',
            'rechnungspositionen.*.1' => 'required|array|',
            'rechnungspositionen.*.1.*' => 'required|numeric',
            'rechnungspositionen.*.2' => 'required|array|',
            'rechnungspositionen.*.2.*' => 'required|numeric',

        ]);

        //dd(request()->all());
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
            foreach ($rechnungsposdata[2] as $user_id) {
                $user_has_rechnungspos = new user_has_rechnungspos();
                $user_has_rechnungspos->user_id = (int)$user_id;
                $user_has_rechnungspos->rechnungspos_id = $rechnungsposition->id;
                $user_has_rechnungspos->bezahlt = false;
                $user_has_rechnungspos->betrag = $rechnungsposdata[1][$j];
                $user_has_rechnungspos->save();
                $j++;
            }
        }
        return response()->json([
            "success" => "Bill stored"
        ]);

    }

    public function show()
    {
        $user = Auth::user();

        $matchThese = ['user_id' => Auth::user()->id, 'bezahlt' => false];
        $user_has_rechnungspos = user_has_rechnungspos::where($matchThese)->get();

        $bills = array();

        for ($i = count($user_has_rechnungspos) - 1;$i >= 0; $i--) {

            $rechnungspos = $user_has_rechnungspos[$i]->rechnungspos;
            $rechnung = $rechnungspos->rechnung;
            $abrechner = $rechnung->abrechner;
            $rechnungsid = $rechnung->id;


            if(isset($bills[$rechnungsid]))
                $count = count($bills[$rechnungsid]) + 4;

            else
                $count = 4;

            $bills[$rechnungsid][0] = $rechnung->id;
            $bills[$rechnungsid][1] = $rechnung->reason;
            $bills[$rechnungsid][2] = $abrechner->vorName;
            $bills[$rechnungsid][3] = $abrechner->nachName;
            $bills[$rechnungsid][$count]["name"] = $rechnungspos->bezeichnung;
            $bills[$rechnungsid][$count]["betrag"] = $user_has_rechnungspos[$i]->betrag;
            $bills[$rechnungsid][$count]["rechnungsposid"] = $rechnungspos->id;

        }

        return view('site/show', compact('user', 'bills'));
    }

    public function pay()
    {
        $match = ['user_id' => Auth::user()->id, 'rechnungspos_id' => request()->rechnungsposid];
        $user_has_rechnungspos = user_has_rechnungspos::where($match)->first();
        $user_has_rechnungspos->update(['bezahlt' => true]);

        $gesuchtrechnungsid = $user_has_rechnungspos->rechnungspos->rechnung->id;
        $user_has_rechnungspos = Auth::user()->has_rechnungspos->where("bezahlt", false);

        foreach($user_has_rechnungspos as $user_has_pos)
        {
            $rechnungsid = $user_has_pos->rechnungspos->rechnung->id;

            if($rechnungsid == $gesuchtrechnungsid)
            {
                return response()->json([
                    "rechnungsposid" => request()->rechnungsposid
                ]);
            }
        }

        return response()->json([
            "rechnungsposid" => request()->rechnungsposid,
            "rechnungsid" => $gesuchtrechnungsid
        ]);
    }

    public function showArchive()
    {
        $user = Auth::user();

        $matchThese = ['user_id' => Auth::user()->id, 'bezahlt' => true];
        $user_has_rechnungspos = user_has_rechnungspos::where($matchThese)->get();

        $bills = array();

        for ($i = count($user_has_rechnungspos) - 1;$i >= 0; $i--) {

            $rechnungspos = $user_has_rechnungspos[$i]->rechnungspos;
            $rechnung = $rechnungspos->rechnung;
            $abrechner = $rechnung->abrechner;
            $rechnungsid = $rechnung->id;


            if(isset($bills[$rechnungsid]))
                $count = count($bills[$rechnungsid]) + 4;

            else
                $count = 4;

            $bills[$rechnungsid][0] = $rechnung->id;
            $bills[$rechnungsid][1] = $rechnung->reason;
            $bills[$rechnungsid][2] = $abrechner->vorName;
            $bills[$rechnungsid][3] = $abrechner->nachName;
            $bills[$rechnungsid][$count]["name"] = $rechnungspos->bezeichnung;
            $bills[$rechnungsid][$count]["betrag"] = $user_has_rechnungspos[$i]->betrag;
            $bills[$rechnungsid][$count]["rechnungsposid"] = $rechnungspos->id;

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
        $user = User::where('nachName', 'LIKE', '%' . $term . '%')
            ->orWhere('vorName', 'LIKE', '%' . $term . '%')
            ->orWhere('id', 'LIKE', '%' . $term . '%')->get();

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

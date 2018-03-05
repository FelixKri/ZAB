<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\user_has_rechnungspos;
use App\Rechnungspos;
use App\User;
use App\Rechnung;

class SiteController extends Controller
{
    public function show(){
        $user = Auth::user();

        $user_has_rechnungspos = user_has_rechnungspos::where('user_id',Auth::user()->id)->get();
        //dd($user_has_rechnungspos);

        $openBill = array();

        for($i = 0;$i < count($user_has_rechnungspos);$i++)
        {
        	//Get rechnungspos
        	$matchThese = ['id' => $user_has_rechnungspos[$i]->rechnungspos_id, 'bezahlt' => false];
        	$rechnungspos = Rechnungspos::where($matchThese)->first();
        	//Get rechnung
        	$rechnung = Rechnung::where('id', $rechnungspos->rechnungs_id)->first();
        	//Get abrechner
        	$abrechner = User::where('id', $rechnung->abrechner_id)->first();
        	//Fill openBill
        	$openBill[$i]["name"] = $rechnungspos->bezeichnung;
        	$openBill[$i]["betrag"] = $user_has_rechnungspos[$i]->betrag;
        	$openBill[$i]["abrechnerVor"] = $abrechner->vorName;
        	$openBill[$i]["abrechnerNach"] = $abrechner->nachName;
		}
        //dd($user, $user_has_rechnungspos, $rechnungsposes);
        //dd($rechnungsposes, $user_has_rechnungspos);
        //dd($openBill);
        return view('site/show', compact('user', 'openBill'));
    }
}

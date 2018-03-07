<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function create()
    {
    	$user = Auth::user();
    	return view('Adminpanel/adminPanel', compact('user'));
    }

}


?>
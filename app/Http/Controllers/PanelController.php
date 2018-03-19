<?php

namespace App\Http\Controllers;

use App\Rechnung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class PanelController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
        $this->middleware('auth');
    }

    public function create()
    {
    	$user = Auth::user();
    	$bills = Rechnung::all();
    	$members = User::where('isAdmin', true)->get();
    	$students = User::all(); //TODO: WHERE(isStudent, true);
    	return view('Adminpanel/adminPanel', compact('user', 'bills', 'members', 'students'));
    }

}


?>
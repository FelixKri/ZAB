<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function show(){
        $user = Auth::user();

        return view('site/show', compact('user'));
    }
}

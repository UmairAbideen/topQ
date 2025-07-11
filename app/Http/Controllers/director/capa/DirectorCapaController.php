<?php

namespace App\Http\Controllers\director\capa;

use App\Models\CAPA;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DirectorCapaController extends Controller
{
    public function view()
    {
        $capa = CAPA::get();
        $username = Auth::user()->username;

        return view('director.capa.view', ['capas' => $capa, 'username' => $username]);
    }


    public function verify($id)
    {
        $capa = CAPA::find($id);

        $capa->verifier_name = Auth::user()->username;
        $capa->verifier_department = Auth::user()->department;
        $capa->verifier_designation = Auth::user()->designation;
        $capa->verifier_signtime = now();

        $capa->save();
        return back()->with('status', 'CAPA Form is sent to QA for Review.');
    }
}

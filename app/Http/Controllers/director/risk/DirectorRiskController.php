<?php

namespace App\Http\Controllers\director\risk;

use App\Models\Risk;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class DirectorRiskController extends Controller
{
    public function risk()
    {
        $risk = Risk::get();
        return view('director.risk.view', ['risks' => $risk]);
    }


    public function riskapprove($id)
    {
        $risk = Risk::find($id);

        $risk->approver_name = Auth::user()->username;
        $risk->approver_department = Auth::user()->department;
        $risk->approver_designation = Auth::user()->designation;
        $risk->approver_signtime = now();

        $risk->save();
        return back()->with('status', 'Risk Assessment has been approved and closed.');
    }
}

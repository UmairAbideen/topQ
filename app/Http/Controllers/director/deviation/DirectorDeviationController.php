<?php

namespace App\Http\Controllers\director\deviation;

use App\Models\Deviation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DirectorDeviationController extends Controller
{
    public function view()
    {
        $deviation = Deviation::get();

        $username = Auth::user()->username;

        return view('director.deviation.view', ['deviations' => $deviation, 'username' => $username]);
    }


    public function approve($id)
    {
        $deviation = Deviation::find($id);

        $deviation->approver_name = Auth::user()->username;
        $deviation->approver_department = Auth::user()->department;
        $deviation->approver_designation = Auth::user()->designation;
        $deviation->approver_signtime = now();

        $deviation->save();
        return back()->with('status', 'Deviation Initial Details has been approved.');
    }

    public function close($id)
    {
        $deviation = Deviation::find($id);

        $deviation->closer_name = Auth::user()->username;
        $deviation->closer_department = Auth::user()->department;
        $deviation->closer_designation = Auth::user()->designation;
        $deviation->closer_signtime = now();

        $deviation->save();
        return back()->with('status', 'Deviation Form has been closed.');
    }
}

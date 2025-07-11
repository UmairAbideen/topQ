<?php

namespace App\Http\Controllers\director\ccm;

use App\Models\CCM;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DirectorChangeController extends Controller
{
    public function changeview()
    {
        $change = CCM::get();

        $username = Auth::user()->username;
        return view('director.ccm.view', ['changes' => $change, 'username' => $username]);
    }

    public function changeapprove($id)
    {
        $change = CCM::find($id);

        $change->approver_name = Auth::user()->username;
        $change->approver_department = Auth::user()->department;
        $change->approver_designation = Auth::user()->designation;
        $change->approver_signtime = now();;

        $change->save();
        return back()->with('status', 'Change Request has been approved.');
    }

    public function changeclose($id)
    {
        $change = CCM::find($id);

        $change->closer_name = Auth::user()->username;
        $change->closer_department = Auth::user()->department;
        $change->closer_designation = Auth::user()->designation;
        $change->closer_signtime = now();;

        $change->save();
        return back()->with('status', 'Change Request has been closed.');
    }

}

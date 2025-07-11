<?php

namespace App\Http\Controllers\director\recall;

use App\Models\Recall;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DirectorRecallController extends Controller
{

    public function recallview()
    {
        $recall = Recall::get();
        return view('director.recall.information.view', ['recalls' => $recall]);
    }


     public function recallapprove($id)
    {
        $recall = Recall::find($id);

        $recall->approver_name = Auth::user()->username;
        $recall->approver_department = Auth::user()->department;
        $recall->approver_designation = Auth::user()->designation;
        $recall->approver_signtime = now();;

        $recall->save();
        return back()->with('status', 'Recall Form has been approved.');
    }

}

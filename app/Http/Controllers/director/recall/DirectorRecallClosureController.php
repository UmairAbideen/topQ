<?php

namespace App\Http\Controllers\director\recall;

use Illuminate\Http\Request;
use App\Models\RecallClosure;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DirectorRecallClosureController extends Controller
{
    public function closureview()
    {
        $closure = RecallClosure::get();
        return view('director.recall.closure.view', ['closures' => $closure]);
    }

    public function closureapprove($id)
    {
        $closure = RecallClosure::find($id);

        $closure->approver_name = Auth::user()->username;
        $closure->approver_department = Auth::user()->department;
        $closure->approver_designation = Auth::user()->designation;
        $closure->approver_signtime = now();

        $closure->save();
        return back()->with('status', 'Recall Closure Report has been approved.');
    }
}

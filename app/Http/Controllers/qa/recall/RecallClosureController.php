<?php

namespace App\Http\Controllers\qa\recall;

use Illuminate\Http\Request;
use App\Models\RecallClosure;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RecallClosureController extends Controller
{
    public function closureview()
    {
        $closure = RecallClosure::get();
        return view('qa.recall.closure.view', ['closures' => $closure]);
    }

    public function closureform()
    {
        return view('qa.recall.closure.add');
    }

    public function closurecreate(Request $request)
    {
        // Validate incoming request
        $request->validate([
            'product' => 'required|string|max:255',
            'recall_no' => 'required|string|max:100',
            'problem_detail' => 'required|string|max:500',
            'batch' => 'nullable|string|max:100',
            'serial' => 'nullable|string|max:100',
            'expiry' => 'required|date',
            'manufacturing_date' => 'required|date',
            'distributed_c' => 'required|integer|min:0',
            'recovered_c' => 'required|integer|min:0',
            'recovery_c' => 'required|integer|min:0',
            'distributed_s' => 'nullable|integer|min:0',
            'recovered_s' => 'nullable|integer|min:0',
            'recovery_s' => 'nullable|integer|min:0',
            'remarks' => 'nullable|string|max:1000',
            'decision' => 'required|string',
        ]);

        // Create a new recall closure record
        RecallClosure::create([
            'product' => $request->product,
            'recall_no' => $request->recall_no,
            'problem_detail' => $request->problem_detail,
            'batch' => $request->batch,
            'serial' => $request->serial,
            'expiry' => $request->expiry,
            'manufacturing_date' => $request->manufacturing_date,
            'distributed_c' => $request->distributed_c,
            'recovered_c' => $request->recovered_c,
            'recovery_c' => $request->recovery_c,
            'distributed_s' => $request->distributed_s,
            'recovered_s' => $request->recovered_s,
            'recovery_s' => $request->recovery_s,
            'remarks' => $request->remarks,
            'decision' => $request->decision,
            'created_at' => now(),
        ]);

        return back()->with('status', 'Recall Closure Report has been created.');
    }


    public function closurereview($id)
    {
        $closure = RecallClosure::find($id);

        $closure->reviewer_name = Auth::user()->username;
        $closure->reviewer_department = Auth::user()->department;
        $closure->reviewer_designation = Auth::user()->designation;
        $closure->reviewer_signtime = now();

        $closure->save();
        return back()->with('status', 'Recall Closure Report is sent to Director for approval.');
    }

    // public function closureapprove($id)
    // {
    //     $closure = RecallClosure::find($id);

    //     $closure->approver_name = Auth::user()->username;
    //     $closure->approver_department = Auth::user()->department;
    //     $closure->approver_designation = Auth::user()->designation;
    //     $closure->approver_signtime = now();

    //     $closure->save();
    //     return back()->with('status', 'Recall Closure Report has been approved.');
    // }

    public function closureedit($id)
    {
        $closure = RecallClosure::find($id);
        return view('qa.recall.closure.update', ['closure' => $closure]);
    }

    public function closureupdate(Request $request, $id)
    {
        $request->validate([
            'product' => 'required|string|max:255',
            'recall_no' => 'required|string|max:255',
            'problem_detail' => 'required|string|max:500',
            'batch' => 'nullable|string|max:100',
            'serial' => 'nullable|string|max:100',
            'expiry' => 'required|date|after_or_equal:today',
            'manufacturing_date' => 'required|date|before_or_equal:today',

            'distributed_c' => 'required|integer|min:0',
            'recovered_c' => 'required|integer|min:0',
            'recovery_c' => 'required|numeric|min:0|max:100',

            'distributed_s' => 'nullable|integer|min:0',
            'recovered_s' => 'nullable|integer|min:0',
            'recovery_s' => 'nullable|numeric|min:0|max:100',

            'remarks' => 'nullable|string|max:500',
            'decision' => 'required|string|max:255',
        ]);

        $closure = RecallClosure::where('id', $id)->first();

        $closure->recall_no = $request->recall_no;
        $closure->problem_detail = $request->problem_detail;
        $closure->batch = $request->batch;
        $closure->serial = $request->serial;
        $closure->expiry = $request->expiry;
        $closure->manufacturing_date = $request->manufacturing_date;

        $closure->distributed_c = $request->distributed_c;
        $closure->recovered_c = $request->recovered_c;
        $closure->recovery_c = $request->recovery_c;

        $closure->distributed_s = $request->distributed_s;
        $closure->recovered_s = $request->recovered_s;
        $closure->recovery_s = $request->recovery_s;

        $closure->remarks = $request->remarks;
        $closure->decision = $request->decision;

        $closure->updated_at = now(); // Corrected to assign the current time
        $closure->save();

        return back()->with('status', 'Recall Closure Report has been updated.');
    }

    public function closuredelete($id)
    {
        $closure = RecallClosure::find($id);
        $closure->delete();
        return back()->with('status', 'Recall Closure Report has been Deleted Successfully.');
    }
}

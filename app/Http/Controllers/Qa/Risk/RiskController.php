<?php

namespace App\Http\Controllers\Qa\Risk;

use App\Models\Risk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\RiskNotification;

class RiskController extends Controller
{
    public function risk()
    {
        $risk = Risk::get();
        return view('qa.risk.view', ['risks' => $risk]);
    }

    public function riskform()
    {
        return view('qa.risk.add');
    }

    public function create(Request $request)
    {
        // Automatically generate the next QRE number in the format 'QRE-001-24'
        $currentYear = now()->format('y'); // Get last two digits of the year (e.g., '24')
        $latestRisk = Risk::latest('id')->first(); // Get the latest Risk entry

        if ($latestRisk) {
            // Extract the incrementing number part from the latest QRE number and increment it
            $lastNumber = (int) substr($latestRisk->qre_no, 4, 3);
            $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            // If no risks exist, start at '001'
            $nextNumber = '001';
        }

        $qre_no = 'QRE-' . $nextNumber . '-' . $currentYear; // Format QRE number

        // Automatically set receipt_date as the current date and coordinator as the authenticated user's name
        $receipt_date = now()->toDateString();
        $coordinator = auth()->user()->username;
        $dep = auth()->user()->department;

        // Set department based on user's department code
        // $departments = [
        //     'INS' => 'Instrumentation',
        //     'TS' => 'Technical Service',
        //     'SC' => 'Supply Chain',
        //     'DE' => 'Dry Eye',
        //     'IOL' => 'Intraocular Lens'
        // ];

        // $department = $departments[$dep] ?? 'Unknown'; // Fallback to 'Unknown' if department doesn't match

        // Validation
        $request->validate([
            'area' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'existing_controls' => 'required|string|max:255',
            'severity_before' => 'required|numeric|min:1|max:5',
            'probablity_before' => 'required|numeric|min:1|max:5',
            'detectability_before' => 'required|numeric|min:1|max:3',
            'severity_after' => 'nullable|numeric|min:1|max:5',
            'probablity_after' => 'nullable|numeric|min:1|max:5',
            'detectability_after' => 'nullable|numeric|min:1|max:3',

            'action1' => 'required|string|max:255',
            'responsibility1' => 'required|string|max:255',
            'completion_date1' => 'required|date|max:255',

            'action2' => 'nullable|string|max:255',
            'responsibility2' => 'nullable|string|max:255',
            'completion_date2' => 'nullable|date|max:255',

            'action3' => 'nullable|string|max:255',
            'responsibility3' => 'nullable|string|max:255',
            'completion_date3' => 'nullable|date|max:255',

            'action4' => 'nullable|string|max:255',
            'responsibility4' => 'nullable|string|max:255',
            'completion_date4' => 'nullable|date|max:255',

            'action5' => 'nullable|string|max:255',
            'responsibility5' => 'nullable|string|max:255',
        ]);

        // Calculate RPN (Risk Priority Number) before mitigation
        $rpn_before = $request->severity_before * $request->probablity_before * $request->detectability_before;

        // Determine criticality based on the RPN value before mitigation
        if ($rpn_before > 0 && $rpn_before <= 25) {
            $criticality_before = 'Low';
        } elseif ($rpn_before > 25 && $rpn_before <= 50) {
            $criticality_before = 'Medium';
        } elseif ($rpn_before > 50 && $rpn_before <= 75) {
            $criticality_before = 'High';
        }

        // Calculate RPN (Risk Priority Number) after mitigation
        $rpn_after = $request->severity_after * $request->probablity_after * $request->detectability_after;


        // Determine criticality based on the RPN value after mitigation

        $criticality_after = '';

        if ($rpn_after > 0 && $rpn_after <= 25) {
            $criticality_after = 'Low';
        } elseif ($rpn_after > 25 && $rpn_after <= 50) {
            $criticality_after = 'Medium';
        } elseif ($rpn_after > 50 && $rpn_after <= 75) {
            $criticality_after = 'High';
        }

        $department = Auth::user()->department;

        // Create Risk record
        Risk::create([
            'qre_no' => $qre_no,
            'receipt_date' => $receipt_date,
            'department' => $dep,
            'area' => $request->area,
            'description' => $request->description,
            'existing_controls' => $request->existing_controls,
            'coordinator' => $coordinator,

            // Before mitigation
            'severity_before' => $request->severity_before,
            'probablity_before' => $request->probablity_before,
            'detectability_before' => $request->detectability_before,
            'rpn_before' => $rpn_before, // Store the calculated RPN before
            'criticality_before' => $criticality_before, // Store the calculated criticality before

            // Actions and responsibilities
            'action1' => $request->action1,
            'responsibility1' => $request->responsibility1,
            'completion_date1' => $request->completion_date1,

            'action2' => $request->action2,
            'responsibility2' => $request->responsibility2,
            'completion_date2' => $request->completion_date2,

            'action3' => $request->action3,
            'responsibility3' => $request->responsibility3,
            'completion_date3' => $request->completion_date3,

            'action4' => $request->action4,
            'responsibility4' => $request->responsibility4,
            'completion_date4' => $request->completion_date4,

            'action5' => $request->action5,
            'responsibility5' => $request->responsibility5,
            'completion_date5' => $request->completion_date5,

            // After mitigation
            'severity_after' => $request->severity_after,
            'probablity_after' => $request->probablity_after,
            'detectability_after' => $request->detectability_after,
            'rpn_after' => $rpn_after, // Store the calculated RPN after
            'criticality_after' => $criticality_after, // Store the calculated criticality after

            'created_at' => now(),
        ]);

        // Fetch the latest Risk and send notification
        $risk = Risk::latest('id')->first();
        // auth()->user()->notify(new RiskNotification($risk));

        // Redirect back with success message
        return back()->with('status', 'Risk Assessment has been created and sent for Manager Approval.');
    }


    // public function riskverify($id)
    // {
    //     $risk = Risk::find($id);

    //     $risk->verifier_name = Auth::user()->username;
    //     $risk->verifier_department = Auth::user()->department;
    //     $risk->verifier_designation = Auth::user()->designation;
    //     $risk->verifier_signtime = now();

    //     $risk->save();
    //     return back()->with('status', 'Risk Assessment is sent for QA Approval.');
    // }

    public function riskreview($id)
    {
        $risk = Risk::find($id);

        $risk->reviewer_name = Auth::user()->username;
        $risk->reviewer_department = Auth::user()->department;
        $risk->reviewer_designation = Auth::user()->designation;
        $risk->reviewer_signtime = now();

        $risk->save();
        return back()->with('status', 'Risk Assessment is sent for Director Approval.');
    }

    // public function riskapprove($id)
    // {
    //     $risk = Risk::find($id);

    //     $risk->approver_name = Auth::user()->username;
    //     $risk->approver_department = Auth::user()->department;
    //     $risk->approver_designation = Auth::user()->designation;
    //     $risk->approver_signtime = now();

    //     $risk->save();
    //     return back()->with('status', 'Risk Assessment has been approved and closed.');
    // }


    public function edit($id)
    {
        $risk = Risk::find($id);
        return view('qa.risk.update', ['risk' => $risk]);
    }

    public function update(Request $request, $id)
    {
        // Validation for the fields
        $request->validate([
            // 'qre_no' => 'required|string|max:255',
            'receipt_date' => 'required|date',
            'department' => 'required|string|max:255',

            'area' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'existing_controls' => 'required|string|max:255',
            'coordinator' => 'required|string|max:255',

            'severity_before' => 'required|numeric|min:1|max:5',
            'probablity_before' => 'required|numeric|min:1|max:5',
            'detectability_before' => 'required|numeric|min:1|max:3',
            // 'rpn_before' => 'required|numeric',
            // 'criticality_before' => 'required|string|max:255',

            'action1' => 'required|string|max:255',
            'responsibility1' => 'required|string|max:255',
            'completion_date1' => 'required|date',

            'action2' => 'nullable|string|max:255',
            'responsibility2' => 'nullable|string|max:255',
            'completion_date2' => 'nullable|date',

            'action3' => 'nullable|string|max:255',
            'responsibility3' => 'nullable|string|max:255',
            'completion_date3' => 'nullable|date',

            'action4' => 'nullable|string|max:255',
            'responsibility4' => 'nullable|string|max:255',
            'completion_date4' => 'nullable|date',

            'action5' => 'nullable|string|max:255',
            'responsibility5' => 'nullable|string|max:255',
            'completion_date5' => 'nullable|date',

            'severity_after' => 'nullable|numeric|min:1|max:5',
            'probablity_after' => 'nullable|numeric|min:1|max:5',
            'detectability_after' => 'nullable|numeric|min:1|max:3',
            // 'rpn_after' => 'nullable|numeric',
            // 'criticality_after' => 'nullable|string|max:255',

        ]);

        // Retrieve the risk by ID
        $risk = Risk::where('id', $id)->first();


        // Calculate RPN (Risk Priority Number) before mitigation
        $risk->rpn_before = $request->severity_before * $request->probablity_before * $request->detectability_before;

        // Determine criticality based on the RPN value before mitigation
        if ($risk->rpn_before > 0 && $risk->rpn_before <= 25) {
            $risk->criticality_before = 'Low';
        } elseif ($risk->rpn_before > 25 && $risk->rpn_before <= 50) {
            $risk->criticality_before = 'Medium';
        } elseif ($risk->rpn_before > 50 && $risk->rpn_before <= 75) {
            $risk->criticality_before = 'High';
        }

        // Calculate RPN (Risk Priority Number) after mitigation
        $risk->rpn_after = $request->severity_after * $request->probablity_after * $request->detectability_after;


        // Determine criticality based on the RPN value after mitigation

        $risk->criticality_after = '';

        if ($risk->rpn_after > 0 && $risk->rpn_after <= 25) {
            $risk->criticality_after = 'Low';
        } elseif ($risk->rpn_after > 25 && $risk->rpn_after <= 50) {
            $risk->criticality_after = 'Medium';
        } elseif ($risk->rpn_after > 50 && $risk->rpn_after <= 75) {
            $risk->criticality_after = 'High';
        }

        // Update fields
        // $risk->qre_no = $request->qre_no;
        $risk->receipt_date = $request->receipt_date;
        $risk->department = $request->department;

        $risk->area = $request->area;
        $risk->description = $request->description;
        $risk->existing_controls = $request->existing_controls;
        $risk->coordinator = $request->coordinator;

        // Before mitigation
        $risk->severity_before = $request->severity_before;
        $risk->probablity_before = $request->probablity_before;
        $risk->detectability_before = $request->detectability_before;
        // $risk->rpn_before = $request->rpn_before;
        // $risk->criticality_before = $request->criticality_before;

        // Actions and responsibilities
        $risk->action1 = $request->action1;
        $risk->responsibility1 = $request->responsibility1;
        $risk->completion_date1 = $request->completion_date1;

        $risk->action2 = $request->action2;
        $risk->responsibility2 = $request->responsibility2;
        $risk->completion_date2 = $request->completion_date2;

        $risk->action3 = $request->action3;
        $risk->responsibility3 = $request->responsibility3;
        $risk->completion_date3 = $request->completion_date3;

        $risk->action4 = $request->action4;
        $risk->responsibility4 = $request->responsibility4;
        $risk->completion_date4 = $request->completion_date4;

        $risk->action5 = $request->action5;
        $risk->responsibility5 = $request->responsibility5;
        $risk->completion_date5 = $request->completion_date5;

        // After mitigation
        $risk->severity_after = $request->severity_after;
        $risk->probablity_after = $request->probablity_after;
        $risk->detectability_after = $request->detectability_after;
        // $risk->rpn_after = $request->rpn_after;
        // $risk->criticality_after = $request->criticality_after;

        // Update the 'updated_at' timestamp
        $risk->updated_at = now();
        $risk->save();

        return back()->with('status', 'Risk Assessment Details Updated Successfully.');
    }


    public function delete($id)
    {
        $risk = Risk::find($id);
        $risk->delete();
        return back()->with('status', 'Risk Assessment has been removed.');
    }
}

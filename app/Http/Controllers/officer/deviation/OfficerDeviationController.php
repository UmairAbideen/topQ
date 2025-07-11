<?php

namespace App\Http\Controllers\officer\deviation;

use App\Models\Deviation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OfficerDeviationController extends Controller
{
    public function view()
    {
        $department = Auth::user()->department;

        $deviation = Deviation::where('initiator_department', $department)->get();
        $username = Auth::user()->username;

        return view('officer.deviation.view', ['deviations' => $deviation, 'username' => $username, 'department' => $department]);
    }

    public function form()
    {
        $department = Auth::user()->department;
        return view('officer.deviation.add', ['department' => $department]);
    }

    public function create(Request $request)
    {
        $request->validate([
            // Initial Assessment
            'subject' => 'required|string|max:255',
            'detail' => 'required|string',
            'status' => 'required|string|max:255',
            'statement' => 'required|string|max:255',
            'action' => 'required|string|max:255',
        ]);


        // Get the current year in two-digit format
        $currentYear = date('y');

        // Get the last record with the deviation_no
        $lastDeviation = Deviation::whereYear('created_at', date('Y'))->latest('id')->first();

        // Extract the sequential number and increment it, or start with 1 if no records found
        if ($lastDeviation) {
            // Get the sequential number part from the last deviation number
            $lastSequentialNumber = intval(substr($lastDeviation->deviation_no, 4, 3));
            $nextSequentialNumber = str_pad($lastSequentialNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $nextSequentialNumber = '001';
        }

        // Format the deviation number as DEV-XXX-YY
        $deviationNumber = 'DEV-' . $nextSequentialNumber . '-' . $currentYear;

        $name = Auth::user()->username;
        $department = Auth::user()->department;
        $designation = Auth::user()->designation;

        Deviation::create([

            // Initial Information
            'deviation_date' => now(),
            'deviation_no' => $deviationNumber,
            'initiator_name' => $name,
            'initiator_department' => $department,
            'initiator_designation' => $designation,

            // Initial Assessment
            'subject' => $request->input('subject'),
            'detail' => $request->input('detail'),
            'status' => $request->input('status'),
            'statement' => $request->input('statement'),
            'action' => $request->input('action'),
        ]);

        return back()->with('status', 'Deviation form has been created.');
    }


    public function edit($id)
    {
        $deviation = Deviation::find($id);
        $department = Auth::user()->department;
        return view('officer.deviation.update', ['deviation' => $deviation, 'department' => $department]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([

            // Initial Assessment
            'subject' => 'nullable|string|max:255',
            'detail' => 'nullable|string',
            'status' => 'nullable|string|max:255',
            'statement' => 'nullable|string|max:255',
            'action' => 'nullable|string|max:255',
        ]);


        $deviation = Deviation::where('id', $id)->first();

        $deviation->update([

            // Initial Assessment
            'subject' => $request->input('subject'),
            'detail' => $request->input('detail'),
            'status' => $request->input('status'),
            'statement' => $request->input('statement'),
            'action' => $request->input('action'),

            'updated_at' => now(),
        ]);

        return back()->with('status', 'Deviation Form has been updated.');
    }
}

<?php

namespace App\Http\Controllers\Qa\Deviation;

use App\Models\Deviation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DeviationController extends Controller
{
    public function view()
    {
        $deviation = Deviation::get();

        $username = Auth::user()->username;

        return view('qa.deviation.view', ['deviations' => $deviation, 'username' => $username]);
    }

    public function form()
    {
        return view('qa.deviation.add');
    }

    public function create(Request $request)
    {
        $request->validate([

            // Initial Information
            // 'deviation_date' => 'nullable|date',
            // 'deviation_no' => 'nullable|string|max:255',
            // 'initiator_name' => 'nullable|string|max:255',
            // 'initiator_department' => 'nullable|string|max:255',
            // 'initiator_designation' => 'nullable|string|max:255',

            // Initial Assessment
            'subject' => 'nullable|string|max:255',
            'detail' => 'nullable|string',
            'status' => 'nullable|string|max:255',
            'statement' => 'nullable|string|max:255',
            'action' => 'nullable|string|max:255',

            // Root Cause Analysis
            'root_causes' => 'nullable|string',
            'root_cause_remarks' => 'nullable|string|max:255',

            // Categorization
            'categorization' => 'nullable|string|max:255',

            // Review Committee
            'reviewer_name1' => 'nullable|string|max:255',
            'recommendation1' => 'nullable|string|max:255',

            'reviewer_name2' => 'nullable|string|max:255',
            'recommendation2' => 'nullable|string|max:255',

            'reviewer_name3' => 'nullable|string|max:255',
            'recommendation3' => 'nullable|string|max:255',

            // Impact Evaluation By Manager
            'device_effected' => 'nullable|string|max:255',
            'patient_effected' => 'nullable|string|max:255',
            'other_effected' => 'nullable|string|max:255',

            // Impact Evaluation By QA
            'required_recall' => 'nullable|string|max:255',
            'recall_no' => 'nullable|string|max:255',
            'required_capa' => 'nullable|string|max:255',
            'capa_no' => 'nullable|string|max:255',
            'required_ccm' => 'nullable|string|max:255',
            'ccm_no' => 'nullable|string|max:255',

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

            // Root Cause Analysis
            'root_causes' => $request->input('root_causes'),
            'root_cause_remarks' => $request->input('root_cause_remarks'),

            // Categorization
            'categorization' => $request->input('categorization'),

            // Review Committee
            'reviewer_name1' => $request->input('reviewer_name1'),
            'recommendation1' => $request->input('recommendation1'),

            'reviewer_name2' => $request->input('reviewer_name2'),
            'recommendation2' => $request->input('recommendation2'),

            'reviewer_name3' => $request->input('reviewer_name3'),
            'recommendation3' => $request->input('recommendation3'),

            // Impact Evaluation By Manager
            'device_effected' => $request->input('device_effected'),
            'patient_effected' => $request->input('patient_effected'),
            'other_effected' => $request->input('other_effected'),

            // Impact Evaluation By QA
            'required_recall' => $request->input('required_recall'),
            'recall_no' => $request->input('recall_no'),
            'required_capa' => $request->input('required_capa'),
            'capa_no' => $request->input('capa_no'),
            'required_ccm' => $request->input('required_ccm'),
            'ccm_no' => $request->input('ccm_no'),
        ]);

        return back()->with('status', 'Deviation form has been created.');
    }


    public function verify($id)
    {
        $deviation = Deviation::find($id);

        $deviation->verifier_name = Auth::user()->username;
        $deviation->verifier_department = Auth::user()->department;
        $deviation->verifier_designation = Auth::user()->designation;
        $deviation->verifier_signtime = now();

        $deviation->save();
        return back()->with('status', 'Deviation Form has been verified.');
    }


    public function review($id)
    {
        $deviation = Deviation::find($id);

        $deviation->reviewer_name = Auth::user()->username;
        $deviation->reviewer_department = Auth::user()->department;
        $deviation->reviewer_designation = Auth::user()->designation;
        $deviation->reviewer_signtime = now();

        $deviation->save();
        return back()->with('status', 'Deviation Initial Details is sent to Director for approval.');
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


    public function committeeReview($id)
    {
        $deviation = Deviation::find($id);

        // checking which reviewer_name column in the CCMS table matches the authenticated user
        for ($i = 1; $i <= 3; $i++) {

            // Dynamically build field names
            $name = 'reviewer_name' . $i;
            $department = 'reviewer_department' . $i;
            $designation = 'reviewer_designation' . $i;
            $signtime = 'reviewer_signtime' . $i;

            // Check if the authenticated user's username matches the reviewer_nameX field
            if ($deviation->$name == Auth::user()->username) {

                // Assign authenticated user's department, designation, and the current timestamp to the fields
                $deviation->$department = Auth::user()->department;
                $deviation->$designation = Auth::user()->designation;
                $deviation->$signtime = now();; // Save the current timestamp

                // Save the updated change record
                $deviation->save();

                // Exit the loop once the user details are assigned
                return back()->with('status', 'Change Request updated and saved.');
            }
        }
    }


    public function confirm($id)
    {
        $deviation = Deviation::find($id);

        $deviation->confirmer_name = Auth::user()->username;
        $deviation->confirmer_department = Auth::user()->department;
        $deviation->confirmer_designation = Auth::user()->designation;
        $deviation->confirmer_signtime = now();

        $deviation->save();
        return back()->with('status', 'Deviation Form has been closed.');
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


    public function edit($id)
    {
        $deviation = Deviation::find($id);
        return view('qa.deviation.update', ['deviation' => $deviation]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([

            // Initial Information
            'deviation_date' => 'nullable|date',
            'deviation_no' => 'nullable|string|max:255',
            'initiator_name' => 'nullable|string|max:255',
            'initiator_department' => 'nullable|string|max:255',
            'initiator_designation' => 'nullable|string|max:255',

            // Initial Assessment
            'subject' => 'nullable|string|max:255',
            'detail' => 'nullable|string',
            'status' => 'nullable|string|max:255',
            'statement' => 'nullable|string|max:255',
            'action' => 'nullable|string|max:255',

            // Root Cause Analysis
            'root_causes' => 'nullable|string',
            'root_cause_remarks' => 'nullable|string|max:255',

            // Categorization
            'categorization' => 'nullable|string|max:255',

            // Review Committee
            'reviewer_name1' => 'nullable|string|max:255',
            'recommendation1' => 'nullable|string|max:255',

            'reviewer_name2' => 'nullable|string|max:255',
            'recommendation2' => 'nullable|string|max:255',

            'reviewer_name3' => 'nullable|string|max:255',
            'recommendation3' => 'nullable|string|max:255',

            // Impact Evaluation By Manager
            'device_effected' => 'nullable|string|max:255',
            'patient_effected' => 'nullable|string|max:255',
            'other_effected' => 'nullable|string|max:255',

            // Impact Evaluation By QA
            'required_recall' => 'nullable|string|max:255',
            'recall_no' => 'nullable|string|max:255',
            'required_capa' => 'nullable|string|max:255',
            'capa_no' => 'nullable|string|max:255',
            'required_ccm' => 'nullable|string|max:255',
            'ccm_no' => 'nullable|string|max:255',

        ]);


        $deviation = Deviation::where('id', $id)->first();

        $deviation->update([

            // Initial Information
            'deviation_date' => $request->input('deviation_date'),
            'deviation_no' => $request->input('deviation_no'),
            'initiator_name' => $request->input('initiator_name'),
            'initiator_department' => $request->input('initiator_department'),
            'initiator_designation' => $request->input('initiator_designation'),

            // Initial Assessment
            'subject' => $request->input('subject'),
            'detail' => $request->input('detail'),
            'status' => $request->input('status'),
            'statement' => $request->input('statement'),
            'action' => $request->input('action'),

            // Root Cause Analysis
            'root_causes' => $request->input('root_causes'),
            'root_cause_remarks' => $request->input('root_cause_remarks'),

            // Categorization
            'categorization' => $request->input('categorization'),

            // Review Committee
            'reviewer_name1' => $request->input('reviewer_name1'),
            'recommendation1' => $request->input('recommendation1'),

            'reviewer_name2' => $request->input('reviewer_name2'),
            'recommendation2' => $request->input('recommendation2'),

            'reviewer_name3' => $request->input('reviewer_name3'),
            'recommendation3' => $request->input('recommendation3'),

            // Impact Evaluation By Manager
            'device_effected' => $request->input('device_effected'),
            'patient_effected' => $request->input('patient_effected'),
            'other_effected' => $request->input('other_effected'),

            // Impact Evaluation By QA
            'required_recall' => $request->input('required_recall'),
            'recall_no' => $request->input('recall_no'),
            'required_capa' => $request->input('required_capa'),
            'capa_no' => $request->input('capa_no'),
            'required_ccm' => $request->input('required_ccm'),
            'ccm_no' => $request->input('ccm_no'),

            'updated_at' => now(),
        ]);

        return back()->with('status', 'Deviation Form has been updated.');
    }

    public function delete($id)
    {
        $deviation = Deviation::find($id);
        $deviation->delete();
        return back()->with('status', 'Deviation Form has been Deleted.');
    }
}

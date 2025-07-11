<?php

namespace App\Http\Controllers\manager\deviation;

use App\Models\Deviation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ManagerDeviationController extends Controller
{
    public function view()
    {
        $department = Auth::user()->department;
        $username = Auth::user()->username;

        for ($i = 1; $i <= 3; $i++) {

            $deviation = Deviation::where('initiator_department', $department)
                ->orWhere('reviewer_name'.$i, $username)
                ->get();
        }

        return view('manager.deviation.view', ['deviations' => $deviation, 'username' => $username, 'department' => $department]);
    }

    public function form()
    {
        $department = Auth::user()->department;

        $deviation = Deviation::where('initiator_department', $department)->get();
        $username = Auth::user()->username;

        return view('manager.deviation.add', ['deviation' => $deviation, 'username' => $username, 'department' => $department]);
    }

    public function create(Request $request)
    {
        $request->validate([

            // Initial Assessment
            'subject' => 'nullable|string|max:255',
            'detail' => 'nullable|string',
            'status' => 'nullable|string|max:255',
            'statement' => 'nullable|string|max:255',
            'action' => 'nullable|string|max:255',

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


    public function verify($id)
    {
        $deviation = Deviation::find($id);

        if ($deviation->verifier_name = Auth::user()->username) {
            $deviation->verifier_department = Auth::user()->department;
            $deviation->verifier_designation = Auth::user()->designation;
            $deviation->verifier_signtime = now();

            $deviation->save();
            return back()->with('status', 'Deviation Form has been verified.');
        };
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



    public function edit($id)
    {
        $deviation = Deviation::find($id);
        $username = Auth::user()->username;

        return view('manager.deviation.update', ['deviation' => $deviation, 'username' => $username]);
    }


    public function update(Request $request, $id)
    {

        $deviation = Deviation::where('id', $id)->first();
        $username = Auth::user()->username;


        if (is_null($deviation->verifier_signtime)) {
            // ----------------- Initial Assessment Fields ----------------

            $request->validate([

                // Initial Assessment
                'subject' => 'nullable|string|max:255',
                'detail' => 'nullable|string',
                'status' => 'nullable|string|max:255',
                'statement' => 'nullable|string|max:255',
                'action' => 'nullable|string|max:255',

            ]);

            $deviation->update([

                // Initial Assessment
                'subject' => $request->input('subject'),
                'detail' => $request->input('detail'),
                'status' => $request->input('status'),
                'statement' => $request->input('statement'),
                'action' => $request->input('action'),

                'updated_at' => now(),
            ]);

            return back()->with('status', 'Deviaiton Form has been submitted.');
        } elseif (!is_null($deviation->verifier_signtime) && !is_null($deviation->approver_signtime)) {
            if (is_null($deviation->categorization)) {
                // --------------------- Root Cause Fields --------------------------

                $request->validate([
                    // Root Cause Analysis
                    'root_causes' => 'nullable|string',
                    'root_cause_remarks' => 'nullable|string|max:255',
                ]);

                $deviation->update([

                    // Root Cause Analysis
                    'root_causes' => $request->input('root_causes'),
                    'root_cause_remarks' => $request->input('root_cause_remarks'),

                    'updated_at' => now(),
                ]);

                return back()->with('status', 'Deviation Form has been updated.');
            } elseif (!is_null($deviation->categorization) && is_null($deviation->closer_signtime)) {
                if ($deviation->categorization === 'critical' || $deviation->categorization === 'major') {
                    if (
                        ($deviation->reviewer_name1 === $username && is_null($deviation->reviewer_signtime1)) ||
                        ($deviation->reviewer_name2 === $username && is_null($deviation->reviewer_signtime2)) ||
                        ($deviation->reviewer_name3 === $username && is_null($deviation->reviewer_signtime3))
                    ) {
                        // --------------------- Review Committee Recommendation --------------------------

                        for ($i = 1; $i <= 3; $i++) {

                            $reviewer_name_field = 'reviewer_name' . $i;
                            $recommendation_field = 'recommendation' . $i;

                            if ($deviation->$reviewer_name_field === $username) {

                                // Validate the dynamically generated fields
                                $request->validate([
                                    $reviewer_name_field => 'required|string|max:255',
                                    $recommendation_field => 'required|string|max:255',
                                ]);

                                // Update the deviation with the dynamic field names
                                $deviation->update([
                                    $reviewer_name_field => $request->input($reviewer_name_field),
                                    $recommendation_field => $request->input($recommendation_field),
                                    'updated_at' => now(),
                                ]);

                                return back()->with('status', 'Deviation Form has been updated.');
                            }
                        }
                    } elseif (
                        ($deviation->reviewer_name1 === $username && !is_null($deviation->reviewer_signtime1)) ||
                        ($deviation->reviewer_name2 === $username && !is_null($deviation->reviewer_signtime2)) ||
                        ($deviation->reviewer_name3 === $username && !is_null($deviation->reviewer_signtime3))
                    ) {
                        // ----------------- Impact Evaluation in case of Critical or Major --------------------------

                        $request->validate([
                            // Impact Evaluation By Manager
                            'device_effected' => 'nullable|string|max:255',
                            'patient_effected' => 'nullable|string|max:255',
                            'other_effected' => 'nullable|string|max:255',
                        ]);

                        $deviation->update([
                            // Impact Evaluation By Manager
                            'device_effected' => $request->input('device_effected'),
                            'patient_effected' => $request->input('patient_effected'),
                            'other_effected' => $request->input('other_effected'),

                            'updated_at' => now(),
                        ]);


                        return back()->with('status', 'Deviation Form has been updated.');
                    }
                } elseif ($deviation->categorization === 'minor' && is_null($deviation->closer_signtime)) {
                    // ---------------------- Impact Evaluation in case of Minor --------------------------

                    $request->validate([
                        // Impact Evaluation By Manager
                        'device_effected' => 'nullable|string|max:255',
                        'patient_effected' => 'nullable|string|max:255',
                        'other_effected' => 'nullable|string|max:255',
                    ]);

                    $deviation->update([
                        // Impact Evaluation By Manager
                        'device_effected' => $request->input('device_effected'),
                        'patient_effected' => $request->input('patient_effected'),
                        'other_effected' => $request->input('other_effected'),

                        'updated_at' => now(),
                    ]);

                    return back()->with('status', 'Deviation Form has been updated.');
                }
            }
        }


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
}

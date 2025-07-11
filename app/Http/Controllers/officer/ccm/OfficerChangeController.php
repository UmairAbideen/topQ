<?php

namespace App\Http\Controllers\officer\ccm;

use App\Models\CCM;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OfficerChangeController extends Controller
{
    public function changeview()
    {
        $username = Auth::user()->username;
        $department = Auth::user()->department;

        $change = CCM::where('department', $department)->get();

        return view('officer.ccm.view', [
            'changes' => $change,
            'username' => $username,
            'department' => $department,
        ]);
    }

    public function changeform()
    {
        $department = Auth::user()->department;
        return view('officer.ccm.add', [
            'department' => $department,
        ]);
    }

    public function changecreate(Request $request)
    {

        $department = Auth::user()->department;

        $year = date('y');

        // Get the latest request number for this year
        $lastRequest = CCM::whereYear('logging_date', now()->year)
            ->orderBy('id', 'desc')
            ->first();

        // Generate the new sequential number
        if ($lastRequest) {
            // Extract the sequential part from the last request number (e.g., from CCR-001-24)
            $lastNumber = intval(substr($lastRequest->request_no, 4, 3)); // Extract 001
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1; // Start with 1 if no previous records
        }

        // Format the number to ensure it's always 3 digits
        $formattedNumber = str_pad($newNumber, 3, '0', STR_PAD_LEFT); // E.g., 001, 002

        // Create the request number (e.g., CCR-001-24)
        $request_no = 'CCR-' . $formattedNumber . '-' . $year;



        $request->validate([
            'description' => 'required|string|max:1000',
            'justification' => 'required|string|max:1000',
            'area' => 'required|string|max:255',
            'impact' => 'required|string|max:255',

            'action1' => 'nullable|string|max:500',
            'action2' => 'nullable|string|max:500',
            'action3' => 'nullable|string|max:500',
            'priority' => 'required|string|max:50',
            'required_date' => 'required|date|after_or_equal:today',

            'effected_doc1' => 'nullable|string|max:255',
            'doc_no1' => 'nullable|string|max:255',
            'effected_doc2' => 'nullable|string|max:255',
            'doc_no2' => 'nullable|string|max:255',
            'effected_doc3' => 'nullable|string|max:255',
            'doc_no3' => 'nullable|string|max:255',

            // 'classification' => 'required|string|max:255',

            // 'reviewer_name1' => 'nullable|string|max:255',
            // 'designation1' => 'nullable|string|max:255',
            // 'recommendation1' => 'nullable|string|max:500',

            // 'reviewer_name2' => 'nullable|string|max:255',
            // 'designation2' => 'nullable|string|max:255',
            // 'recommendation2' => 'nullable|string|max:500',

            // 'reviewer_name3' => 'nullable|string|max:255',
            // 'designation3' => 'nullable|string|max:255',
            // 'recommendation3' => 'nullable|string|max:500',

            // 'task1' => 'required|string|max:500',
            // 'responsible1' => 'required|string|max:255',
            // 'completion_date1' => 'required|date|after_or_equal:today',

            // 'task2' => 'nullable|string|max:500',
            // 'responsible2' => 'nullable|string|max:255',
            // 'completion_date2' => 'nullable|date|after_or_equal:today',

            // 'task3' => 'nullable|string|max:500',
            // 'responsible3' => 'nullable|string|max:255',
            // 'completion_date3' => 'nullable|date|after_or_equal:today',

            // 'summary' => 'required|string|max:1000',
            // 'implementation_date' => 'nullable|date|after_or_equal:today',

            // 'final_assessment' => 'required|string|max:1000',
            // 'monitoring' => 'nullable|string|max:1000',
        ]);


        CCM::create([
            'request_no' => $request_no,
            'logging_date' => now(),
            'initiator' => Auth::user()->username,
            'department' => Auth::user()->department,
            'description' => $request->description,
            'justification' => $request->justification,
            'area' => $request->area,
            'impact' => $request->impact,

            'action1' => $request->action1,
            'action2' => $request->action2,
            'action3' => $request->action3,
            'priority' => $request->priority,
            'required_date' => $request->required_date,

            'effected_doc1' => $request->effected_doc1,
            'doc_no1' => $request->doc_no1,
            'effected_doc2' => $request->effected_doc2,
            'doc_no2' => $request->doc_no2,
            'effected_doc3' => $request->effected_doc3,
            'doc_no3' => $request->doc_no3,

            // 'classification' => $request->classification,

            // 'reviewer_name1' => $request->reviewer_name1,
            // 'recommendation1' => $request->recommendation1,

            // 'reviewer_name2' => $request->reviewer_name2,
            // 'recommendation2' => $request->recommendation2,

            // 'reviewer_name3' => $request->reviewer_name3,
            // 'recommendation3' => $request->recommendation3,

            // 'task1' => $request->task1,
            // 'responsible1' => $request->responsible1,
            // 'completion_date1' => $request->completion_date1,

            // 'task2' => $request->task2,
            // 'responsible2' => $request->responsible2,
            // 'completion_date2' => $request->completion_date2,

            // 'task3' => $request->task3,
            // 'responsible3' => $request->responsible3,
            // 'completion_date3' => $request->completion_date3,

            // 'summary' => $request->summary,
            // 'implementation_date' => $request->implementation_date,
            // 'final_assessment' => $request->final_assessment,
            // 'monitoring' => $request->monitoring,

            'created_at' => now(),
        ]);

        return back()->with('status', 'Change Request Form has been closed.');
    }


    public function changeinitiate($id)
    {
        $change = CCM::find($id);

        $change->initiator_name = Auth::user()->username;
        $change->initiator_department = Auth::user()->department;
        $change->initiator_designation = Auth::user()->designation;
        $change->initiator_signtime = now();

        $change->save();
        return back()->with('status', 'Change Request is sent to your manager for verification.');
    }

    public function changeedit($id)
    {
        $department = Auth::user()->department;

        $change = CCM::find($id);
        return view('officer.ccm.update', ['change' => $change,  'department' => $department]);
    }

    public function changeupdate(Request $request, $id)
    {
        // Find the existing change request by ID
        $change = CCM::where('id', $id)->first();


        if ((is_null($change->initiator_signtime)) ||
            (!is_null($change->initiator_signtime) && is_null($change->verifier_signtime))){

            $request->validate([
                'description' => 'nullable|string|max:1000',
                'justification' => 'nullable|string|max:1000',
                'area' => 'nullable|string|max:255',
                'impact' => 'nullable|string|max:255',

                'action1' => 'nullable|string|max:500',
                'action2' => 'nullable|string|max:500',
                'action3' => 'nullable|string|max:500',
                'priority' => 'nullable|string|max:50',
                'required_date' => 'nullable|date|after_or_equal:today',

                'effected_doc1' => 'nullable|string|max:255',
                'doc_no1' => 'nullable|string|max:255',
                'effected_doc2' => 'nullable|string|max:255',
                'doc_no2' => 'nullable|string|max:255',
                'effected_doc3' => 'nullable|string|max:255',
                'doc_no3' => 'nullable|string|max:255',
            ]);

            $change->description = $request->description;
            $change->justification = $request->justification;
            $change->area = $request->area;
            $change->impact = $request->impact;

            $change->action1 = $request->action1;
            $change->action2 = $request->action2;
            $change->action3 = $request->action3;
            $change->priority = $request->priority;
            $change->required_date = $request->required_date;

            $change->effected_doc1 = $request->effected_doc1;
            $change->doc_no1 = $request->doc_no1;
            $change->effected_doc2 = $request->effected_doc2;
            $change->doc_no2 = $request->doc_no2;
            $change->effected_doc3 = $request->effected_doc3;
            $change->doc_no3 = $request->doc_no3;

            $change->updated_at = now();
            $change->save();

            // Redirect back with a success message
            return back()->with('status', 'Change Request Details have been updated.');
        } elseif ((!is_null($change->initiator_signtime) &&
            !is_null($change->approver_signtime) &&
            is_null($change->final_assessment))) {

            $request->validate([
                'task1' => 'nullable|string|max:500',
                'responsible1' => 'nullable|string|max:255',
                'completion_date1' => 'nullable|date|after_or_equal:today',

                'task2' => 'nullable|string|max:500',
                'responsible2' => 'nullable|string|max:255',
                'completion_date2' => 'nullable|date|after_or_equal:today',

                'task3' => 'nullable|string|max:500',
                'responsible3' => 'nullable|string|max:255',
                'completion_date3' => 'nullable|date|after_or_equal:today',

                'summary' => 'nullable|string|max:1000',
                'implementation_date' => 'nullable|date|after_or_equal:today',

            ]);

            $change->task1 = $request->task1;
            $change->responsible1 = $request->responsible1;
            $change->completion_date1 = $request->completion_date1;

            $change->task2 = $request->task2;
            $change->responsible2 = $request->responsible2;
            $change->completion_date2 = $request->completion_date2;

            $change->task3 = $request->task3;
            $change->responsible3 = $request->responsible3;
            $change->completion_date3 = $request->completion_date3;

            $change->summary = $request->summary;
            $change->implementation_date = $request->implementation_date;


            $change->updated_at = now();
            $change->save();

            // Redirect back with a success message
            return back()->with('status', 'Change Request Details have been updated.');
        }
    }


    public function changedelete($id)
    {
        $change = CCM::find($id);
        $change->delete();
        return back()->with('status', 'Change Request has been Deleted Successfully.');
    }
}

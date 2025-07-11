<?php

namespace App\Http\Controllers\manager\ccm;

use App\Models\CCM;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ManagerChangeController extends Controller
{

    public function changeview()
    {
        // Get the logged-in user's department and username
        $userdepart = Auth::user()->department;
        $username = Auth::user()->username;

        // Query to check if the change belongs to the user's department
        // and if the username is in any of the reviewer fields
        $change = CCM::where('department', $userdepart)
            ->orwhere(function ($query) use ($username) {
                $query->where('reviewer_name1', $username)
                    ->orWhere('reviewer_name2', $username)
                    ->orWhere('reviewer_name3', $username);
            })
            ->get();

        // Return the view with the retrieved changes
        return view('manager.ccm.view', [
            'changes' => $change,
            'username' => $username,
            'userdepart' => $userdepart
        ]);
    }

    public function changeverify($id)
    {
        $change = CCM::find($id);
        $change->verifier_name = Auth::user()->username;
        $change->verifier_department = Auth::user()->department;
        $change->verifier_designation = Auth::user()->designation;
        $change->verifier_signtime = now();

        $change->save();
        return back()->with('status', 'Change Request is sent to QA for review.');
    }

    public function changereview($id)
    {
        $change = CCM::find($id);

        // checking which reviewer_name column in the CCMS table matches the authenticated user
        for ($i = 1; $i <= 3; $i++) {

            // Dynamically build field names
            $name = 'reviewer_name' . $i;
            $department = 'reviewer_department' . $i;
            $designation = 'reviewer_designation' . $i;
            $signtime = 'reviewer_signtime' . $i;

            // Check if the authenticated user's username matches the reviewer_nameX field
            if ($change->$name == Auth::user()->username) {

                // Assign authenticated user's department, designation, and the current timestamp to the fields
                $change->$department = Auth::user()->department;
                $change->$designation = Auth::user()->designation;
                $change->$signtime = now();; // Save the current timestamp

                // Save the updated change record
                $change->save();

                // Exit the loop once the user details are assigned
                return back()->with('status', 'Change Request updated and saved.');
            }
        }
    }

    public function changeedit($id)
    {
        $change = CCM::find($id);
        $userdepart = Auth::user()->department;
        $username = Auth::user()->username;

        return view('manager.ccm.update', ['change' => $change, 'username' => $username, 'userdepart' => $userdepart]);
    }




    // public function changeupdate(Request $request, $id)
    // {
    //     $request->validate([
    //         // 'request_no' => 'required|string|max:255',
    //         // 'logging_date' => 'required|date|before_or_equal:today',
    //         // 'initiator' => 'required|string|max:255',
    //         // 'department' => 'required|string|max:255',
    //         'description' => 'nullable|string|max:1000',
    //         'justification' => 'nullable|string|max:1000',
    //         'area' => 'nullable|string|max:255',
    //         'impact' => 'nullable|string|max:255',

    //         'action1' => 'nullable|string|max:500',
    //         'action2' => 'nullable|string|max:500',
    //         'action3' => 'nullable|string|max:500',
    //         'priority' => 'nullable|string|max:50',
    //         'required_date' => 'nullable|date|after_or_equal:today',

    //         'effected_doc1' => 'nullable|string|max:255',
    //         'doc_no1' => 'nullable|string|max:255',
    //         'effected_doc2' => 'nullable|string|max:255',
    //         'doc_no2' => 'nullable|string|max:255',
    //         'effected_doc3' => 'nullable|string|max:255',
    //         'doc_no3' => 'nullable|string|max:255',

    //         // 'classification' => 'required|string|max:255',

    //         'reviewer_name1' => 'nullable|string|max:255',
    //         'recommendation1' => 'nullable|string|max:500',

    //         'reviewer_name2' => 'nullable|string|max:255',
    //         'recommendation2' => 'nullable|string|max:500',

    //         'reviewer_name3' => 'nullable|string|max:255',
    //         'recommendation3' => 'nullable|string|max:500',

    //         'task1' => 'nullable|string|max:500',
    //         'responsible1' => 'nullable|string|max:255',
    //         'completion_date1' => 'nullable|date|after_or_equal:today',

    //         'task2' => 'nullable|string|max:500',
    //         'responsible2' => 'nullable|string|max:255',
    //         'completion_date2' => 'nullable|date|after_or_equal:today',

    //         'task3' => 'nullable|string|max:500',
    //         'responsible3' => 'nullable|string|max:255',
    //         'completion_date3' => 'nullable|date|after_or_equal:today',

    //         'summary' => 'nullable|string|max:1000',
    //         'implementation_date' => 'nullable|date|after_or_equal:today',
    //         // 'final_assessment' => 'required|string|max:1000',
    //         // 'monitoring' => 'nullable|string|max:1000',
    //     ]);

    //     // Find the existing change request by ID
    //     $change = CCM::where('id', $id)->first();

    //     // Update the fields
    //     // $change->request_no = $request->request_no;
    //     // $change->logging_date = $request->logging_date;
    //     // $change->initiator = $request->initiator;
    //     // $change->department = $request->department;

    //     $change->description = $request->description;
    //     $change->justification = $request->justification;
    //     $change->area = $request->area;
    //     $change->impact = $request->impact;

    //     $change->action1 = $request->action1;
    //     $change->action2 = $request->action2;
    //     $change->action3 = $request->action3;
    //     $change->priority = $request->priority;
    //     $change->required_date = $request->required_date;

    //     $change->effected_doc1 = $request->effected_doc1;
    //     $change->doc_no1 = $request->doc_no1;
    //     $change->effected_doc2 = $request->effected_doc2;
    //     $change->doc_no2 = $request->doc_no2;
    //     $change->effected_doc3 = $request->effected_doc3;
    //     $change->doc_no3 = $request->doc_no3;

    //     // $change->classification = $request->classification;

    //     $change->reviewer_name1 = $request->reviewer_name1;
    //     $change->recommendation1 = $request->recommendation1;

    //     $change->reviewer_name2 = $request->reviewer_name2;
    //     $change->recommendation2 = $request->recommendation2;

    //     $change->reviewer_name3 = $request->reviewer_name3;
    //     $change->recommendation3 = $request->recommendation3;

    //     $change->task1 = $request->task1;
    //     $change->responsible1 = $request->responsible1;
    //     $change->completion_date1 = $request->completion_date1;

    //     $change->task2 = $request->task2;
    //     $change->responsible2 = $request->responsible2;
    //     $change->completion_date2 = $request->completion_date2;

    //     $change->task3 = $request->task3;
    //     $change->responsible3 = $request->responsible3;
    //     $change->completion_date3 = $request->completion_date3;

    //     $change->summary = $request->summary;
    //     $change->implementation_date = $request->implementation_date;
    //     // $change->final_assessment = $request->final_assessment;
    //     // $change->monitoring = $request->monitoring;

    //     // Update the 'updated_at' timestamp
    //     $change->updated_at = now();
    //     $change->save();

    //     // Redirect back with a success message
    //     return back()->with('status', 'Change Request Details have been updated.');
    // }



    public function changeupdate(Request $request, $id)
    {
        // Find the existing change request by ID
        $change = CCM::where('id', $id)->first();

        if (!is_null($change->initiator_signtime) && is_null($change->verifier_signtime)) {

            $request->validate([
                'description' => 'required|string|max:1000',
                'justification' => 'required|string|max:1000',
                'area' => 'required|string|max:255',
                'impact' => 'required|string|max:255',

                'action1' => 'required|string|max:500',
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

            $change->save();

            return back()->with('status', 'Change Request Form has been updated.');
        } elseif (!is_null($change->verifier_name) && is_null($change->approver_name)) {
            if ($change->classification === 'Major') {
                for ($i = 1; $i <= 3; $i++) {
                    $reviewer_name = 'reviewer_name' . $i;
                    $recommendation = 'recommendation' . $i;

                    // Check if the user is a reviewer and hasn't given a recommendation
                    if ($change->{$reviewer_name} === Auth::user()->username && is_null($change->{$recommendation})) {
                        $request->validate([
                            "recommendation$i" => 'required|string|max:500',
                        ]);

                        // Update the recommendation
                        $change->{$recommendation} = $request->input("recommendation$i");
                        $change->save();

                        return back()->with('status', 'Recommendation has been updated.');
                    }
                }
            }
        } elseif (!is_null($change->approver_name) && is_null($change->final_assessment)) {
            $request->validate([
                'task1' => 'required|string|max:500',
                'responsible1' => 'required|string|max:255',
                'completion_date1' => 'required|date|after_or_equal:today',

                'task2' => 'nullable|string|max:500',
                'responsible2' => 'nullable|string|max:255',
                'completion_date2' => 'nullable|date|after_or_equal:today',

                'task3' => 'nullable|string|max:500',
                'responsible3' => 'nullable|string|max:255',
                'completion_date3' => 'nullable|date|after_or_equal:today',

                'summary' => 'required|string|max:1000',
                'implementation_date' => 'required|date|after_or_equal:today',
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

            $change->save();

            return back()->with('status', 'Final assessment has been updated.');
        }

        // If no condition matches, return with an error message
        return back()->withErrors('No valid action performed. Please check your inputs.');
    }
}

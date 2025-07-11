<?php

namespace App\Http\Controllers\manager\document_control;

use App\Models\ScSOP;
use App\Models\TsSOP;
use App\Models\Obsolescence;
use Illuminate\Http\Request;
use App\Models\ChangeRequest;
use App\Models\NumberIssuance;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ManagerDocumentationController extends Controller
{

    // ==================== Change Request ===========================


    public function changeView()
    {
        $department = Auth::user()->department;
        $change = ChangeRequest::where('department', $department)->get();
        return view('manager.doc-control.change.view', ['changes' => $change]);
    }

    public function changeForm()
    {
        return view('manager.doc-control.change.add');
    }

    public function changeCreate(Request $request)
    {
        // Validation rules for fixed fields
        $rules = [
            'doc_no' => 'required|string|max:255',
            'doc_name' => 'required|string|max:255',
            'impact' => 'nullable|string|max:500',
        ];

        // Add validation rules for dynamic fields
        for ($i = 1; $i <= 5; $i++) {
            $rules["change{$i}"] = 'nullable|string|max:255';
            $rules["reason{$i}"] = 'nullable|string';
        }

        // Validate the request data
        $validatedData = $request->validate($rules);

        // Generate a new change number
        $lastRecord = ChangeRequest::latest()->first();
        $lastNumber = $lastRecord ? intval(substr($lastRecord->change_no, 4, 3)) : 0;
        $newNumber = sprintf('%03d', $lastNumber + 1); // Increment and pad with zeros
        $currentYear = date('y'); // Get the last two digits of the current year
        $changeNo = "CCR-{$newNumber}-{$currentYear}";

        // Prepare data for saving
        $data = [
            'change_no' => $changeNo,
            'department' => Auth::user()->department,
            'doc_no' => $validatedData['doc_no'],
            'doc_name' => $validatedData['doc_name'],
            'impact' => $validatedData['impact'],
        ];

        // Add dynamic fields to the data array
        for ($i = 1; $i <= 5; $i++) {
            $data["change{$i}"] = $validatedData["change{$i}"] ?? null;
            $data["reason{$i}"] = $validatedData["reason{$i}"] ?? null;
        }

        // Save the data into the database
        ChangeRequest::create($data);

        // Redirect back with success message
        return redirect()->back()->with('status', 'Document Change Request created successfully!');
    }

    public function changeVerify($id)
    {
        $change = ChangeRequest::find($id);

        $change->verifier_name = Auth::user()->username;
        $change->verifier_department = Auth::user()->department;
        $change->verifier_designation = Auth::user()->designation;
        $change->verifier_signtime = now();

        $change->save();
        return back()->with('status', 'Document Change Request is sent for Director Approval.');
    }


    public function changeEdit($id)
    {
        $change = ChangeRequest::find($id);
        return view('manager.doc-control.change.update', ['change' => $change]);
    }


    public function changeUpdate(Request $request, $id)
    {
        // Find the existing change request record
        $change = ChangeRequest::findOrFail($id);


        // Validation rules for fixed fields
        $rules = [
            'doc_no' => 'required|string|max:255',
            'doc_name' => 'required|string|max:255',
            'impact' => 'nullable|string|max:500',
        ];

        // Add validation rules for dynamic fields
        for ($i = 1; $i <= 5; $i++) {
            $rules["change{$i}"] = 'nullable|string|max:255';
            $rules["reason{$i}"] = 'nullable|string';
        }

        // Validate the request data
        $validatedData = $request->validate($rules);

        // Update fixed fields
        $change->doc_no = $validatedData['doc_no'];
        $change->doc_name = $validatedData['doc_name'];
        $change->impact = $validatedData['impact'];
        $change->department = Auth::user()->department; // Update to current user's department if necessary

        // Update dynamic fields
        for ($i = 1; $i <= 5; $i++) {
            $change["change{$i}"] = $validatedData["change{$i}"] ?? null;
            $change["reason{$i}"] = $validatedData["reason{$i}"] ?? null;
        }

        // Save the updated data into the database
        $change->save();

        // Redirect back with success message
        return redirect()->back()->with('status', 'Document Change Request updated successfully!');
    }


    public function changeDelete($id)
    {
        $change = ChangeRequest::find($id);
        $change->delete();
        return back()->with('status', 'Document Change Request has been removed.');
    }






    // ==================== Issuance ===========================

    public function issueView()
    {
        $departemnt = Auth::user()->department;
        $issue = NumberIssuance::where('department', $departemnt)->get();
        return view('manager.doc-control.issue.view', ['issues' => $issue]);
    }

    public function issueForm()
    {
        return view('manager.doc-control.issue.add');
    }

    public function issueCreate(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'doc_no' => 'required|string|max:255',
            'doc_name' => 'required|string|max:255',
            'reason' => 'required|string|max:1000',
        ]);

        $data = [
            'department' => Auth::user()->department,
            'doc_no' => $validatedData['doc_no'],
            'doc_name' => $validatedData['doc_name'],
            'reason' => $validatedData['reason'],
        ];

        // Create a new record
        NumberIssuance::create($data);

        // Redirect back with success message
        return redirect()->back()->with('status', 'Document Number Issuance Form created successfully.');
    }


    public function issueVerify($id)
    {
        $issue = NumberIssuance::find($id);

        $issue->verifier_name = Auth::user()->username;
        $issue->verifier_department = Auth::user()->department;
        $issue->verifier_designation = Auth::user()->designation;
        $issue->verifier_signtime = now();

        $issue->save();
        return back()->with('status', 'Document Number Issuance Request is sent for QA Approval.');
    }


    public function issueEdit($id)
    {
        $issue = NumberIssuance::find($id);
        return view('manager.doc-control.issue.update', ['issue' => $issue]);
    }


    public function issueUpdate(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'doc_no' => 'required|string|max:255',
            'doc_name' => 'required|string|max:255',
            'reason' => 'required|string|max:1000',
        ]);

        // Find the specific issue by ID
        $issue = NumberIssuance::find($id);

        // Prepare data for updating
        $data = [
            'doc_no' => $validatedData['doc_no'],
            'doc_name' => $validatedData['doc_name'],
            'reason' => $validatedData['reason'],
        ];

        // Update the record in the database
        $issue->update($data);

        // Redirect back with success message
        return redirect()->back()->with('status', 'Document Number Issuance Form updated successfully.');
    }


    public function issueDelete($id)
    {
        $issue = NumberIssuance::find($id);
        $issue->delete();
        return back()->with('status', 'Document Number Issuance Record has been removed.');
    }






    // ==================== Obsolescence ===========================

    public function obsolescenceView()
    {
        $departemnt = Auth::user()->department;
        $ob = Obsolescence::where('department', $departemnt)->get();
        return view('manager.doc-control.obsolescence.view', ['obs' => $ob]);
    }

    public function obsolescenceForm()
    {
        return view('manager.doc-control.obsolescence.add');
    }

    public function obsolescenceCreate(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'doc_no' => 'required|string|max:255',
            'doc_name' => 'required|string|max:255',
            'reason' => 'required|string|max:1000',
        ]);

        $data = [
            'department' => Auth::user()->department,
            'doc_no' => $validatedData['doc_no'],
            'doc_name' => $validatedData['doc_name'],
            'reason' => $validatedData['reason'],
        ];

        // Create a new record
        Obsolescence::create($data);

        // Redirect back with success message
        return redirect()->back()->with('status', 'Document obsolescence Record created successfully.');
    }


    public function obsolescenceVerify($id)
    {
        $obs = Obsolescence::find($id);

        $obs->verifier_name = Auth::user()->username;
        $obs->verifier_department = Auth::user()->department;
        $obs->verifier_designation = Auth::user()->designation;
        $obs->verifier_signtime = now();

        $obs->save();

        return back()->with('status', 'Obsolescence request has been sent for QA approval.');
    }


    public function obsolescenceEdit($id)
    {
        $obs = Obsolescence::find($id);
        return view('manager.doc-control.obsolescence.update', ['obs' => $obs]);
    }


    public function obsolescenceUpdate(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'doc_no' => 'required|string|max:255',
            'doc_name' => 'required|string|max:255',
            'reason' => 'required|string|max:1000',
        ]);

        // Find the specific issue by ID
        $obs = Obsolescence::find($id);

        // Prepare data for updating
        $data = [
            'doc_no' => $validatedData['doc_no'],
            'doc_name' => $validatedData['doc_name'],
            'reason' => $validatedData['reason'],
        ];

        // Update the record in the database
        $obs->update($data);

        // Redirect back with success message
        return redirect()->back()->with('status', 'Document Obsolescence Record updated successfully.');
    }


    public function obsolescenceDelete($id)
    {
        $obs = Obsolescence::find($id);
        $obs->delete();
        return back()->with('status', 'Document Obsolescence Record has been removed.');
    }




    // ==================== Master Index - Internal ===========================

    public function internalView()
    {
        $department = Auth::user()->department;

        if ($department === "TS") {
            $sop = TsSOP::get();
            return view('manager.doc-control.mi-internal.view', ['sops' => $sop,]);
        }
        elseif ($department === "SC") {
            $sop = ScSOP::get();
            return view('manager.doc-control.mi-internal.view', ['sops' => $sop,]);
        }
    }
}

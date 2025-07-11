<?php

namespace App\Http\Controllers\qa\recall;

use App\Models\Recall;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RecallController extends Controller
{
    public function recallview()
    {
        $recall = Recall::get();
        return view('qa.recall.information.view', ['recalls' => $recall]);
    }

    public function recallform()
    {
        return view('qa.recall.information.add');
    }

    public function recallcreate(Request $request)
    {
        // Validate the input data
        $request->validate([
            'reporter_name' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact' => 'required|string',
            'email' => 'required|email|max:255',
            'receipt_date' => 'required|date',

            'product_name' => 'required|string|max:255',
            'registration_no' => 'required|string|max:255',
            'batch' => 'nullable|string|max:255',
            'serial' => 'nullable|string|max:255',
            'expiry' => 'nullable|date',
            'manufacturing_date' => 'nullable|date',

            'qty_before' => 'nullable|integer|min:0',
            'qty_distributed' => 'nullable|integer|min:0',

            'customer_name1' => 'nullable|string|max:255',
            'distribution_date1' => 'nullable|date',

            'customer_name2' => 'nullable|string|max:255',
            'distribution_date2' => 'nullable|date',

            'customer_name3' => 'nullable|string|max:255',
            'distribution_date3' => 'nullable|date',

            'source' => 'nullable|string|max:255',
            'problem_detail' => 'nullable|string',
            'no_of_complaint' => 'nullable|integer|min:0',
            'action_taken' => 'nullable|string',
            'risk_assessment' => 'nullable|string',
            'recall_type' => 'nullable|string',
        ]);

        // Create the recall record after validation
        Recall::create([
            'reporter_name' => $request->reporter_name,
            'organization' => $request->organization,
            'address' => $request->address,
            'contact' => $request->contact,
            'email' => $request->email,
            'receipt_date' => $request->receipt_date,

            'product_name' => $request->product_name,
            'registration_no' => $request->registration_no,
            'batch' => $request->batch,
            'serial' => $request->serial,
            'expiry' => $request->expiry,
            'manufacturing_date' => $request->manufacturing_date,

            'qty_before' => $request->qty_before,
            'qty_distributed' => $request->qty_distributed,

            'customer_name1' => $request->customer_name1,
            'distribution_date1' => $request->distribution_date1,

            'customer_name2' => $request->customer_name2,
            'distribution_date2' => $request->distribution_date2,

            'customer_name3' => $request->customer_name3,
            'distribution_date3' => $request->distribution_date3,

            'source' => $request->source,
            'problem_detail' => $request->problem_detail,
            'no_of_complaint' => $request->no_of_complaint,
            'action_taken' => $request->action_taken,
            'risk_assessment' => $request->risk_assessment,
            'recall_type' => $request->recall_type,

            'created_at' => now(),
        ]);

        // Redirect back with a success message
        return back()->with('status', 'Recall Form has been created.');
    }


    public function recallreview($id)
    {
        $recall = Recall::find($id);

        $recall->reviewer_name = Auth::user()->username;
        $recall->reviewer_department = Auth::user()->department;
        $recall->reviewer_designation = Auth::user()->designation;
        $recall->reviewer_signtime = now();

        $recall->save();
        return back()->with('status', 'Recall Form is sent to Director for approval.');
    }

    // public function recallapprove($id)
    // {
    //     $recall = Recall::find($id);

    //     $recall->approver_name = Auth::user()->username;
    //     $recall->approver_department = Auth::user()->department;
    //     $recall->approver_designation = Auth::user()->designation;
    //     $recall->approver_signtime = now();

    //     $recall->save();
    //     return back()->with('status', 'Recall Form has been approved.');
    // }


    public function recalledit($id)
    {
        $recall = Recall::find($id);
        return view('qa.recall.information.update', ['recall' => $recall]);
    }

    public function recallupdate(Request $request, $id)
    {
        // Validate the input data
        $request->validate([
            'reporter_name' => 'required|string|max:255',
            'organization' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'contact' => 'required|string',
            'email' => 'required|email|max:255',
            'receipt_date' => 'required|date',

            'product_name' => 'required|string|max:255',
            'registration_no' => 'required|string|max:255',
            'batch' => 'nullable|string|max:255',
            'serial' => 'nullable|string|max:255',
            'expiry' => 'nullable|date',
            'manufacturing_date' => 'nullable|date',

            'qty_before' => 'nullable|integer|min:0',
            'qty_distributed' => 'nullable|integer|min:0',

            'customer_name1' => 'nullable|string|max:255',
            'distribution_date1' => 'nullable|date',

            'customer_name2' => 'nullable|string|max:255',
            'distribution_date2' => 'nullable|date',

            'customer_name3' => 'nullable|string|max:255',
            'distribution_date3' => 'nullable|date',

            'source' => 'nullable|string|max:255',
            'problem_detail' => 'nullable|string',
            'no_of_complaint' => 'nullable|integer|min:0',
            'action_taken' => 'nullable|string',
            'risk_assessment' => 'nullable|string',
            'recall_type' => 'nullable|string',
        ]);

        $recall = Recall::where('id', $id)->first();

        $recall->reporter_name = $request->reporter_name;
        $recall->organization = $request->organization;
        $recall->address = $request->address;
        $recall->contact = $request->contact;
        $recall->email = $request->email;
        $recall->receipt_date = $request->receipt_date;

        $recall->product_name = $request->product_name;
        $recall->registration_no = $request->registration_no;
        $recall->batch = $request->batch;
        $recall->serial = $request->serial;
        $recall->expiry = $request->expiry;
        $recall->manufacturing_date = $request->manufacturing_date;

        $recall->qty_before = $request->qty_before;
        $recall->qty_distributed = $request->qty_distributed;

        $recall->customer_name1 = $request->customer_name1;
        $recall->distribution_date1 = $request->distribution_date1;

        $recall->customer_name2 = $request->customer_name2;
        $recall->distribution_date2 = $request->distribution_date2;

        $recall->customer_name3 = $request->customer_name3;
        $recall->distribution_date3 = $request->distribution_date3;

        $recall->source = $request->source;
        $recall->problem_detail = $request->problem_detail;
        $recall->no_of_complaint = $request->no_of_complaint;
        $recall->action_taken = $request->action_taken;
        $recall->risk_assessment = $request->risk_assessment;
        $recall->recall_type = $request->recall_type;

        $recall->updated_at->now();
        $recall->save();

        return back()->with('status', 'Recall Form has been updated.');
    }

    public function recalldelete($id)
    {
        $recall = Recall::find($id);
        $recall->delete();
        return back()->with('status', 'Recall Form has been Deleted Successfully.');
    }
}

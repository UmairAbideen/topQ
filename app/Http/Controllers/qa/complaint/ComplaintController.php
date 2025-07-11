<?php

namespace App\Http\Controllers\qa\complaint;

use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ComplaintNotification;

class ComplaintController extends Controller
{
    public function complaint()
    {
        $complaint = Complaint::get();
        return view('qa.complaint.view', ['complaints' => $complaint]);
    }

    public function complaintform()
    {
        return view('qa.complaint.add');
    }


    public function create(Request $request)
    {
        $request->validate([
            'receipt_date' => 'required',
            'customer_name' => 'required',
            'detail' => 'required',
            'category' => 'required',
            'product_name' => 'required',
            'batch' => 'nullable',
            'serial' => 'nullable',
            'expiry' => 'nullable',
            'quantity' => 'nullable',
            'capa_init' => 'nullable',
            'capa_no' => 'nullable',
            'status' => 'nullable',
        ]);

        $latestComplaint = Complaint::latest('id')->first();

        if ($latestComplaint && $latestComplaint->complaint_no) {
            // Extract the number part from the complaint_no (e.g., 001 from 001-24)
            $lastNumber = intval(substr($latestComplaint->complaint_no, 0, 3));

            // Increment the number
            $nextNumber = sprintf('%03d', $lastNumber + 1); // Format as 3-digit number
        } else {
            // If no previous complaints, start with '001'
            $nextNumber = '001';
        }

        // Get the current year and extract the last two digits (e.g., 2024 -> 24)
        $currentYear = date('Y');
        $suffix = substr($currentYear, 2, 2); // Last two digits of the current year

        $nextComplaintNo = $nextNumber . '-' . $suffix;

        // Get the authenticated user
        $user = Auth::user();

        $complaint = Complaint::create([
            'complaint_no' => $nextComplaintNo, // Automatically filled with the next complaint number
            'receipt_date' => $request->receipt_date,
            'customer' => $request->customer_name,
            'detail' => $request->detail,
            'category' => $request->category,
            'product' => $request->product_name,
            'batch' => $request->batch,
            'serial' => $request->serial,
            'expiry' => $request->expiry,
            'quantity' => $request->quantity,
            'capa_init' => $request->capa_init,
            'capa_no' => $request->capa_no,
            'capa_status' => $request->status,
            'associate_name' => $user->username, // Automatically filled with the authenticated user's name
            'associate_email' => $user->email, // Automatically filled with the authenticated user's email
            'created_at' => now(),
        ]);

        // Notify the user of the new complaint
        // auth()->user()->notify(new ComplaintNotification($complaint));

        // Return back with success status
        return back()->with('status', 'Complaint has been submitted.');
    }



    public function markasread($id)
    {
        if ($id) {
            auth()->user()->unreadnotifications->where('id', $id)->markAsRead();
        }
        return back();
    }

    public function edit($id)
    {
        $complaint = Complaint::find($id);
        return view('qa.complaint.update', ['complaint' => $complaint]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'complaint_no' => 'required',
            'receipt_date' => 'required',
            'customer_name' => 'required',
            'detail' => 'required',
            'category' => 'required',
            'product_name' => 'required',
            'batch' => 'required',
            'serial' => 'required',
            'expiry' => 'required',
            'quantity' => 'required|numeric',
            'capa_init' => 'required',
            'capa_no' => 'required',
            'status' => 'required',
            'associate_name' => 'required',
            'associate_email' => 'required|email',
        ]);


        $complaint = Complaint::where('id', $id)->first();

        $complaint->department = Auth::user()->department;
        $complaint->complaint_no = $request->complaint_no;
        $complaint->receipt_date = $request->receipt_date;
        $complaint->customer = $request->customer_name;
        $complaint->detail = $request->detail;
        $complaint->category = $request->category;
        $complaint->product = $request->product_name;
        $complaint->batch = $request->batch;
        $complaint->serial = $request->serial;
        $complaint->expiry = $request->expiry;
        $complaint->quantity = $request->quantity;
        $complaint->capa_init = $request->capa_init;
        $complaint->capa_no = $request->capa_no;
        $complaint->capa_status = $request->status;
        $complaint->associate_name = $request->associate_name;
        $complaint->associate_email = $request->associate_email;
        $complaint->updated_at->now();
        $complaint->save();

        return back()->with('status', 'Complaint Details Updated Successfully.');
    }

    public function delete($id)
    {
        $complaint = Complaint::find($id);
        $complaint->delete();
        return back()->with('status', 'Complaint has been Deleted Successfully.');
    }
}

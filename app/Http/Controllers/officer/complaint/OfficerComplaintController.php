<?php

namespace App\Http\Controllers\officer\complaint;

use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OfficerComplaintController extends Controller
{

    public function complaintform()
    {

        $department = auth()->user()->department;


        return view('officer.complaint.add', [
            'department' => $department,
        ]);
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
        $department = Auth::user()->department;

        Complaint::create([
            'department' => $department,
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

    // public function markasread($id)
    // {
    //     if ($id) {
    //         auth()->user()->unreadnotifications->where('id', $id)->markAsRead();
    //     }
    //     return back();
    // }
}

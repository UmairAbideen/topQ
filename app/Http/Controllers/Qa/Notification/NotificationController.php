<?php

namespace App\Http\Controllers\Qa\Notification;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    // public function notificationview()
    // {
    //     $notifications = Notification::get(); // Fetch notifications
    //     return view('qa.layout.app', ['notifications' => $notifications]);
    // }

    // public function create(Request $request)
    // {
    //     $request->validate([

    //     ]);

    //     Complaint::create([
    //         'complaint_no' => $request->complaint_no,
    //         'receipt_date' => $request->receipt_date,
    //         'customer' => $request->customer_name,
    //         'detail' => $request->detail,
    //         'category' => $request->category,
    //         'product' => $request->product_name,
    //         'batch' => $request->batch,
    //         'serial' => $request->serial,
    //         'expiry' => $request->expiry,
    //         'quantity' => $request->quantity,
    //         'capa_init' => $request->capa_init,
    //         'capa_no' => $request->capa_no,
    //         'capa_status' => $request->status,
    //         'created_at' => now(),
    //     ]);

    //     return back()->with('status', 'Complaint has been submitted.');
    // }

    // public function edit($id)
    // {
    //     $complaint = Complaint::find($id);
    //     return view('qa.complaint.update', ['complaint' => $complaint]);
    // }

    // public function update(Request $request, $id)
    // {
    //     $request->validate([

    //         // 'complaint_no' => 'required',

    //     ]);

    //     $complaint = Complaint::where('id', $id)->first();
    //     $complaint->complaint_no = $request->complaint_no;
    //     $complaint->receipt_date = $request->receipt_date;
    //     $complaint->customer = $request->customer_name;
    //     $complaint->detail = $request->detail;
    //     $complaint->category = $request->category;
    //     $complaint->product = $request->product_name;
    //     $complaint->batch = $request->batch;
    //     $complaint->serial = $request->serial;
    //     $complaint->expiry = $request->expiry;
    //     $complaint->quantity = $request->quantity;
    //     $complaint->capa_init = $request->capa_init;
    //     $complaint->capa_no = $request->capa_no;
    //     $complaint->capa_status = $request->status;
    //     $complaint->updated_at->now();
    //     $complaint->save();

    //     return back()->with('status', 'Complaint Details Updated Successfully.');
    // }

    // public function delete($id)
    // {
    //     $complaint = Complaint::find($id);
    //     $complaint->delete();
    //     return back()->with('status', 'Complaint has been Deleted Successfully.');
    // }

}

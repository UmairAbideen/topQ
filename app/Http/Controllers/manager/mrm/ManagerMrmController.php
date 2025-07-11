<?php

namespace App\Http\Controllers\manager\mrm;

use App\Models\MrmAgenda;
use App\Models\MrmAttendance;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ManagerMrmController extends Controller
{
    public function attendanceview()
    {

        $agenda = MrmAgenda::with('attendance')->get();
        return view('manager.mrm.attendance.view', ['agenda' => $agenda]);

        // $attendance = MrmAttendance::get();
        // return view('manager.mrm.attendance.view', ['attendance' => $attendance]);
    }

    public function attendancesign($id)
    {
        $attendance = MrmAttendance::find($id);

        // checking which name column in attendance matches the authenticated user
        for ($i = 1; $i <= 8; $i++) {
            $userNameField = 'name' . $i;
            $designationField = 'designation' . $i;
            $signatureField = 'signature' . $i;
            $signatureTimeField = 'signature_time' . $i;

            if ($attendance->$userNameField == Auth::user()->username) {
                // Assigning user details dynamically based on the matching column
                $attendance->$designationField = Auth::user()->designation;
                $attendance->$signatureField = Auth::user()->username;
                $attendance->$signatureTimeField = now();
                break; // Exit the loop once a match is found
            }
        }

        $attendance->save();
        return back()->with('status', 'Attendance Sheet has been signed.');
    }
}

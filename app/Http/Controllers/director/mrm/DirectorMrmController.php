<?php

namespace App\Http\Controllers\director\mrm;

use App\Models\MrmAgenda;
use App\Models\MrmMinutes;
use App\Models\MrmAttendance;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DirectorMrmController extends Controller
{


    // ====================================  Agenda  ====================================

    public function agendaview()
    {
        $agenda = MrmAgenda::get();
        return view('director.mrm.agenda.view', ['agendas' => $agenda]);
    }

    public function agendaapprove($id)
    {
        $agenda = MrmAgenda::find($id);

        $agenda->approved_by = Auth::user()->username;
        $agenda->approver_designation = Auth::user()->designation;
        $agenda->approval_time = now();

        $agenda->save();
        return back()->with('status', 'Agenda has been approved');
    }











    // ====================================  Minutes  ====================================

    public function minutesview($id)
    {
        $agenda = MrmAgenda::with('minute')->where('id', $id)->first();
        return view('director.mrm.minutes.view', ['agenda' => $agenda]);
    }

    public function minutesapprove($id)
    {
        $minutes = MrmMinutes::find($id);

        $minutes->approved_by = Auth::user()->username;
        $minutes->approver_designation = Auth::user()->designation;
        $minutes->approval_time = now();

        $minutes->save();
        return back()->with('status', 'Minutes has been approved');
    }












    // ====================================  Attendance  ====================================

    public function attendanceview($id)
    {
        $agenda = MrmAgenda::with('attendance')->where('id', $id)->first();
        return view('director.mrm.attendance.view', ['agenda' => $agenda]);
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

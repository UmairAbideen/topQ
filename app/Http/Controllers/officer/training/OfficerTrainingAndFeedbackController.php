<?php

namespace App\Http\Controllers\officer\training;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TrainingAndFeedback;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OfficerTrainingAndFeedbackController extends Controller
{
    // ====================================  Attendance  ====================================

    public function triningAttendanceView()
    {
        $userName = Auth::user()->username;
        $department = Auth::user()->department;

        // Start building the query
        $query = TrainingAndFeedback::query();

        // Add conditions for dynamic attendee name matching
        for ($i = 1; $i <= 60; $i++) {
            $query->orWhere("attendee_name{$i}", $userName);
        }

        // Execute the query
        $training = $query->get();

        return view('officer.training.attendance.view', ['training' => $training, 'username' => $userName, 'department' => $department]);
    }

    public function trineeAttendance($id)
    {
        $attendance = TrainingAndFeedback::find($id);

        if (!$attendance) {
            return back()->with('error', 'Attendance record not found.');
        }

        // Loop through 1 to 60 to find the first available slot
        for ($i = 1; $i <= 60; $i++) {
            if ($attendance->{"attendee_name$i"} === Auth::user()->username) {
                if (is_null($attendance->{"attendee_signtime$i"})) {
                    $attendance->{"attendee_department$i"} = Auth::user()->department;
                    $attendance->{"attendee_designation$i"} = Auth::user()->designation;
                    $attendance->{"attendee_signtime$i"} = now();
                    $attendance->save();
                    return back()->with('status', 'Training Attendance has been signed.');
                }
            }
        }

        return back()->with('error', 'No available slots for attendance.');
    }

}

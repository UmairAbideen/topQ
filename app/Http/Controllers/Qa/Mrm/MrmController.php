<?php

namespace App\Http\Controllers\Qa\Mrm;

use App\Models\MrmAgenda;
use App\Models\MrmMinutes;
use Illuminate\Http\Request;
use App\Models\MrmAttendance;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;



class MrmController extends Controller
{


    // ====================================  Agenda  ====================================

    public function agendaview()
    {
        $agenda = MrmAgenda::get();
        return view('qa.mrm.agenda.view', ['agendas' => $agenda]);
    }

    public function agendaform()
    {
        return view('qa.mrm.agenda.add');
    }

    public function agendacreate(Request $request)
    {
        // Validation for the fields until review_item1

        $request->validate([
            'meeting_date' => 'required|date',
            'review_period' => 'required|string|max:255',
            'start_time' => 'required', // Ensure correct time format
            'end_time' => 'required',
            'venue' => 'required|string|max:255',
            'review_item1' => 'required|string|max:255', // Required until review_item1
        ]);

        // Generate the next meeting_no
        // Get the latest meeting_no
        $latestAgenda = MrmAgenda::orderBy('id', 'desc')->first();

        // Extract the numeric part of the meeting_no and increment it
        if ($latestAgenda) {
            // Extract the numeric part (e.g., "MRM-001-24" becomes "001")
            $latestNumber = (int)substr($latestAgenda->meeting_no, 4, 3);
            $nextNumber = $latestNumber + 1;
        } else {
            $nextNumber = 1;
        }

        // Pad the number with leading zeros (e.g., 001, 002, etc.)
        $formattedNumber = str_pad($nextNumber, 3, '0', STR_PAD_LEFT);

        // Get the current year (last two digits)
        $currentYear = now()->format('y');

        // Combine to form the meeting_no (e.g., "MRM-001-24")
        $meetingNo = "MRM-{$formattedNumber}-{$currentYear}";

        // Create the agenda entry
        MrmAgenda::create([
            'meeting_no' => $meetingNo,
            'meeting_date' => $request->meeting_date,
            'review_period' => $request->review_period,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'venue' => $request->venue,

            'review_item1' => $request->review_item1,
            'review_item2' => $request->review_item2,
            'review_item3' => $request->review_item3,
            'review_item4' => $request->review_item4,
            'review_item5' => $request->review_item5,

            'review_item6' => $request->review_item6,
            'review_item7' => $request->review_item7,
            'review_item8' => $request->review_item8,
            'review_item9' => $request->review_item9,
            'review_item10' => $request->review_item10,

            'created_at' => now(),
        ]);

        return back()->with('status', 'New Agenda has been Created.');
    }


    public function agendaprepare($id)
    {
        $agenda = MrmAgenda::find($id);

        $agenda->prepared_by = Auth::user()->username;
        $agenda->preparator_designation = Auth::user()->designation;
        $agenda->preparation_time = now();

        $agenda->save();
        return back()->with('status', 'Agenda is sent for Approval');
    }


    // public function agendaapprove($id)
    // {
    // }


    public function agendaedit($id)
    {
        $agenda = MrmAgenda::find($id);
        return view('qa.mrm.agenda.update', ['agenda' => $agenda]);
    }

    public function agendaupdate(Request $request, $id)
    {
        // Validate the request inputs
        $request->validate([
            'meeting_no' => ['required', 'regex:/^MRM-\d{3}-\d{2}$/'], // Meeting number format MRM-001-24
            'meeting_date' => 'required|date',
            'review_period' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required',
            'venue' => 'required|string|max:255',

            'review_item1' => 'required|string',
            'review_item2' => 'nullable|string',
            'review_item3' => 'nullable|string',
            'review_item4' => 'nullable|string',
            'review_item5' => 'nullable|string',
            'review_item6' => 'nullable|string',
            'review_item7' => 'nullable|string',
            'review_item8' => 'nullable|string',
            'review_item9' => 'nullable|string',
            'review_item10' => 'nullable|string',
        ]);

        // Fetch the agenda by ID
        $agenda = MrmAgenda::where('id', $id)->first();

        // Update the agenda fields
        $agenda->meeting_no = $request->meeting_no;
        $agenda->meeting_date = $request->meeting_date;
        $agenda->review_period = $request->review_period;
        $agenda->start_time = $request->start_time;
        $agenda->end_time = $request->end_time;
        $agenda->venue = $request->venue;

        $agenda->review_item1 = $request->review_item1;
        $agenda->review_item2 = $request->review_item2;
        $agenda->review_item3 = $request->review_item3;
        $agenda->review_item4 = $request->review_item4;
        $agenda->review_item5 = $request->review_item5;
        $agenda->review_item6 = $request->review_item6;
        $agenda->review_item7 = $request->review_item7;
        $agenda->review_item8 = $request->review_item8;
        $agenda->review_item9 = $request->review_item9;
        $agenda->review_item10 = $request->review_item10;

        // Update the timestamp and save the agenda
        $agenda->updated_at = now();
        $agenda->save();

        // Return with success message
        return back()->with('status', 'Agenda Updated Successfully.');
    }

    public function agendadelete($id)
    {
        $agenda = MrmAgenda::find($id);
        $agenda->delete();
        return back()->with('status', 'Agenda has been removed.');
    }





    // ====================================  Minutes  ====================================

    public function minutesview($id)
    {
        $agenda = MrmAgenda::with('minute')->where('id', $id)->first();
        return view('qa.mrm.minutes.view', ['agenda' => $agenda]);
    }

    public function minutesform($id)
    {
        $agenda = MrmAgenda::where('id', $id)->first();
        return view('qa.mrm.minutes.add', ['agenda' => $agenda]);
    }

    public function minutescreate(Request $request)
    {
        $currentYear = date('y'); // Get the current year in two-digit format (e.g., '24' for 2024)

        $request->validate([
            'action1' => 'required|string|max:255',
            'responsible1' => 'required|string|max:255',
            'completion_date1' => 'required|date',
            'remarks1' => 'required|string|max:255',

            // Validation for other fields as needed
            'decision2' => 'nullable|string|max:255',
            'action2' => 'nullable|string|max:255',
            'responsible2' => 'nullable|string|max:255',
            'completion_date2' => 'nullable|date',
            'remarks2' => 'nullable|string|max:255',

            'decision3' => 'nullable|string|max:255',
            'action3' => 'nullable|string|max:255',
            'responsible3' => 'nullable|string|max:255',
            'completion_date3' => 'nullable|date',
            'remarks3' => 'nullable|string|max:255',

            'decision4' => 'nullable|string|max:255',
            'action4' => 'nullable|string|max:255',
            'responsible4' => 'nullable|string|max:255',
            'completion_date4' => 'nullable|date',
            'remarks4' => 'nullable|string|max:255',

            'decision5' => 'nullable|string|max:255',
            'action5' => 'nullable|string|max:255',
            'responsible5' => 'nullable|string|max:255',
            'completion_date5' => 'nullable|date',
            'remarks5' => 'nullable|string|max:255',

            'decision6' => 'nullable|string|max:255',
            'action6' => 'nullable|string|max:255',
            'responsible6' => 'nullable|string|max:255',
            'completion_date6' => 'nullable|date',
            'remarks6' => 'nullable|string|max:255',

            'decision7' => 'nullable|string|max:255',
            'action7' => 'nullable|string|max:255',
            'responsible7' => 'nullable|string|max:255',
            'completion_date7' => 'nullable|date',
            'remarks7' => 'nullable|string|max:255',

            'decision8' => 'nullable|string|max:255',
            'action8' => 'nullable|string|max:255',
            'responsible8' => 'nullable|string|max:255',
            'completion_date8' => 'nullable|date',
            'remarks8' => 'nullable|string|max:255',

            'decision9' => 'nullable|string|max:255',
            'action9' => 'nullable|string|max:255',
            'responsible9' => 'nullable|string|max:255',
            'completion_date9' => 'nullable|date',
            'remarks9' => 'nullable|string|max:255',

            'decision10' => 'nullable|string|max:255',
            'action10' => 'nullable|string|max:255',
            'responsible10' => 'nullable|string|max:255',
            'completion_date10' => 'nullable|date',
            'remarks10' => 'nullable|string|max:255',

        ]);

        $agenda = MrmAgenda::find($request->agenda_id);

        // Check if a reply already exists
        if ($agenda->minute) {
            return back()->with('error', 'Minutes for this Meeting already exists.');
        }


        MrmMinutes::create([
            'mrm_agenda_id' => $request->agenda_id,
            'decision1' => $request->decision1,
            'action1' => $request->action1,
            'responsible1' => $request->responsible1,
            'completion_date1' => $request->completion_date1,
            'remarks1' => $request->remarks1,

            'decision2' => $request->decision2,
            'action2' => $request->action2,
            'responsible2' => $request->responsible2,
            'completion_date2' => $request->completion_date2,
            'remarks2' => $request->remarks2,

            'decision3' => $request->decision3,
            'action3' => $request->action3,
            'responsible3' => $request->responsible3,
            'completion_date3' => $request->completion_date3,
            'remarks3' => $request->remarks3,

            'decision4' => $request->decision4,
            'action4' => $request->action4,
            'responsible4' => $request->responsible4,
            'completion_date4' => $request->completion_date4,
            'remarks4' => $request->remarks4,

            'decision5' => $request->decision5,
            'action5' => $request->action5,
            'responsible5' => $request->responsible5,
            'completion_date5' => $request->completion_date5,
            'remarks5' => $request->remarks5,

            'decision6' => $request->decision6,
            'action6' => $request->action6,
            'responsible6' => $request->responsible6,
            'completion_date6' => $request->completion_date6,
            'remarks6' => $request->remarks6,

            'decision7' => $request->decision7,
            'action7' => $request->action7,
            'responsible7' => $request->responsible7,
            'completion_date7' => $request->completion_date7,
            'remarks7' => $request->remarks7,

            'decision8' => $request->decision8,
            'action8' => $request->action8,
            'responsible8' => $request->responsible8,
            'completion_date8' => $request->completion_date8,
            'remarks8' => $request->remarks8,

            'decision9' => $request->decision9,
            'action9' => $request->action9,
            'responsible9' => $request->responsible9,
            'completion_date9' => $request->completion_date9,
            'remarks9' => $request->remarks9,

            'decision10' => $request->decision10,
            'action10' => $request->action10,
            'responsible10' => $request->responsible10,
            'completion_date10' => $request->completion_date10,
            'remarks10' => $request->remarks10,

            'created_at' => now(),
        ]);

        return back()->with('status', 'Minutes have been Created.');
    }


    public function minutesprepare($id)
    {
        $minutes = MrmMinutes::find($id);

        $minutes->prepared_by = Auth::user()->username;
        $minutes->preparator_designation = Auth::user()->designation;
        $minutes->preparation_time = now();

        $minutes->save();
        return back()->with('status', 'Minutes is sent for Approval');
    }


    // public function minutesapprove($id)
    // {
    // }


    public function minutesedit($id)
    {
        $minutes = MrmMinutes::with('agenda')->find($id);
        return view('qa.mrm.minutes.update', ['minutes' => $minutes]);
    }

    public function minutesupdate(Request $request, $id)
    {
        $request->validate([
            'decision1' => 'required|string|max:255',
            'action1' => 'required|string|max:255',
            'responsible1' => 'required|string|max:255',
            'completion_date1' => 'required|date',
            'remarks1' => 'required|string|max:255',

            // Validation for other fields as needed
            'decision2' => 'nullable|string|max:255',
            'action2' => 'nullable|string|max:255',
            'responsible2' => 'nullable|string|max:255',
            'completion_date2' => 'nullable|date',
            'remarks2' => 'nullable|string|max:255',

            'decision3' => 'nullable|string|max:255',
            'action3' => 'nullable|string|max:255',
            'responsible3' => 'nullable|string|max:255',
            'completion_date3' => 'nullable|date',
            'remarks3' => 'nullable|string|max:255',

            'decision4' => 'nullable|string|max:255',
            'action4' => 'nullable|string|max:255',
            'responsible4' => 'nullable|string|max:255',
            'completion_date4' => 'nullable|date',
            'remarks4' => 'nullable|string|max:255',

            'decision5' => 'nullable|string|max:255',
            'action5' => 'nullable|string|max:255',
            'responsible5' => 'nullable|string|max:255',
            'completion_date5' => 'nullable|date',
            'remarks5' => 'nullable|string|max:255',

            'decision6' => 'nullable|string|max:255',
            'action6' => 'nullable|string|max:255',
            'responsible6' => 'nullable|string|max:255',
            'completion_date6' => 'nullable|date',
            'remarks6' => 'nullable|string|max:255',

            'decision7' => 'nullable|string|max:255',
            'action7' => 'nullable|string|max:255',
            'responsible7' => 'nullable|string|max:255',
            'completion_date7' => 'nullable|date',
            'remarks7' => 'nullable|string|max:255',

            'decision8' => 'nullable|string|max:255',
            'action8' => 'nullable|string|max:255',
            'responsible8' => 'nullable|string|max:255',
            'completion_date8' => 'nullable|date',
            'remarks8' => 'nullable|string|max:255',

            'decision9' => 'nullable|string|max:255',
            'action9' => 'nullable|string|max:255',
            'responsible9' => 'nullable|string|max:255',
            'completion_date9' => 'nullable|date',
            'remarks9' => 'nullable|string|max:255',

            'decision10' => 'nullable|string|max:255',
            'action10' => 'nullable|string|max:255',
            'responsible10' => 'nullable|string|max:255',
            'completion_date10' => 'nullable|date',
            'remarks10' => 'nullable|string|max:255',
        ]);

        $minutes = MrmMinutes::where('id', $id)->first();

        for ($i = 1; $i <= 10; $i++) {
            $minutes->{"decision$i"} = $request->{"decision$i"};
            $minutes->{"action$i"} = $request->{"action$i"};
            $minutes->{"responsible$i"} = $request->{"responsible$i"};
            $minutes->{"completion_date$i"} = $request->{"completion_date$i"};
            $minutes->{"remarks$i"} = $request->{"remarks$i"};
        }

        $minutes->save();

        return back()->with('status', 'Minutes Updated Successfully.');
    }

    public function minutesdelete($id)
    {
        $minutes = MrmMinutes::find($id);
        $minutes->delete();
        return back()->with('status', 'Minutes have been removed.');
    }




    // ====================================  Attendance  ====================================

    public function attendanceview($id)
    {
        $agenda = MrmAgenda::with('attendance')->where('id', $id)->first();
        return view('qa.mrm.attendance.view', ['agenda' => $agenda]);
    }

    public function attendanceform($id)
    {
        $agenda = MrmAgenda::where('id', $id)->first();
        return view('qa.mrm.attendance.add', ['agenda' => $agenda]);
    }

    public function attendancecreate(Request $request)
    {
        // Validation
        $request->validate([
            'name1' => 'required|string|max:255',
            'department1' => 'required|string|max:255',
            'absence1' => 'required|string|max:20',

            'name2' => 'required|string|max:255',
            'department2' => 'required|string|max:255',
            'absence2' => 'required|string|max:20',

            'name3' => 'required|string|max:255',
            'department3' => 'required|string|max:255',
            'absence3' => 'required|string|max:20',

            'name4' => 'required|string|max:255',
            'department4' => 'required|string|max:255',
            'absence4' => 'required|string|max:20',

            'name5' => 'required|string|max:255',
            'department5' => 'required|string|max:255',
            'absence5' => 'required|string|max:20',

            'name6' => 'required|string|max:255',
            'department6' => 'required|string|max:255',
            'absence6' => 'required|string|max:20',

            'name7' => 'required|string|max:255',
            'department7' => 'required|string|max:255',
            'absence7' => 'required|string|max:20',

            'name8' => 'required|string|max:255',
            'department8' => 'required|string|max:255',
            'absence8' => 'required|string|max:20',
        ]);

        $agenda = MrmAgenda::find($request->agenda_id);

        // Check if a reply already exists
        if ($agenda->attendance) {
            return back()->with('error', 'Attendance for this Meeting already exists.');
        }

        // Step 3: Create the attendance record
        MrmAttendance::create([
            'mrm_agenda_id' => $request->agenda_id,
            'name1' => $request->name1,
            'department1' => $request->department1,
            'absence1' => $request->absence1,
            'name2' => $request->name2,
            'department2' => $request->department2,
            'absence2' => $request->absence2,
            'name3' => $request->name3,
            'department3' => $request->department3,
            'absence3' => $request->absence3,
            'name4' => $request->name4,
            'department4' => $request->department4,
            'absence4' => $request->absence4,
            'name5' => $request->name5,
            'department5' => $request->department5,
            'absence5' => $request->absence5,
            'name6' => $request->name6,
            'department6' => $request->department6,
            'absence6' => $request->absence6,
            'name7' => $request->name7,
            'department7' => $request->department7,
            'absence7' => $request->absence7,
            'name8' => $request->name8,
            'department8' => $request->department8,
            'absence8' => $request->absence8,

            'created_at' => now(),
        ]);

        // Step 4: Return back with success message
        return back()->with('status', 'Attendance Sheet has been Created.');
    }


    public function attendanceprepare($id)
    {
        $attendance = MrmAttendance::find($id);

        $attendance->prepared_by = Auth::user()->username;
        $attendance->preparator_designation = Auth::user()->designation;
        $attendance->preparation_time = now();

        $attendance->save();
        return back()->with('status', 'Attendance Sheet has been signed.');
    }


    public function attendanceedit($id)
    {
        $attendance = MrmAttendance::with('agenda')->find($id);
        return view('qa.mrm.attendance.update', ['attendance' => $attendance]);
    }

    public function attendanceupdate(Request $request, $id)
    {

        // Validation for each name and department field dynamically
        $request->validate([
            'name1' => 'required|string|max:255',
            'department1' => 'required|string|max:255',
            'absence1' => 'required|string|max:20',

            'name2' => 'required|string|max:255',
            'department2' => 'required|string|max:255',
            'absence2' => 'required|string|max:20',

            'name3' => 'required|string|max:255',
            'department3' => 'required|string|max:255',
            'absence3' => 'required|string|max:20',

            'name4' => 'required|string|max:255',
            'department4' => 'required|string|max:255',
            'absence4' => 'required|string|max:20',

            'name5' => 'required|string|max:255',
            'department5' => 'required|string|max:255',
            'absence5' => 'required|string|max:20',

            'name6' => 'required|string|max:255',
            'department6' => 'required|string|max:255',
            'absence6' => 'required|string|max:20',

            'name7' => 'required|string|max:255',
            'department7' => 'required|string|max:255',
            'absence7' => 'required|string|max:20',

            'name8' => 'required|string|max:255',
            'department8' => 'required|string|max:255',
            'absence8' => 'required|string|max:20',
        ]);

        // Find attendance record by ID
        $attendance = MrmAttendance::where('id', $id)->first();

        for ($i = 1; $i <= 8; $i++) {
            $attendance->{'name' . $i} = $request->{'name' . $i};
            $attendance->{'department' . $i} = $request->{'department' . $i};
            $attendance->{'absence' . $i} = $request->{'absence' . $i};
        }

        // Save the updated attendance record
        $attendance->save();

        // Redirect back with a success message
        return back()->with('status', 'Attendance Updated Successfully.');
    }


    public function attendancedelete($id)
    {
        $attendance = MrmAttendance::find($id);
        $attendance->delete();
        return back()->with('status', 'Attendance has been removed.');
    }
}

<?php

namespace App\Http\Controllers\Qa\Ia;

use App\Models\IaReport;
use App\Models\IaSchedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InternalAuditController extends Controller
{

    // =================== Internl Audit Schedule ===================

    public function scheduleview()
    {
        $schedule = IaSchedule::get();
        return view('qa.ia.schedule.view', ['schedules' => $schedule]);
    }

    public function scheduleform()
    {
        return view('qa.ia.schedule.add');
    }

    public function schedulecreate(Request $request)
    {

        $request->validate([
            'internal_auditor1' => 'required|string|max:255',
            'internal_auditor2' => 'nullable|string|max:255',  // Nullable if optional
            'doc_date' => 'required|date',

            'department1' => 'required|string|max:255',
            'date_dep1' => 'required|date',
            'time1' => 'required',  // Time validation
            'area1' => 'required',
            'auditee1a' => 'required|string|max:255',
            'auditee1b' => 'nullable|string|max:255',
            'auditee1c' => 'nullable|string|max:255',

            'department2' => 'nullable|string|max:255',
            'date_dep2' => 'nullable|date',
            'time2' => 'nullable',
            'area2' => 'nullable',
            'auditee2a' => 'nullable|string|max:255',
            'auditee2b' => 'nullable|string|max:255',
            'auditee2c' => 'nullable|string|max:255',

            'department3' => 'nullable|string|max:255',
            'date_dep3' => 'nullable|date',
            'time3' => 'nullable',
            'area3' => 'nullable|string|max:255',
            'auditee3a' => 'nullable|string|max:255',
            'auditee3b' => 'nullable|string|max:255',
            'auditee3c' => 'nullable|string|max:255',
        ]);

        IaSchedule::create([
            'internal_auditor1' => $request->internal_auditor1,
            'internal_auditor2' => $request->internal_auditor2,
            'doc_date' => $request->doc_date,

            'department1' => $request->department1,
            'date_dep1' => $request->date_dep1,
            'time1' => $request->time1,
            'area1' => $request->area1,
            'auditee1a' => $request->auditee1a,
            'auditee1b' => $request->auditee1b,
            'auditee1c' => $request->auditee1c,

            'department2' => $request->department2,
            'date_dep2' => $request->date_dep2,
            'time2' => $request->time2,
            'area2' => $request->area2,
            'auditee2a' => $request->auditee2a,
            'auditee2b' => $request->auditee2b,
            'auditee2c' => $request->auditee2c,

            'department3' => $request->department3,
            'date_dep3' => $request->date_dep3,
            'time3' => $request->time3,
            'area3' => $request->area3,
            'auditee3a' => $request->auditee3a,
            'auditee3b' => $request->auditee3b,
            'auditee3c' => $request->auditee3c,

            'created_at' => now(),
        ]);

        return back()->with('status', 'New Internal Audit Schedule has been Created.');
    }


    public function scheduleprepare($id)
    {
        $schedule = IaSchedule::find($id);

        $schedule->prepared_by = Auth::user()->username;
        $schedule->preparator_designation = Auth::user()->designation;
        $schedule->preparation_time = now();

        $schedule->save();
        return back()->with('status', 'Internal Audit Schedule is sent for Approval');
    }


    // public function scheduleapprove($id)
    // {
    //     $schedule = IaSchedule::find($id);

    //     $schedule->prepared_by = Auth::user()->username;
    //     $schedule->preparator_designation = Auth::user()->designation;
    //     $schedule->preparation_time = now();

    //     $schedule->save();
    //     return back()->with('status', 'Internal Audit Schedule has been approved');
    // }

    public function scheduleedit($id)
    {
        $schedule = IaSchedule::find($id);
        return view('qa.ia.schedule.update', ['schedule' => $schedule]);
    }

    public function scheduleupdate(Request $request, $id)
    {
        // Validation rules
        $request->validate([
            'internal_auditor1' => 'required|string|max:255',
            'internal_auditor2' => 'nullable|string|max:255',  // Optional field
            'doc_date' => 'required|date',

            // Validation for Department 1
            'department1' => 'required|string|max:255',
            'date_dep1' => 'required|date',
            'time1' => 'required|string|max:50',  // Time format validation can be adjusted if needed
            'area1' => 'required|string|max:255',
            'auditee1a' => 'required|string|max:255',
            'auditee1b' => 'nullable|string|max:255',
            'auditee1c' => 'nullable|string|max:255',

            // Validation for Department 2
            'department2' => 'nullable|string|max:255',  // Optional
            'date_dep2' => 'nullable|date',
            'time2' => 'nullable|string|max:50',
            'area2' => 'nullable|string|max:255',
            'auditee2a' => 'nullable|string|max:255',
            'auditee2b' => 'nullable|string|max:255',
            'auditee2c' => 'nullable|string|max:255',

            // Validation for Department 3
            'department3' => 'nullable|string|max:255',  // Optional
            'date_dep3' => 'nullable|date',
            'time3' => 'nullable|string|max:50',
            'area3' => 'nullable|string|max:255',
            'auditee3a' => 'nullable|string|max:255',
            'auditee3b' => 'nullable|string|max:255',
            'auditee3c' => 'nullable|string|max:255',
        ]);

        // Find the schedule by id
        $schedule = IaSchedule::where('id', $id)->first();

        // Update fields with request data
        $schedule->internal_auditor1 = $request->internal_auditor1;
        $schedule->internal_auditor2 = $request->internal_auditor2;
        $schedule->doc_date = $request->doc_date;

        // Department 1
        $schedule->department1 = $request->department1;
        $schedule->date_dep1 = $request->date_dep1;
        $schedule->time1 = $request->time1;
        $schedule->area1 = $request->area1;
        $schedule->auditee1a = $request->auditee1a;
        $schedule->auditee1b = $request->auditee1b;
        $schedule->auditee1c = $request->auditee1c;

        // Department 2
        $schedule->department2 = $request->department2;
        $schedule->date_dep2 = $request->date_dep2;
        $schedule->time2 = $request->time2;
        $schedule->area2 = $request->area2;
        $schedule->auditee2a = $request->auditee2a;
        $schedule->auditee2b = $request->auditee2b;
        $schedule->auditee2c = $request->auditee2c;

        // Department 3
        $schedule->department3 = $request->department3;
        $schedule->date_dep3 = $request->date_dep3;
        $schedule->time3 = $request->time3;
        $schedule->area3 = $request->area3;
        $schedule->auditee3a = $request->auditee3a;
        $schedule->auditee3b = $request->auditee3b;
        $schedule->auditee3c = $request->auditee3c;

        // Update timestamp and save the schedule
        $schedule->updated_at = now();
        $schedule->save();

        // Redirect back with status message
        return back()->with('status', 'Internal Audit Schedule has been Updated.');
    }


    public function scheduledelete($id)
    {
        $schedule = IaSchedule::find($id);
        $schedule->delete();
        return back()->with('status', 'Internal Audit Schedule has been removed.');
    }






    // =================== Internl Audit Report ===================

    public function reportview()
    {
        $report = IaReport::get();
        return view('qa.ia.report.view', ['reports' => $report]);
    }

    public function reportform()
    {
        return view('qa.ia.report.add');
    }

    public function reportcreate(Request $request)
    {
        // Get the current year for report_no validation
        $currentYear = date('y');  // e.g., '24' for 2024

        // Define validation rules
        $request->validate([

            'doc_date' => 'required|date',
            'internal_auditor1' => 'required|string|max:255',
            'internal_auditor2' => 'nullable|string|max:255',

            'department1' => 'required|string|max:255',
            'date_dep1' => 'required|date',
            'area1' => 'required|string|max:255',
            'scope1' => 'required|string|max:1000',

            'department2' => 'nullable|string|max:255',
            'date_dep2' => 'nullable|date',
            'area2' => 'nullable|string|max:255',
            'scope2' => 'nullable|string|max:1000',

            'department3' => 'nullable|string|max:255',
            'date_dep3' => 'nullable|date',
            'area3' => 'nullable|string|max:255',
            'scope3' => 'nullable|string|max:1000',

            'summary' => 'required|string|max:5000',
            'deviation_no' => 'nullable|string|max:100',
        ]);

        // Generate the report number
        $currentYear = date('y');  // e.g., '24' for 2024

        // Find the last report created this year
        $lastReport = IaReport::whereYear('created_at', now()->year)
            ->orderBy('id', 'desc')
            ->first();

        // Determine the next incremental number
        if ($lastReport) {
            // Extract the number part of the last report number and increment it
            $lastIncrement = (int)substr($lastReport->report_no, 4, 2);  // Get 'XX' from 'IAR-XX-YY'
            $newIncrement = $lastIncrement + 1;
        } else {
            // If no report exists for the current year, start with '01'
            $newIncrement = 1;
        }

        // Ensure the new increment is formatted as a two-digit number (e.g., '01', '02', etc.)
        $incrementFormatted = str_pad($newIncrement, 2, '0', STR_PAD_LEFT);

        // Combine the parts to form the new report number
        $newReportNo = 'IAR-' . $incrementFormatted . '-' . $currentYear;


        // Create the new report
        IaReport::create([
            'report_no' => $newReportNo,
            'doc_date' => $request->doc_date,

            'internal_auditor1' => $request->internal_auditor1,
            'internal_auditor2' => $request->internal_auditor2,

            'department1' => $request->department1,
            'date_dep1' => $request->date_dep1,
            'area1' => $request->area1,
            'scope1' => $request->scope1,

            'department2' => $request->department2,
            'date_dep2' => $request->date_dep2,
            'area2' => $request->area2,
            'scope2' => $request->scope2,

            'department3' => $request->department3,
            'date_dep3' => $request->date_dep3,
            'area3' => $request->area3,
            'scope3' => $request->scope3,

            'summary' => $request->summary,
            'deviation_no' => $request->deviation_no,

            'created_at' => now(),
        ]);

        // Return with status message
        return back()->with('status', 'New Internal Audit Report has been Created.');
    }


    public function reportprepare($id)
    {
        $report = IaReport::find($id);

        $report->prepared_by = Auth::user()->username;
        $report->preparator_designation = Auth::user()->designation;
        $report->preparation_time = now();

        $report->save();
        return back()->with('status', 'Internal Audit Report is sent for Approval');
    }


    // public function reportapprove($id)
    // {

    // }

    public function reportedit($id)
    {
        $report = IaReport::find($id);
        return view('qa.ia.report.update', ['report' => $report]);
    }

    public function reportupdate(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'report_no' => 'required|string',
            'doc_date' => 'required|date',
            'internal_auditor1' => 'required|string|max:255',
            'internal_auditor2' => 'nullable|string|max:255',

            'department1' => 'required|string|max:255',
            'date_dep1' => 'required|date',
            'area1' => 'required|string|max:255',
            'scope1' => 'required|string|max:1000',

            'department2' => 'nullable|string|max:255',
            'date_dep2' => 'nullable|date',
            'area2' => 'nullable|string|max:255',
            'scope2' => 'nullable|string|max:1000',

            'department3' => 'nullable|string|max:255',
            'date_dep3' => 'nullable|date',
            'area3' => 'nullable|string|max:255',
            'scope3' => 'nullable|string|max:1000',

            'summary' => 'required|string|max:5000',
            'deviation_no' => 'nullable|string|max:100',
        ]);

        // Find the report by its ID
        $report = IaReport::where('id', $id)->first();

        // Update report fields
        $report->report_no = $request->report_no;
        $report->doc_date = $request->doc_date;

        $report->internal_auditor1 = $request->internal_auditor1;
        $report->internal_auditor2 = $request->internal_auditor2;

        $report->department1 = $request->department1;
        $report->date_dep1 = $request->date_dep1;
        $report->area1 = $request->area1;
        $report->scope1 = $request->scope1;

        $report->department2 = $request->department2;
        $report->date_dep2 = $request->date_dep2;
        $report->area2 = $request->area2;
        $report->scope2 = $request->scope2;

        $report->department3 = $request->department3;
        $report->date_dep3 = $request->date_dep3;
        $report->area3 = $request->area3;
        $report->scope3 = $request->scope3;

        $report->summary = $request->summary;
        $report->deviation_no = $request->deviation_no;

        // Set the updated_at field to the current time
        $report->updated_at = now();
        $report->save();

        return back()->with('status', 'Internal Audit Report has been Updated.');
    }


    public function reportdelete($id)
    {
        $report = IaReport::find($id);
        $report->delete();
        return back()->with('status', 'Internal Audit Report has been removed.');
    }
}

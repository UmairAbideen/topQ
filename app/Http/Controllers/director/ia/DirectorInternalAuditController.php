<?php

namespace App\Http\Controllers\director\ia;

use App\Models\IaReport;
use App\Models\IaSchedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class DirectorInternalAuditController extends Controller
{

    // =================== Internl Audit Schedule ===================

    public function scheduleview()
    {
        $schedule = IaSchedule::get();
        return view('director.ia.schedule.view', ['schedules' => $schedule]);
    }

    public function scheduleapprove($id)
    {
        $schedule = IaSchedule::find($id);

        $schedule->approved_by = Auth::user()->username;
        $schedule->approver_designation = Auth::user()->designation;
        $schedule->approval_time = now();

        $schedule->save();
        return back()->with('status', 'Internal Audit Schedule has been approved');
    }






    // =================== Internl Audit Report ===================

    public function reportview()
    {
        $report = IaReport::get();
        return view('director.ia.report.view', ['reports' => $report]);
    }


    public function reportapprove($id)
    {
        $report = IaReport::find($id);

        $report->approved_by = Auth::user()->username;
        $report->approver_designation = Auth::user()->designation;
        $report->approval_time = now();

        $report->save();


        return back()->with('status', 'Internal Audit Report has been approved');
    }
}

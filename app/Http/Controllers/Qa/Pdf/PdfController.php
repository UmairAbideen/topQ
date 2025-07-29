<?php

namespace App\Http\Controllers\Qa\Pdf;


use App\Models\CCM;
use App\Models\CAPA;
use App\Models\Risk;
use App\Models\Recall;
use App\Models\Feedback;
use App\Models\IaReport;
use App\Models\Complaint;
use App\Models\Deviation;
use \App\Models\MrmAgenda;
use App\Models\IaSchedule;
use \App\Models\MrmMinutes;
use App\Models\Obsolescence;
use App\Models\ChangeRequest;
use App\Models\RecallClosure;
use \App\Models\MrmAttendance;
use App\Models\NumberIssuance;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\AnnualTrainingPlan;
use App\Models\NewEmployeeTraining;
use App\Models\TrainingAndFeedback;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class PdfController extends Controller
{
    // Complaint
    public function printComplaint($id)
    {
        $ro = Complaint::find($id);
        $row = Complaint::where('id', $ro->id)->get();
        dd(public_path());

        $pdf = Pdf::loadView('qa.complaint.pdf', compact('row'));

        return $pdf->stream('complaint-' . $ro->complaint_no . '.pdf');
    }

    public function downloadComplaint($id)
    {
        $ro = Complaint::find($id);
        $row = Complaint::where('id', $ro->id)->get();

        $pdf = Pdf::loadView('qa.complaint.pdf', compact('row'));

        return $pdf->download('complaint-' . $ro->complaint_no . '.pdf');
    }

    // Risk
    public function printRisk($id)
    {
        $ro = Risk::find($id);
        $row = Risk::where('id', $ro->id)->get();
        $pdf = Pdf::loadView('qa.risk.pdf', compact('row'));
        return $pdf->stream('risk-' . $ro->qre_no . '.pdf');
    }

    public function downloadRisk($id)
    {
        $ro = Risk::find($id);
        $row = Risk::where('id', $ro->id)->get();
        $pdf = Pdf::loadView('qa.risk.pdf', compact('row'));
        return $pdf->download('risk-' . $ro->qre_no . '.pdf');
    }

    // Feedback
    public function printFeedback($id)
    {
        $row = Feedback::where('id', $id)->get();
        $pdf = Pdf::loadView('qa.feedback.pdf', compact('row'));
        return $pdf->stream('feedback' . time() . '.pdf');
    }
    public function downloadFeedback($id)
    {
        $row = Feedback::where('id', $id)->get();
        $pdf = Pdf::loadView('qa.feedback.pdf', compact('row'));
        return $pdf->download('feedback' . time() . '.pdf');
    }

    // Agenda
    public function printAgenda($id)
    {

        $ro = MrmAgenda::find($id);
        $row = MrmAgenda::where('id', $ro->id)->get();
        $pdf = Pdf::loadView('qa.mrm.agenda.pdf', compact('row'));

        return $pdf->stream('agenda-' . $ro->meeting_no . '.pdf');
    }

    public function downloadAgenda($id)
    {
        $ro = MrmAgenda::find($id);
        $row = MrmAgenda::where('id', $ro->id)->get();
        $pdf = Pdf::loadView('qa.mrm.agenda.pdf', compact('row'));

        return $pdf->download('agenda-' . $ro->meeting_no . '.pdf');
    }

    // Minutes
    public function printMinutes($id)
    {
        $row = MrmMinutes::with('agenda')->find($id);
        $pdf = Pdf::loadView('qa.mrm.minutes.pdf', compact('row'));

        return $pdf->stream('Minutes-' . $row->agenda->meeting_no . '.pdf');
    }

    public function downloadMinutes($id)
    {

        $row = MrmMinutes::with('agenda')->find($id);
        $pdf = Pdf::loadView('qa.mrm.minutes.pdf', compact('row'));

        return $pdf->download('Minutes-' . $row->agenda->meeting_no . '.pdf');
    }

    // Attendance
    public function printAttendance($id)
    {
        $row = MrmAttendance::with('agenda')->find($id);
        $pdf = Pdf::loadView('qa.mrm.attendance.pdf', compact('row'));

        return $pdf->stream('Attendance-' . $row->agenda->meeting_no . '.pdf');
    }

    public function downloadAttendance($id)
    {
        $row = MrmAttendance::with('agenda')->find($id);
        $pdf = Pdf::loadView('qa.mrm.attendance.pdf', compact('row'));

        return $pdf->stream('Attendance-' . $row->agenda->meeting_no . '.pdf');
    }

    // Internal Audit Schedule
    public function printIaSchedule($id)
    {
        $ro = IaSchedule::find($id);
        $row = IaSchedule::where('id', $id)->get();
        $pdf = Pdf::loadView('qa.ia.schedule.pdf', compact('row'));
        return $pdf->stream('Internal Audit Schedule-' . $ro->doc_date . '.pdf');
    }

    public function downloadIaSchedule($id)
    {
        $ro = IaSchedule::find($id);
        $row = IaSchedule::where('id', $id)->get();
        $pdf = Pdf::loadView('qa.ia.schedule.pdf', compact('row'));
        return $pdf->download('Internal Audit Schedule-' . $ro->doc_date . '.pdf');
    }

    // Internal Audit Report
    public function printIaReport($id)
    {
        $ro = IaReport::find($id);
        $row = IaReport::where('id', $id)->get();
        $pdf = Pdf::loadView('director.ia.report.pdf', compact('row'));
        return $pdf->stream('Internal Audit Report-' . $ro->doc_date . '.pdf');
    }

    public function downloadIaReport($id)
    {
        $ro = IaReport::find($id);
        $row = IaReport::where('id', $id)->get();
        $pdf = Pdf::loadView('director.ia.report.pdf', compact('row'));
        return $pdf->download('Internal Audit Report-' . $ro->doc_date . '.pdf');
    }


    // Recall Information
    public function printRecallInfo($id)
    {
        $ro = Recall::find($id);
        $row = Recall::where('id', $id)->get();
        $pdf = Pdf::loadView('qa.recall.information.pdf', compact('row'));
        return $pdf->stream('Recall Information Form-' . $ro->receipt_date . '.pdf');
    }

    public function downloadRecallInfo($id)
    {
        $ro = Recall::find($id);
        $row = Recall::where('id', $id)->get();
        $pdf = Pdf::loadView('qa.recall.information.pdf', compact('row'));
        return $pdf->download('Recall Information Form-' . $ro->receipt_date . '.pdf');
    }


    // Recall Closure
    public function printRecallClosure($id)
    {
        $ro = RecallClosure::find($id);
        $row = RecallClosure::where('id', $id)->get();
        $pdf = Pdf::loadView('qa.recall.closure.pdf', compact('row'));
        return $pdf->stream('Recall Closure Form-' . $ro->approver_signtime . '.pdf');
    }

    public function downloadRecallClosure($id)
    {
        $ro = RecallClosure::find($id);
        $row = RecallClosure::where('id', $id)->get();
        $pdf = Pdf::loadView('qa.recall.closure.pdf', compact('row'));
        return $pdf->download('Recall Closure Form-' . $ro->approver_signtimessss . '.pdf');
    }



    // Change Contorl Management
    public function printForm($id)
    {
        $ro = CCM::find($id);
        $row = CCM::where('id', $id)->get();
        $pdf = Pdf::loadView('qa.ccm.pdf', compact('row'));
        return $pdf->stream('Change Control Form-' . $ro->closer_signtime . '.pdf');
    }

    public function downloadForm($id)
    {
        $ro = CCM::find($id);
        $row = CCM::where('id', $id)->get();
        $pdf = Pdf::loadView('qa.ccm.pdf', compact('row'));
        return $pdf->download('Change Control Form-' . $ro->closer_signtime . '.pdf');
    }


    // Deviation Management
    public function printDeviation($id)
    {
        $ro = Deviation::find($id);
        $row = Deviation::where('id', $id)->get();
        $pdf = Pdf::loadView('qa.deviation.pdf', compact('row'));
        return $pdf->stream('Deviation Approval Form-' . $ro->closer_signtime . '.pdf');
    }

    public function downloadDeviation($id)
    {
        $ro = Deviation::find($id);
        $row = Deviation::where('id', $id)->get();
        $pdf = Pdf::loadView('qa.deviation.pdf', compact('row'));
        return $pdf->download('Deviation Approval Form-' . $ro->closer_signtime . '.pdf');
    }


    // CAPA
    public function printCapa($id)
    {
        $ro = CAPA::find($id);
        $row = CAPA::where('id', $id)->get();
        $pdf = Pdf::loadView('qa.capa.pdf', compact('row'));
        return $pdf->stream('CAPA Form-' . $ro->closer_signtime . '.pdf');
    }

    public function downloadCapa($id)
    {
        $ro = CAPA::find($id);
        $row = CAPA::where('id', $id)->get();
        $pdf = Pdf::loadView('qa.capa.pdf', compact('row'));
        return $pdf->download('CAPA Form-' . $ro->closer_signtime . '.pdf');
    }

    // Training Attendance
    public function printTrainingAttendance($id)
    {
        $ro = TrainingAndFeedback::find($id);
        $row = TrainingAndFeedback::where('id', $id)->get();
        $pdf = Pdf::loadView('qa.training.attendance.pdf', compact('row'));
        return $pdf->stream('Attendance Form-' . $ro->date . '.pdf');
    }

    public function downloadTrainingAttendance($id)
    {
        $ro = TrainingAndFeedback::find($id);
        $row = TrainingAndFeedback::where('id', $id)->get();
        $pdf = Pdf::loadView('qa.training.attendance.pdf', compact('row'));
        return $pdf->download('Attendance Form-' . $ro->date . '.pdf');
    }


    // Training Plan
    public function printTrainingPlan($id)
    {
        $ro = AnnualTrainingPlan::find($id);
        $row = AnnualTrainingPlan::where('id', $id)->get();
        $pdf = Pdf::loadView('qa.training.annual.pdf', compact('row'));
        return $pdf->stream('Annual Training Plan-' . $ro->created_at . '.pdf');
    }

    public function downloadTrainingPlan($id)
    {
        $ro = AnnualTrainingPlan::find($id);
        $row = AnnualTrainingPlan::where('id', $id)->get();
        $pdf = Pdf::loadView('qa.training.annual.pdf', compact('row'));
        return $pdf->download('Annual Training Plan-' . $ro->created_at . '.pdf');
    }



    // New Employee Training Plan
    public function printNewEmployeeTraining($id)
    {
        $ro = NewEmployeeTraining::find($id);
        $row = NewEmployeeTraining::where('id', $id)->get();
        $pdf = Pdf::loadView('qa.training.new-employee.pdf', compact('row'));
        return $pdf->stream('New Employee Training Plan-' . $ro->created_at . '.pdf');
    }

    public function downloadNewEmployeeTraining($id)
    {
        $ro = NewEmployeeTraining::find($id);
        $row = NewEmployeeTraining::where('id', $id)->get();
        $pdf = Pdf::loadView('qa.training.new-employee.pdf', compact('row'));
        return $pdf->download('New Employee Training Plan-' . $ro->created_at . '.pdf');
    }


    //============================  Document Control ==================================


    // Document Change Request
    public function printChange($id)
    {
        $ro = ChangeRequest::find($id);
        $row = ChangeRequest::where('id', $id)->get();
        $pdf = Pdf::loadView('qa.doc-control.change.pdf', compact('row'));
        return $pdf->stream('Doc. Change Request Form-' . $ro->created_at . '.pdf');
    }

    public function downloadChange($id)
    {
        $ro = ChangeRequest::find($id);
        $row = ChangeRequest::where('id', $id)->get();
        $pdf = Pdf::loadView('qa.doc-control.change.pdf', compact('row'));
        return $pdf->download('Doc. Change Request Form-' . $ro->created_at . '.pdf');
    }



    // Number Issuance
    public function printIssue($id)
    {
        $ro = NumberIssuance::find($id);
        $row = NumberIssuance::where('id', $id)->get();
        $pdf = Pdf::loadView('qa.doc-control.issue.pdf', compact('row'));
        return $pdf->stream('Doc. No. Issuance Form-' . $ro->created_at . '.pdf');
    }

    public function downloadIssue($id)
    {
        $ro = NumberIssuance::find($id);
        $row = NumberIssuance::where('id', $id)->get();
        $pdf = Pdf::loadView('qa.doc-control.issue.pdf', compact('row'));
        return $pdf->download('Doc. No. Issuance Form-' . $ro->created_at . '.pdf');
    }



    // Number Issuance
    public function printObsolescence($id)
    {
        $ro = Obsolescence::find($id);
        $row = Obsolescence::where('id', $id)->get();
        $pdf = Pdf::loadView('qa.doc-control.obsolescence.pdf', compact('row'));
        return $pdf->stream('Doc. Obsolescence Form-' . $ro->created_at . '.pdf');
    }

    public function downloadObsolescence($id)
    {
        $ro = Obsolescence::find($id);
        $row = Obsolescence::where('id', $id)->get();
        $pdf = Pdf::loadView('qa.doc-control.obsolescence.pdf', compact('row'));
        return $pdf->download('Doc. Obsolescence Form-' . $ro->created_at . '.pdf');
    }
}

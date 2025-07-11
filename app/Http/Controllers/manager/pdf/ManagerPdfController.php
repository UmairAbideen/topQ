<?php

namespace App\Http\Controllers\manager\pdf;

use App\Models\CCM;
use App\Models\CAPA;
use App\Models\Risk;
use App\Models\Feedback;
use App\Models\Complaint;
use App\Models\Deviation;
use App\Models\Obsolescence;
use App\Models\ChangeRequest;
use App\Models\MrmAttendance;
use App\Models\NumberIssuance;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\AnnualTrainingPlan;
use App\Models\NewEmployeeTraining;
use App\Models\TrainingAndFeedback;
use App\Http\Controllers\Controller;

class ManagerPdfController extends Controller
{

    // Complaint
    public function printComplaint($id)
    {
        $ro = Complaint::find($id);
        $row = Complaint::where('id', $ro->id)->get();

        $pdf = Pdf::loadView('manager.complaint.pdf', compact('row'));
        return $pdf->stream('complaint-' . $ro->complaint_no . '.pdf');
    }

    public function downloadComplaint($id)
    {
        $ro = Complaint::find($id);
        $row = Complaint::where('id', $ro->id)->get();

        $pdf = Pdf::loadView('manager.complaint.pdf', compact('row'));
        return $pdf->download('complaint-' . $ro->complaint_no . '.pdf');
    }


    // Feedback
    public function printFeedback($id)
    {
        $row = Feedback::where('id', $id)->get();
        $pdf = Pdf::loadView('manager.feedback.pdf', compact('row'));
        return $pdf->stream('feedback' . time() . '.pdf');
    }
    public function downloadFeedback($id)
    {
        $row = Feedback::where('id', $id)->get();
        $pdf = Pdf::loadView('manager.feedback.pdf', compact('row'));
        return $pdf->download('feedback' . time() . '.pdf');
    }


    // Risk
    public function printRisk($id)
    {
        $ro = Risk::find($id);
        $row = Risk::where('id', $ro->id)->get();
        $pdf = Pdf::loadView('manager.risk.pdf', compact('row'));
        return $pdf->stream('risk-' . $ro->qre_no . '.pdf');
    }

    public function downloadRisk($id)
    {
        $ro = Risk::find($id);
        $row = Risk::where('id', $ro->id)->get();
        $pdf = Pdf::loadView('manager.risk.pdf', compact('row'));
        return $pdf->download('risk-' . $ro->qre_no . '.pdf');
    }



    // Attendance
    public function printAttendance($id)
    {
        // $ro = MrmAttendance::find($id);
        // dd($ro);
        // $row = MrmAttendance::where('id', $ro->id)->get();
        // $pdf = Pdf::loadView('manager.mrm.attendance.pdf', compact('row'));

        // return $pdf->stream('attendance-' . $ro->meeting_no . '.pdf');


        $row = MrmAttendance::with('agenda')->find($id);
        $pdf = Pdf::loadView('manager.mrm.attendance.pdf', compact('row'));

        return $pdf->stream('Attendance-' . $row->agenda->meeting_no . '.pdf');
    }

    // public function downloadAttendance($id)
    // {
    //     $ro = MrmAttendance::find($id);
    //     $row = MrmAttendance::where('id', $ro->id)->get();
    //     $pdf = Pdf::loadView('manager.mrm.attendance.pdf', compact('row'));

    //     return $pdf->download('attendance-' . $ro->meeting_no . '.pdf');
    // }

    // Change Contorl Management
    public function printForm($id)
    {
        $ro = CCM::find($id);
        $row = CCM::where('id', $id)->get();
        $pdf = Pdf::loadView('manager.ccm.pdf', compact('row'));
        return $pdf->stream('Change Contorl Form-' . $ro->closer_signtime . '.pdf');
    }

    public function downloadForm($id)
    {
        $ro = CCM::find($id);
        $row = CCM::where('id', $id)->get();
        $pdf = Pdf::loadView('manager.ccm.pdf', compact('row'));
        return $pdf->download('Change Contorl Form-' . $ro->closer_signtime . '.pdf');
    }


    // Deviation Management
    public function printDeviation($id)
    {
        $ro = Deviation::find($id);
        $row = Deviation::where('id', $id)->get();
        $pdf = Pdf::loadView('manager.deviation.pdf', compact('row'));
        return $pdf->stream('Deviation Approval Form-' . $ro->closer_signtime . '.pdf');
    }

    public function downloadDeviation($id)
    {
        $ro = Deviation::find($id);
        $row = Deviation::where('id', $id)->get();
        $pdf = Pdf::loadView('manager.deviation.pdf', compact('row'));
        return $pdf->download('Deviation Approval Form-' . $ro->closer_signtime . '.pdf');
    }


    // CAPA
    public function printCapa($id)
    {
        $ro = CAPA::find($id);
        $row = CAPA::where('id', $id)->get();
        $pdf = Pdf::loadView('manager.capa.pdf', compact('row'));
        return $pdf->stream('CAPA Form-' . $ro->closer_signtime . '.pdf');
    }

    public function downloadCapa($id)
    {
        $ro = CAPA::find($id);
        $row = CAPA::where('id', $id)->get();
        $pdf = Pdf::loadView('manager.capa.pdf', compact('row'));
        return $pdf->download('CAPA Form-' . $ro->closer_signtime . '.pdf');
    }


    // Training Attendance
    public function printTrainingAttendance($id)
    {
        $ro = TrainingAndFeedback::find($id);
        $row = TrainingAndFeedback::where('id', $id)->get();
        $pdf = Pdf::loadView('manager.training.attendance.pdf', compact('row'));
        return $pdf->stream('Attendance Form-' . $ro->date . '.pdf');
    }

    public function downloadTrainingAttendance($id)
    {
        $ro = TrainingAndFeedback::find($id);
        $row = TrainingAndFeedback::where('id', $id)->get();
        $pdf = Pdf::loadView('manager.training.attendance.pdf', compact('row'));
        return $pdf->download('Attendance Form-' . $ro->date . '.pdf');
    }

    // Training Plan
    public function printTrainingPlan($id)
    {
        $ro = AnnualTrainingPlan::find($id);
        $row = AnnualTrainingPlan::where('id', $id)->get();
        $pdf = Pdf::loadView('manager.training.annual.pdf', compact('row'));
        return $pdf->stream('Annual Training Plan-' . $ro->created_at . '.pdf');
    }

    public function downloadTrainingPlan($id)
    {
        $ro = AnnualTrainingPlan::find($id);
        $row = AnnualTrainingPlan::where('id', $id)->get();
        $pdf = Pdf::loadView('manager.training.annual.pdf', compact('row'));
        return $pdf->download('Annual Training Plan-' . $ro->created_at . '.pdf');
    }

    // New Employee Training Plan
    public function printNewEmployeeTraining($id)
    {
        $ro = NewEmployeeTraining::find($id);
        $row = NewEmployeeTraining::where('id', $id)->get();
        $pdf = Pdf::loadView('manager.training.new-employee.pdf', compact('row'));
        return $pdf->stream('New Employee Training Plan-' . $ro->created_at . '.pdf');
    }

    public function downloadNewEmployeeTraining($id)
    {
        $ro = NewEmployeeTraining::find($id);
        $row = NewEmployeeTraining::where('id', $id)->get();
        $pdf = Pdf::loadView('manager.training.new-employee.pdf', compact('row'));
        return $pdf->download('New Employee Training Plan-' . $ro->created_at . '.pdf');
    }



    //============================  Document Control ==================================

    // Document Change Request
    public function printChange($id)
    {
        $ro = ChangeRequest::find($id);
        $row = ChangeRequest::where('id', $id)->get();
        $pdf = Pdf::loadView('manager.doc-control.change.pdf', compact('row'));
        return $pdf->stream('Doc. Change Request Form-' . $ro->created_at . '.pdf');
    }

    public function downloadChange($id)
    {
        $ro = ChangeRequest::find($id);
        $row = ChangeRequest::where('id', $id)->get();
        $pdf = Pdf::loadView('manager.doc-control.change.pdf', compact('row'));
        return $pdf->download('Doc. Change Request Form-' . $ro->created_at . '.pdf');
    }



    // Number Issuance
    public function printIssue($id)
    {
        $ro = NumberIssuance::find($id);
        $row = NumberIssuance::where('id', $id)->get();
        $pdf = Pdf::loadView('manager.doc-control.issue.pdf', compact('row'));
        return $pdf->stream('Doc. No. Issuance Form-' . $ro->created_at . '.pdf');
    }

    public function downloadIssue($id)
    {
        $ro = NumberIssuance::find($id);
        $row = NumberIssuance::where('id', $id)->get();
        $pdf = Pdf::loadView('manager.doc-control.issue.pdf', compact('row'));
        return $pdf->download('Doc. No. Issuance Form-' . $ro->created_at . '.pdf');
    }



    // Number Obsolescence
    public function printObsolescence($id)
    {
        $ro = Obsolescence::find($id);
        $row = Obsolescence::where('id', $id)->get();
        $pdf = Pdf::loadView('manager.doc-control.obsolescence.pdf', compact('row'));
        return $pdf->stream('Doc. Obsolescence Form-' . $ro->created_at . '.pdf');
    }

    public function downloadObsolescence($id)
    {
        $ro = Obsolescence::find($id);
        $row = Obsolescence::where('id', $id)->get();
        $pdf = Pdf::loadView('manager.doc-control.obsolescence.pdf', compact('row'));
        return $pdf->download('Doc. Obsolescence Form-' . $ro->created_at . '.pdf');
    }
}

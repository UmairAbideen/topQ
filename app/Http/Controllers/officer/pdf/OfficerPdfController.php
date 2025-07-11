<?php

namespace App\Http\Controllers\officer\pdf;

use App\Models\CCM;
use App\Models\CAPA;
use App\Models\Risk;
use App\Models\Deviation;
use App\Models\Obsolescence;
use App\Models\ChangeRequest;
use App\Models\NumberIssuance;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\TrainingAndFeedback;
use App\Http\Controllers\Controller;

class OfficerPdfController extends Controller
{

    // Risk
    public function printRisk($id)
    {
        $ro = Risk::find($id);
        $row = Risk::where('id', $ro->id)->get();
        $pdf = Pdf::loadView('officer.risk.pdf', compact('row'));
        return $pdf->stream('risk-' . $ro->qre_no . '.pdf');
    }

    public function downloadRisk($id)
    {
        $ro = Risk::find($id);
        $row = Risk::where('id', $ro->id)->get();
        $pdf = Pdf::loadView('officer.risk.pdf', compact('row'));
        return $pdf->download('risk-' . $ro->qre_no . '.pdf');
    }

    // Change Contorl Management
    public function printForm($id)
    {
        $ro = CCM::find($id);
        $row = CCM::where('id', $id)->get();
        $pdf = Pdf::loadView('officer.ccm.pdf', compact('row'));
        return $pdf->stream('Change Contorl Form-' . $ro->closer_signtime . '.pdf');
    }

    public function downloadForm($id)
    {
        $ro = CCM::find($id);
        $row = CCM::where('id', $id)->get();
        $pdf = Pdf::loadView('officer.ccm.pdf', compact('row'));
        return $pdf->download('Change Contorl Form-' . $ro->closer_signtime . '.pdf');
    }


    // Deviation Management
    public function printDeviation($id)
    {
        $ro = Deviation::find($id);
        $row = Deviation::where('id', $id)->get();
        $pdf = Pdf::loadView('officer.deviation.pdf', compact('row'));
        return $pdf->stream('Deviation Approval Form-' . $ro->closer_signtime . '.pdf');
    }

    public function downloadDeviation($id)
    {
        $ro = Deviation::find($id);
        $row = Deviation::where('id', $id)->get();
        $pdf = Pdf::loadView('officer.deviation.pdf', compact('row'));
        return $pdf->download('Deviation Approval Form-' . $ro->closer_signtime . '.pdf');
    }


    // CAPA
    public function printCapa($id)
    {
        $ro = CAPA::find($id);
        $row = CAPA::where('id', $id)->get();
        $pdf = Pdf::loadView('officer.capa.pdf', compact('row'));
        return $pdf->stream('CAPA Form-' . $ro->closer_signtime . '.pdf');
    }

    public function downloadCapa($id)
    {
        $ro = CAPA::find($id);
        $row = CAPA::where('id', $id)->get();
        $pdf = Pdf::loadView('officer.capa.pdf', compact('row'));
        return $pdf->download('CAPA Form-' . $ro->closer_signtime . '.pdf');
    }


    // Training Attendance
    public function printTrainingAttendance($id)
    {
        $ro = TrainingAndFeedback::find($id);
        $row = TrainingAndFeedback::where('id', $id)->get();
        $pdf = Pdf::loadView('officer.training.attendance.pdf', compact('row'));
        return $pdf->stream('Attendance Form-' . $ro->date . '.pdf');
    }

    public function downloadTrainingAttendance($id)
    {
        $ro = TrainingAndFeedback::find($id);
        $row = TrainingAndFeedback::where('id', $id)->get();
        $pdf = Pdf::loadView('officer.training.attendance.pdf', compact('row'));
        return $pdf->download('Attendance Form-' . $ro->date . '.pdf');
    }




    //============================  Document Control ==================================


    // Document Change Request
    public function printChange($id)
    {
        $ro = ChangeRequest::find($id);
        $row = ChangeRequest::where('id', $id)->get();
        $pdf = Pdf::loadView('officer.doc-control.change.pdf', compact('row'));
        return $pdf->stream('Doc. Change Request Form-' . $ro->created_at . '.pdf');
    }

    public function downloadChange($id)
    {
        $ro = ChangeRequest::find($id);
        $row = ChangeRequest::where('id', $id)->get();
        $pdf = Pdf::loadView('officer.doc-control.change.pdf', compact('row'));
        return $pdf->download('Doc. Change Request Form-' . $ro->created_at . '.pdf');
    }



    // Number Issuance
    public function printIssue($id)
    {
        $ro = NumberIssuance::find($id);
        $row = NumberIssuance::where('id', $id)->get();
        $pdf = Pdf::loadView('officer.doc-control.issue.pdf', compact('row'));
        return $pdf->stream('Doc. No. Issuance Form-' . $ro->created_at . '.pdf');
    }

    public function downloadIssue($id)
    {
        $ro = NumberIssuance::find($id);
        $row = NumberIssuance::where('id', $id)->get();
        $pdf = Pdf::loadView('officer.doc-control.issue.pdf', compact('row'));
        return $pdf->download('Doc. No. Issuance Form-' . $ro->created_at . '.pdf');
    }


    // Number Obsolescence
    public function printObsolescence($id)
    {
        $ro = Obsolescence::find($id);
        $row = Obsolescence::where('id', $id)->get();
        $pdf = Pdf::loadView('officer.doc-control.obsolescence.pdf', compact('row'));
        return $pdf->stream('Doc. Obsolescence Form-' . $ro->created_at . '.pdf');
    }

    public function downloadObsolescence($id)
    {
        $ro = Obsolescence::find($id);
        $row = Obsolescence::where('id', $id)->get();
        $pdf = Pdf::loadView('officer.doc-control.obsolescence.pdf', compact('row'));
        return $pdf->download('Doc. Obsolescence Form-' . $ro->created_at . '.pdf');
    }

}

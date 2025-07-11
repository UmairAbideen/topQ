<?php

namespace App\Http\Controllers\director\document_control;

use App\Models\QaSOP;
use App\Models\ScSOP;
use App\Models\TsSOP;
use App\Models\Policy;
use App\Models\Obsolescence;
use Illuminate\Http\Request;
use App\Models\ChangeRequest;
use App\Models\NumberIssuance;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DirectorDocumentationController extends Controller
{


    // ==================== Change Request ===========================

    public function changeView()
    {
        $change = ChangeRequest::where('department', 'QA')->get();
        return view('director.doc-control.change.view', ['changes' => $change]);
    }

    public function changeApprove($id)
    {
        $change = ChangeRequest::find($id);

        $change->approver_name = Auth::user()->username;
        $change->approver_department = Auth::user()->department;
        $change->approver_designation = Auth::user()->designation;
        $change->approver_signtime = now();

        $change->save();
        return back()->with('status', 'Document Change Request is Approved.');
    }

    // ==================== TS ===========================
    public function TschangeView()
    {
        $change = ChangeRequest::where('department', 'TS')->get();
        return view('director.doc-control.change.ts.view', ['changes' => $change]);
    }

    // ==================== SC ===========================
    public function ScchangeView()
    {
        $change = ChangeRequest::where('department', 'SC')->get();
        return view('director.doc-control.change.sc.view', ['changes' => $change]);
    }








    // ==================== Issuance ===========================

    public function issueView()
    {
        $issue = NumberIssuance::where('department', 'QA')->get();
        return view('director.doc-control.issue.view', ['issues' => $issue]);
    }


    public function issueApprove($id)
    {
        $issue = NumberIssuance::find($id);

        $issue->approver_name = Auth::user()->username;
        $issue->approver_department = Auth::user()->department;
        $issue->approver_designation = Auth::user()->designation;
        $issue->approver_signtime = now();

        $issue->save();
        return back()->with('status', 'Document Number Issuance Request is approved.');
    }


    // ==================== TS ===========================

    public function TsissueView()
    {
        $issue = NumberIssuance::where('department', 'TS')->get();
        return view('director.doc-control.issue.ts.view', ['issues' => $issue]);
    }


    // ==================== SC ===========================

    public function ScissueView()
    {
        $issue = NumberIssuance::where('department', 'SC')->get();
        return view('director.doc-control.issue.sc.view', ['issues' => $issue]);
    }








    // ==================== Obsolescence ===========================

    public function obsolescenceView()
    {
        $ob = Obsolescence::where('department', 'QA')->get();
        return view('director.doc-control.obsolescence.view', ['obs' => $ob]);
    }


    // Approve Obsolescence
    public function obsolescenceApprove($id)
    {
        $obs = Obsolescence::find($id);

        $obs->approver_name = Auth::user()->username;
        $obs->approver_department = Auth::user()->department;
        $obs->approver_designation = Auth::user()->designation;
        $obs->approver_signtime = now();

        $obs->save();

        return back()->with('status', 'Obsolescence request has been approved.');
    }


    // ==================== TS ===========================

    public function TsobsolescenceView()
    {
        $ob = Obsolescence::where('department', 'TS')->get();
        return view('director.doc-control.obsolescence.ts.view', ['obs' => $ob]);
    }


    // ==================== SC ===========================

    public function ScobsolescenceView()
    {
        $ob = Obsolescence::where('department', 'SC')->get();
        return view('director.doc-control.obsolescence.sc.view', ['obs' => $ob]);
    }







    // ==================== Master Index - Internal ===========================

    public function internalView()
    {
        $policy = Policy::where('department', 'QA')->get();
        $sop = QaSOP::where('department', 'QA')->get();
        return view('director.doc-control.mi-internal.view', ['policies' => $policy, 'sops' => $sop,]);
    }

    // ==================== TS ===========================

    public function TsinternalView()
    {
        $sop = TsSOP::where('department', 'TS')->get();
        return view('director.doc-control.mi-internal.ts.view', ['sops' => $sop,]);
    }

    // ==================== SC ===========================
    public function ScinternalView()
    {
        $sop = ScSOP::where('department', 'SC')->get();
        return view('director.doc-control.mi-internal.sc.view', ['sops' => $sop,]);
    }

}

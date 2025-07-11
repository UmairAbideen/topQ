<?php

namespace App\Http\Controllers\director\documents;

use App\Models\QaSOP;
use App\Models\ScSOP;
use App\Models\TsSOP;
use App\Models\Policy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DirectorDocumentController extends Controller
{
    // =========================== Policy ========================================
    public function policyview()
    {
        $policy = Policy::get();
        return view('director.documents.policy.view', ['policies' => $policy]);
    }



    // =============================================== SOPs ======================================================

    // ======================= QA ==============================

    public function sopview()
    {
        $sops = QaSOP::all();
        return view('director.documents.sop.qa.view', ['sops' => $sops]);
    }


    // ======================= TS ==============================

    public function tssopview()
    {
        $sops = TsSOP::all();
        return view('director.documents.sop.ts.view', ['sops' => $sops]);
    }



    // ======================= SC ==============================

    public function scsopview()
    {
        $sops = ScSOP::all();
        return view('director.documents.sop.sc.view', ['sops' => $sops]);
    }
}

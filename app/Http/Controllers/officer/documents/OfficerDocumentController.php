<?php

namespace App\Http\Controllers\officer\documents;

use App\Models\ScSOP;
use App\Models\TsSOP;
use App\Models\Policy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfficerDocumentController extends Controller
{
    // =============================================== SOPs ======================================================

    // ======================= TS ==============================

    public function tssopview()
    {
        $sops = TsSOP::all();
        $department = auth()->user()->department;

        return view('officer.documents.sop.ts.view', [
            'sops' => $sops,
            'department' => $department,
        ]);
    }


    // ======================= SC ==============================

    public function scsopview()
    {
        $sops = ScSOP::all();
        $department = auth()->user()->department;

        return view('officer.documents.sop.sc.view', [
            'sops' => $sops,
            'department' => $department,
        ]);
    }
}

<?php

namespace App\Http\Controllers\director\complaint;

use App\Models\Complaint;
use App\Http\Controllers\Controller;


class DirectorComplaintController extends Controller
{
    public function complaint()
    {
        $complaint = Complaint::get();

        return view('director.complaint.view', ['complaints' => $complaint]);
    }
}

<?php

namespace App\Http\Controllers\manager\feedback;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManagerFeedbackController extends Controller
{


    // ========================  TS   ===============================================

    public function tsfeedback()
    {
        $feedback = Feedback::whereNotNull('responsetocomplaints_ts')
            ->whereNotNull('callattendedinscheduledtime_ts')
            ->whereNotNull('economicalsolution_ts')
            ->whereNotNull('overallperformance_ts')
            ->whereNotNull('remarks_ts')
            ->get();

        return view('manager.feedback.view', ['feedbacks' => $feedback]);
    }



    public function insfeedback()
    {
        $feedback = Feedback::whereNotNull('productquality_ins')
            ->whereNotNull('economicalsolution_ins')
            ->whereNotNull('overallservices_ins')
            ->whereNotNull('responsetocomplaints_ins')
            ->whereNotNull('remarks_ins')
            ->get();

        return view('manager.feedback.view', ['feedbacks' => $feedback]);
    }



    public function iolfeedback()
    {
        $feedback = Feedback::whereNotNull('productquality_iol')
            ->whereNotNull('economicalsolution_iol')
            ->whereNotNull('overallservices_iol')
            ->whereNotNull('responsetocomplaints_iol')
            ->whereNotNull('remarks_iol')
            ->get();

        return view('manager.feedback.view', ['feedbacks' => $feedback]);
    }



    public function defeedback()
    {
        $feedback = Feedback::whereNotNull('productquality_de')
            ->whereNotNull('economicalsolution_de')
            ->whereNotNull('overallservices_de')
            ->whereNotNull('responsetocomplaints_de')
            ->whereNotNull('remarks_de')
            ->get();

        return view('manager.feedback.view', ['feedbacks' => $feedback]);
    }
}

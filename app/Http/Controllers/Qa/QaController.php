<?php

namespace App\Http\Controllers\Qa;

use App\Models\Risk;
use App\Models\User;
use App\Models\QaSOP;
use App\Models\Policy;
use App\Models\Feedback;
use App\Models\Complaint;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class QaController extends Controller
{
    public function dashboard()
    {

        // ================================= Cards =================================
        $policy = Policy::get();
        $sops = QaSOP::all();
        $sopCount = 23;
        $previousSopCount = 23;
        $sopChangePercentage = (($sopCount - $previousSopCount) / $previousSopCount) * 100;

        $risks = Risk::all();
        $riskCount = $risks->count();
        $previousRiskCount = 2;
        $riskChangePercentage = (($riskCount - $previousRiskCount) / $previousRiskCount) * 100;

        $users = User::all();
        $userCount = $users->count();
        $previousUserCount = 3;
        $userChangePercentage = (($userCount - $previousUserCount) / $previousUserCount) * 100;


        // ================================= Graphs =================================

        $feedbacks = Feedback::all();
        $feedbackCount = $feedbacks->count();
        $previousFeedbackCount = 3;
        $feedbackChangePercentage = (($feedbackCount - $previousFeedbackCount) / $previousFeedbackCount) * 100;

        $counts = [
            'Excellent' => 0,
            'Good' => 0,
            'Average' => 0,
            'Low' => 0,
            'Poor' => 0,
        ];

        foreach ($feedbacks as $entry) {
            $columns = [
                'productquality_ins', 'economicalsolution_ins', 'overallservices_ins', 'responsetocomplaints_ins',
                'productquality_iol', 'economicalsolution_iol', 'overallservices_iol', 'responsetocomplaints_iol',
                'productquality_de', 'economicalsolution_de', 'overallservices_de', 'responsetocomplaints_de',
            ];

            foreach ($columns as $column) {
                if (isset($entry->$column) && isset($counts[$entry->$column])) {
                    $counts[$entry->$column]++;
                }
            }
        }


        $compalints = Complaint::all();
        $complaintCount = $compalints->count();
        $previousComplaintCount = 3;
        $complaintChangePercentage = (($complaintCount - $previousComplaintCount) / $previousComplaintCount) * 100;

        $start_date = Carbon::create(2023, 12, 1);
        $end_date = Carbon::create(2024, 5, 31);

        $complaint_counts = [];

        // Loop through each month in the period and count complaints
        for ($month = clone $start_date; $month->lte($end_date); $month->addMonth()) {

            $count = Complaint::whereYear('receipt_date', $month->year)
                ->whereMonth('receipt_date', $month->month)
                ->count();

            $complaint_counts[] = $count;
        }

        return view('qa.dashboard', [
            'policies' => $policy,
            'sops' => $sops,
            'sopCount' => $sopCount,
            'sopChangePercentage' => $sopChangePercentage,
            'riskCount' => $riskCount,
            'riskChangePercentage' => $riskChangePercentage,
            'userCount' => $userCount,
            'userChangePercentage' => $userChangePercentage,
            'feedback' => $counts,
            'feedbackChangePercentage' => $feedbackChangePercentage,
            'complaintCount' => $complaint_counts,
            'complaintChangePercentage' => $complaintChangePercentage,
        ]);
    }
}

<?php

namespace App\Http\Controllers\director\feedback;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DirectorFeedbackController extends Controller
{
    public function feedback()
    {
        $feedback = Feedback::get();
        return view('director.feedback.view', ['feedbacks' => $feedback]);
    }
}

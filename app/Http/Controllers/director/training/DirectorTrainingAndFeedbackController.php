<?php

namespace App\Http\Controllers\director\training;

use App\Models\AnnualTrainingPlan;
use App\Models\NewEmployeeTraining;
use App\Models\TrainingAndFeedback;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DirectorTrainingAndFeedbackController extends Controller
{

    // ====================================  Attendance  ====================================

    // =========  QA  ===========

    public function triningAttendanceView()
    {
        $userName = Auth::user()->username;
        $training = TrainingAndFeedback::get();

        return view('director.training.attendance.view', ['training' => $training, 'username' => $userName]);
    }

    // =========  TS  ===========

    public function TsTriningAttendanceView()
    {
        $training = TrainingAndFeedback::where('trainer_department', 'TS')->get();
        $userName = Auth::user()->username;

        return view('director.training.attendance.ts.view', ['training' => $training, 'username' => $userName]);
    }

    // =========  SC  ===========

    public function ScTriningAttendanceView()
    {
        $training = TrainingAndFeedback::where('trainer_department', 'SC')->get();
        $userName = Auth::user()->username;

        return view('director.training.attendance.sc.view', ['training' => $training, 'username' => $userName]);
    }





    // ====================================  Annual Plan  ====================================

    public function trainingPlanView()
    {
        $plan = AnnualTrainingPlan::where('department', 'QA')->get();
        return view('director.training.annual.view', ['plan' => $plan]);
    }


    // =========  TS  ===========

    public function TsTrainingPlanView()
    {
        $plan = AnnualTrainingPlan::where('department', 'TS')->get();
        return view('director.training.annual.ts.view', ['plan' => $plan]);
    }


    // =========  SC  ===========

    public function ScTrainingPlanView()
    {
        $plan = AnnualTrainingPlan::where('department', 'SC')->get();
        return view('director.training.annual.sc.view', ['plan' => $plan]);
    }





    // ====================================  New Employee  ====================================

    public function newEmployeeTrainingView()
    {
        $new = NewEmployeeTraining::where('trainer_department', 'QA')->get();
        return view('director.training.new-employee.view', ['new' => $new]);
    }

    // =========  TS  ===========

    public function TsNewEmployeeTrainingView()
    {
        $new = NewEmployeeTraining::where('trainer_department', 'TS')->get();
        return view('director.training.new-employee.ts.view', ['new' => $new]);
    }

    // =========  SC  ===========

    public function ScNewEmployeeTrainingView()
    {
        $new = NewEmployeeTraining::where('trainer_department', 'SC')->get();
        return view('director.training.new-employee.sc.view', ['new' => $new]);
    }

}

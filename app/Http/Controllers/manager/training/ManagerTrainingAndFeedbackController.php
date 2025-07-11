<?php

namespace App\Http\Controllers\manager\training;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AnnualTrainingPlan;
use App\Models\NewEmployeeTraining;
use App\Models\TrainingAndFeedback;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ManagerTrainingAndFeedbackController extends Controller
{

    // ====================================  Attendance  ====================================

    public function triningAttendanceView()
    {
        $department = Auth::user()->department;
        $userName = Auth::user()->username;

        // Build a dynamic query for attendee names
        $query = TrainingAndFeedback::where('trainer_department', $department);

        for ($i = 1; $i <= 60; $i++) {
            $query->orWhere("attendee_name{$i}", $userName);
        }

        // Execute the query
        $training = $query->get();

        return view('manager.training.attendance.view', ['training' => $training, 'username' => $userName]);
    }


    public function triningAttendanceForm()
    {
        $department = Auth::user()->department;
        $users = User::where('department', $department)->get();
        return view('manager.training.attendance.add', ['users' => $users]);
    }


    public function triningAttendanceCreate(Request $request)
    {
        // Validation
        $rules = [
            'training_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'from' => 'required',
            'to' => 'required',
            'department' => 'required',
            'name1' => 'required|string|max:255', // First attendee name is required
            'absence1' => 'required', // First attendee absence is required
        ];

        for ($i = 2; $i <= 10; $i++) {
            $rules["attendee_name{$i}"] = 'nullable|string|max:255';
            $rules["absence{$i}"] = 'nullable';
        }

        $request->validate($rules);

        // Creating Record

        $trainerName = Auth::user()->username;
        $data = [
            'training_name' => $request->input('training_name'),
            'location' => $request->input('location'),
            'date' => $request->input('date'),
            'from' => $request->input('from'),
            'to' => $request->input('to'),

            'department' => $request->input('department'),
            'trainer_name' => $trainerName,
            'trainer_department' => Auth::user()->department,

            'created_at' => now(),
        ];

        // Adding dynamic user fields (name, absence, department, trainer_name) to the data array
        for ($i = 1; $i <= 10; $i++) {
            $data["attendee_name{$i}"] = $request->input("name{$i}");
            $data["absence{$i}"] = $request->input("absence{$i}");
        }

        // Creating the TrainingAndFeedback record with the collected data
        TrainingAndFeedback::create($data);


        return back()->with('status', 'Attendance Sheet has been Created.');
    }


    public function trinerAttendance($id)
    {
        $attendance = TrainingAndFeedback::find($id);
        $attendance->trainer_designation = Auth::user()->designation;
        $attendance->trainer_signtime = now();

        $attendance->save();
        return back()->with('status', 'Training Attendance has been signed.');
    }



    public function trineeAttendance($id)
    {
        $attendance = TrainingAndFeedback::find($id);

        if (!$attendance) {
            return back()->with('error', 'Attendance record not found.');
        }

        // Loop through 1 to 60 to find the first available slot
        for ($i = 1; $i <= 60; $i++) {
            if ($attendance->{"attendee_name$i"} === Auth::user()->username) {
                if (is_null($attendance->{"attendee_signtime$i"})) {
                    $attendance->{"attendee_department$i"} = Auth::user()->department;
                    $attendance->{"attendee_designation$i"} = Auth::user()->designation;
                    $attendance->{"attendee_signtime$i"} = now();
                    $attendance->save();
                    return back()->with('status', 'Training Attendance has been signed.');
                }
            }
        }

        return back()->with('error', 'No available slots for attendance.');
    }



    public function triningAttendanceEdit($id)
    {

        $department = Auth::user()->department;
        $users = User::where('department', $department)->get();
        $attendance = TrainingAndFeedback::find($id);
        return view('manager.training.attendance.update', ['attendance' => $attendance, 'users' => $users]);
    }



    public function triningAttendanceUpdate(Request $request, $id)
    {

        // Validation rules
        $rules = [
            'training_name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'date' => 'required|date',
            'from' => 'required',
            'to' => 'required',
            'name1' => 'required|string|max:255', // First attendee name is required
            'absence1' => 'required', // First attendee absence is required
        ];

        for ($i = 2; $i <= 20; $i++) {
            $rules["attendee_name{$i}"] = 'nullable|string|max:255';
            $rules["absence{$i}"] = 'nullable';
        }

        // Validate the request data
        $request->validate($rules);

        // Find the existing record
        $trainingAndFeedback = TrainingAndFeedback::findOrFail($id);

        $data = [
            'training_name' => $request->input('training_name'),
            'location' => $request->input('location'),
            'date' => $request->input('date'),
            'from' => $request->input('from'),
            'to' => $request->input('to'),

            'department' => $request->input('department'),
            'trainer_name' => $request->input('trainer_name'),

            'updated_at' => now(),
        ];

        // Add dynamic user fields (name, absence) to the data array
        for ($i = 1; $i <= 8; $i++) {
            $data["attendee_name{$i}"] = $request->input("name{$i}");
            $data["absence{$i}"] = $request->input("absence{$i}");
        }

        // Update the TrainingAndFeedback record with the collected data
        $trainingAndFeedback->update($data);

        // Redirect back with a success message
        return back()->with('status', 'Attendance Updated Successfully.');
    }


    public function triningAttendanceDelete($id)
    {
        $attendance = TrainingAndFeedback::find($id);
        $attendance->delete();
        return back()->with('status', 'Attendance has been removed.');
    }



    // ====================================  Annual Plan  ====================================

    public function trainingPlanView()
    {

        $department = Auth::user()->department;
        $plan = AnnualTrainingPlan::where('department', $department)->get();
        return view('manager.training.annual.view', ['plan' => $plan]);
    }


    public function trainingPlanForm()
    {
        return view('manager.training.annual.add');
    }


    public function trainingPlanCreate(Request $request)
    {
        // Validation
        $rules = [];

        for ($i = 1; $i <= 20; $i++) {
            $rules["training_name{$i}"] = 'nullable|string|max:255';
            $rules["month{$i}"] = 'nullable';
        }

        $request->validate($rules);

        $data = [
            'trainer_name' => Auth::user()->username,
            'department' => Auth::user()->department,
            'created_at' => now(),
        ];

        // Adding dynamic fields
        for ($i = 1; $i <= 20; $i++) {
            $data["training_name{$i}"] = $request->input("training_name{$i}");
            $data["month{$i}"] = $request->input("month{$i}");
        }


        $AnnualTrainingPlan = AnnualTrainingPlan::where('department', $data["department"])->first();

        // Check if a reply already exists
        if ($AnnualTrainingPlan) {
            return back()->with('error', 'Annual Training Plan already exists.');
        }

        // Creating the record
        AnnualTrainingPlan::create($data);


        return back()->with('status', 'Annual Training Plan has been Created.');
    }


    public function trainingPlanEdit($id)
    {

        $plan = AnnualTrainingPlan::find($id);
        return view('manager.training.annual.update', ['plan' => $plan]);
    }


    public function trainingPlanUpdate(Request $request, $id)
    {
        // Validation
        $rules = [];

        for ($i = 1; $i <= 20; $i++) {
            $rules["training_name{$i}"] = 'nullable|string|max:255';
            $rules["month{$i}"] = 'nullable';
        }

        $request->validate($rules);

        // Fetching the record by ID
        $AnnualTrainingPlan = AnnualTrainingPlan::findOrFail($id);

        $data = [
            // 'trainer_name' => Auth::user()->username,
            // 'department' => Auth::user()->department,
            'updated_at' => now(),
        ];

        // Adding dynamic fields
        for ($i = 1; $i <= 20; $i++) {
            $data["training_name{$i}"] = $request->input("training_name{$i}");
            $data["month{$i}"] = $request->input("month{$i}");
        }

        // Updating the record
        $AnnualTrainingPlan->update($data);

        return back()->with('status', 'Annual Training Plan has been Updated.');
    }


    public function trainingPlanDelete($id)
    {
        $plan = AnnualTrainingPlan::find($id);
        $plan->delete();
        return back()->with('status', 'Training Plan has been removed.');
    }



    // ====================================  New Employee  ====================================

    public function newEmployeeTrainingView()
    {

        $department = Auth::user()->department;
        $new = NewEmployeeTraining::where('trainer_department', $department)->get();
        return view('manager.training.new-employee.view', ['new' => $new]);
    }

    public function newEmployeeTrainingForm()
    {
        return view('manager.training.new-employee.add');
    }


    public function newEmployeeTrainingCreate(Request $request)
    {
        // Validation rules for fixed fields
        $rules = [
            'attendee_name' => 'nullable|string|max:255',
            'attendee_department' => 'nullable|string|max:255',
            'attendee_designation' => 'nullable|string|max:255',
            'joining_date' => 'nullable|date',
        ];

        // Validation rules for dynamic training fields
        for ($i = 1; $i <= 20; $i++) {
            $rules["training_name{$i}"] = 'nullable|string|max:255';
            $rules["training_date{$i}"] = 'nullable|date';
        }

        // Validate the request data
        $request->validate($rules);

        // Prepare data for the new record
        $data = [
            'attendee_name' => $request->input('attendee_name'),
            'attendee_department' => $request->input('attendee_department'),
            'attendee_designation' => $request->input('attendee_designation'),
            'joining_date' => $request->input('joining_date'),
            'trainer_name' => Auth::user()->username,
            'trainer_department' => Auth::user()->department,
            'created_at' => now(),
        ];

        // Dynamically add training fields to data array
        for ($i = 1; $i <= 20; $i++) {
            $data["training_name{$i}"] = $request->input("training_name{$i}");
            $data["training_date{$i}"] = $request->input("training_date{$i}");
        }

        // Check if a training plan already exists for the same attendee
        $existingTraining = NewEmployeeTraining::where('attendee_name', $request->input('attendee_name'))
            ->where('joining_date', $request->input('joining_date'))
            ->first();

        if ($existingTraining) {
            return back()->with('error', 'Training record for this employee already exists.');
        }

        // Create the new training record
        NewEmployeeTraining::create($data);

        // Return success message
        return back()->with('status', 'New Employee Training Plan has been Created.');
    }


    public function newEmployeeTrainingEdit($id)
    {
        $new = NewEmployeeTraining::find($id);
        return view('manager.training.new-employee.update', ['new' => $new]);
    }



    public function NewEmployeeTrainingUpdate(Request $request, $id)
    {
        // Validation rules for fixed fields
        $rules = [
            'attendee_name' => 'nullable|string|max:255',
            'attendee_department' => 'nullable|string|max:255',
            'attendee_designation' => 'nullable|string|max:255',
            'joining_date' => 'nullable|date',
        ];

        // Validation rules for dynamic training fields
        for ($i = 1; $i <= 20; $i++) {
            $rules["training_name{$i}"] = 'nullable|string|max:255';
            $rules["training_date{$i}"] = 'nullable|date';
        }

        // Validate the request data
        $request->validate($rules);

        // Find the existing record by ID
        $training = NewEmployeeTraining::find($id);

        // Prepare updated data
        $data = [
            'attendee_name' => $request->input('attendee_name'),
            'attendee_department' => $request->input('attendee_department'),
            'attendee_designation' => $request->input('attendee_designation'),
            'joining_date' => $request->input('joining_date'),
            'updated_at' => now(),
        ];

        // Dynamically add training fields to data array
        for ($i = 1; $i <= 20; $i++) {
            $data["training_name{$i}"] = $request->input("training_name{$i}");
            $data["training_date{$i}"] = $request->input("training_date{$i}");
        }

        // Update the existing training record
        $training->update($data);

        // Return success message
        return back()->with('status', 'New Employee Training Plan has been updated.');
    }



    public function NewEmployeeTrainingDelete($id)
    {
        $new = NewEmployeeTraining::find($id);
        $new->delete();
        return back()->with('status', 'New Employee Training Plan has been removed.');
    }
}

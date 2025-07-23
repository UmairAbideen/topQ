<?php

namespace App\Http\Controllers\Qa\Capa;

use Carbon\Carbon;
use App\Models\CAPA;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CapaController extends Controller
{
    public function view()
    {
        $capa = CAPA::get();
        $username = Auth::user()->username;

        return view('qa.capa.view', ['capas' => $capa, 'username' => $username]);
    }



    public function form()
    {
        return view('qa.capa.add');
    }



    public function create(Request $request)
    {

        $request->validate([
            // Details
            'source' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Get the current year in a two-digit format
        $currentYear = Carbon::now()->format('y');

        // Find the last CAPA record for the current year
        $lastCapa = CAPA::where('capa_no', 'LIKE', 'CAPA-%-' . $currentYear)->orderBy('id', 'desc')->first();

        // Extract the last sequential number, if exists
        if ($lastCapa) {
            $lastNumber = (int)substr($lastCapa->capa_no, 5, 3);
        } else {
            $lastNumber = 0;
        }

        // Increment the sequential number
        $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);

        // Create the new CAPA number
        $capaNo = 'CAPA-' . $nextNumber . '-' . $currentYear;

        // User Department
        $department = Auth::user()->department;

        CAPA::create([
            // Initial Information
            'capa_no' => $capaNo,
            'initiation_date' => now(),
            'department' => $department,

            // Details
            'source' => $request->input('source'),
            'description' => $request->input('description'),
        ]);

        return back()->with('status', 'CAPA form has been created.');
    }



    public function initiate($id)
    {
        $capa = CAPA::find($id);

        $capa->initiator_name = Auth::user()->username;
        $capa->initiator_department = Auth::user()->department;
        $capa->initiator_designation = Auth::user()->designation;
        $capa->initiator_signtime = now();

        $capa->save();
        return back()->with('status', 'CAPA Form is sent to Manager for Verification.');
    }



    public function verify($id)
    {
        $capa = CAPA::find($id);

        $capa->verifier_name = Auth::user()->username;
        $capa->verifier_department = Auth::user()->department;
        $capa->verifier_designation = Auth::user()->designation;
        $capa->verifier_signtime = now();

        $capa->save();
        return back()->with('status', 'CAPA Form is sent to QA for Review.');
    }



    public function review($id)
    {
        $capa = CAPA::find($id);

        $capa->reviewer_name = Auth::user()->username;
        $capa->reviewer_department = Auth::user()->department;
        $capa->reviewer_designation = Auth::user()->designation;
        $capa->reviewer_signtime = now();

        $capa->save();
        return back()->with('status', 'CAPA Form is sent to QA for approval.');
    }



    public function approve($id)
    {
        $capa = CAPA::find($id);

        $capa->approver_name = Auth::user()->username;
        $capa->approver_department = Auth::user()->department;
        $capa->approver_designation = Auth::user()->designation;
        $capa->approver_signtime = now();

        $capa->save();
        return back()->with('status', 'CAPA Form has been approved.');
    }



    public function close($id)
    {
        $capa = CAPA::find($id);

        $capa->closer_name = Auth::user()->username;
        $capa->closer_department = Auth::user()->department;
        $capa->closer_designation = Auth::user()->designation;
        $capa->closer_signtime = now();

        $capa->save();
        return back()->with('status', 'CAPA Form has been closed.');
    }




    public function edit($id)
    {
        $capa = CAPA::find($id);
        return view('qa.capa.update', ['capa' => $capa]);
    }



    public function update(Request $request, $id)
    {
        $capa = CAPA::where('id', $id)->first();

        // <!------ Case 1 ----->
        if ($capa->department === 'QA' && !is_null($capa->description) && is_null($capa->initiator_signtime) ||
            ($capa->department !== 'QA' && !is_null($capa->description) && !is_null($capa->verifier_signtime) && is_null($capa->reviewer_signtime))) {
            $rules = [
                // Details
                'source' => 'required|string|max:255',
                'description' => 'required|string',

                'updated_at' => now(),
            ];

            $request->validate($rules);


            // Base fields
            $data = [
                // Details
                'source' => $request->input('source'),
                'description' => $request->input('description'),

                'updated_at' => now(),
            ];

            // Update the record
            $capa->update($data);


            return back()->with('status', 'CAPA Form has been updated.');
        }
        // <!----- Case 2 ----->
        elseif (($capa->department === 'QA' && !is_null($capa->verifier_signtime) && is_null($capa->approver_signtime)) ||
            ($capa->department !== 'QA' && !is_null($capa->reviewer_signtime) && !is_null($capa->action1) && is_null($capa->approver_signtime))) {

            $rules = [];

            // Add dynamic rules for actions
            for ($i = 1; $i <= 10; $i++) {
                $rules["action{$i}"] = 'nullable|string|max:255';
                $rules["responsible{$i}"] = 'nullable|string|max:255';
                $rules["due_date{$i}"] = 'nullable|date';
                $rules["implementation_date{$i}"] = 'nullable|date';
            }

            $request->validate($rules);


            // Base fields
            $data = [
                'updated_at' => now(),
            ];

            // Loop to add dynamic fields for actions
            for ($i = 1; $i <= 10; $i++) {
                $data["action{$i}"] = $request->input("action{$i}");
                $data["responsible{$i}"] = $request->input("responsible{$i}");
                $data["due_date{$i}"] = $request->input("due_date{$i}");
                $data["implementation_date{$i}"] = $request->input("implementation_date{$i}");
            }

            // Update the record
            $capa->update($data);


            return back()->with('status', 'CAPA Form has been updated.');
        }
        // <!----- Case 3 ----->
        elseif (!is_null($capa->approver_signtime) && is_null($capa->closer_signtime)) {

            $rules = [
                // Effectiveness
                'effectiveness' => 'nullable|string',
            ];

            $request->validate($rules);

            // Base fields
            $data = [
                // Effectiveness
                'effectiveness' => $request->input('effectiveness'),

                'updated_at' => now(),
            ];

            // Update the record
            $capa->update($data);

            return back()->with('status', 'CAPA Form has been updated.');
        }
    }



    public function delete($id)
    {
        $capa = CAPA::find($id);
        $capa->delete();
        return back()->with('status', 'CAPA Form has been Deleted.');
    }
}

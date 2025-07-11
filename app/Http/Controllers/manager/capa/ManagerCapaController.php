<?php

namespace App\Http\Controllers\manager\capa;

use Carbon\Carbon;
use App\Models\CAPA;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ManagerCapaController extends Controller
{

    public function view()
    {
        $department = Auth::user()->department;
        $capa = CAPA::where('department', $department)->get();
        $username = Auth::user()->username;

        return view('manager.capa.view', ['capas' => $capa, 'username' => $username, 'department' => $department]);
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



    public function edit($id)
    {
        $department = Auth::user()->department;
        $capa = CAPA::find($id);
        return view('manager.capa.update', ['capa' => $capa, 'department' => $department]);
    }



    public function update(Request $request, $id)
    {
        $capa = CAPA::where('id', $id)->first();

        // <!------ Case 1 ----->
        if (!is_null($capa->initiator_signtime) && is_null($capa->verifier_signtime)) {

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
        elseif (!is_null($capa->reviewer_signtime) && !is_null($capa->action1) && is_null($capa->approver_signtime)) {

            $rules = [
                'action1' => 'required|string|max:255',
                'responsible1' => 'required|string|max:255',
                'due_date1' => 'required|string|max:255',
                'implementation_date1' => 'required|string|max:255',
            ];

            // Add dynamic rules for actions
            for ($i = 2; $i <= 10; $i++) {
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
    }
}

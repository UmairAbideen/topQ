<?php

namespace App\Http\Controllers\manager\documents;

use App\Models\ScSOP;
use App\Models\TsSOP;
use App\Models\Policy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ManagerDocumentController extends Controller
{
    // =========================== Policy ========================================
    public function policyview()
    {
        $policy = Policy::get();
        $department = auth()->user()->department;

        return view('manager.documents.policy.view', [
            'policies' => $policy,
            'department' => $department,
        ]);
    }



    // =============================================== SOPs ======================================================


    // ======================= TS ==============================

    public function tssopview()
    {
        $sops = TsSOP::all();
        $department = auth()->user()->department;

        return view('manager.documents.sop.ts.view', [
            'sops' => $sops,
            'department' => $department,
        ]);
    }

    public function tssopform()
    {
        return view('manager.documents.sop.ts.add');
    }

    public function tssopcreate(Request $request)
    {
        $request->validate([
            'doc_no' => 'required|string|max:255',
            'doc_name' => 'required|string|max:255',
            'eff_date' => 'required|date',
            'revision_no' => 'required|string|max:255',
            'pdf_file' => 'required|file|mimes:pdf|max:5000',
        ]);

        $file = $request->file('pdf_file');
        $filename = $request->doc_name . '.' . $file->getClientOriginalExtension();
        $path = '/assets/pdf/sop/ts/';
        $file->move(public_path($path), $filename);
        $filePath = $path . $filename;

        TsSOP::create([
            'department' => Auth::user()->department,
            'doc_no' => $request->doc_no,
            'doc_name' => $request->doc_name,
            'eff_date' => $request->eff_date,
            'revision_no' => $request->revision_no,
            'pdf_file' => $filePath,
            'created_at' => now(),
        ]);

        return back()->with('status', 'New SOP has been uploaded.');
    }

    public function tssopedit($id)
    {
        $sop = TsSOP::find($id);
        return view('manager.documents.sop.ts.update', ['sop' => $sop]);
    }

    public function tssopupdate(Request $request, $id)
    {
        $request->validate([
            'doc_no' => 'required|string|max:255',
            'doc_name' => 'required|string|max:255',
            'eff_date' => 'required|date',
            'revision_no' => 'required|string|max:255',
            'pdf_file' => 'nullable|file|mimes:pdf|max:5000',
        ]);

        $sop = TsSOP::findOrFail($id);

        if ($request->hasFile('pdf_file')) {
            if (File::exists(public_path($sop->pdf_file))) {
                File::delete(public_path($sop->pdf_file));
            }

            $file = $request->file('pdf_file');
            $filename = $request->doc_name;
            $path = 'assets/pdf/sop/ts/';
            $file->move(public_path($path), $filename);
            $filePath = $path . $filename;

            $sop->pdf_file = $filePath;
        } else {
            // If no new file is uploaded, check if the document name has changed
            if ($sop->doc_name !== $request->doc_name) {
                // Determine the old and new file paths
                $oldFilePath = public_path($sop->pdf_file);
                $newFileName = $request->doc_name;
                $newFilePath = 'assets/pdf/sop/ts/' . $newFileName;

                // Rename the existing file if it exists
                if (File::exists($oldFilePath)) {
                    File::move($oldFilePath, public_path($newFilePath));
                    // Update the file path in the database
                    $sop->pdf_file = $newFilePath;
                }
            }
        }

        $sop->update([
            'doc_no' => $request->doc_no,
            'doc_name' => $request->doc_name,
            'eff_date' => $request->eff_date,
            'revision_no' => $request->revision_no,
        ]);

        return back()->with('status', 'SOP updated successfully.');
    }

    public function tssopdelete($id)
    {
        $sop = TsSOP::findOrFail($id);

        // Delete the associated PDF file if it exists
        if (File::exists(public_path($sop->pdf_file))) {
            File::delete(public_path($sop->pdf_file));
        }

        $sop->delete();
        return back()->with('status', 'SOP has been removed.');
    }




    // ======================= SC ==============================


    public function scsopview()
    {
        $sops = ScSOP::all();
        $department = auth()->user()->department;

        return view('manager.documents.sop.sc.view', [
            'sops' => $sops,
            'department' => $department,
        ]);
    }

    public function scsopform()
    {
        return view('manager.documents.sop.sc.add');
    }

    public function scsopcreate(Request $request)
    {
        $request->validate([
            'doc_no' => 'required|string|max:255',
            'doc_name' => 'required|string|max:255',
            'eff_date' => 'required|date',
            'revision_no' => 'required|string|max:255',
            'pdf_file' => 'required|file|mimes:pdf|max:5000',
        ]);

        $file = $request->file('pdf_file');
        $filename = $request->doc_name . '.' . $file->getClientOriginalExtension();
        $path = '/assets/pdf/sop/sc/';
        $file->move(public_path($path), $filename);
        $filePath = $path . $filename;

        ScSOP::create([
            'department' => Auth::user()->department,
            'doc_no' => $request->doc_no,
            'doc_name' => $request->doc_name,
            'eff_date' => $request->eff_date,
            'revision_no' => $request->revision_no,
            'pdf_file' => $filePath,
            'created_at' => now(),
        ]);

        return back()->with('status', 'New SOP has been uploaded.');
    }

    public function scsopedit($id)
    {
        $sop = ScSOP::find($id);
        return view('manager.documents.sop.sc.update', ['sop' => $sop]);
    }

    public function scsopupdate(Request $request, $id)
    {
        $request->validate([
            'doc_no' => 'required|string|max:255',
            'doc_name' => 'required|string|max:255',
            'eff_date' => 'required|date',
            'revision_no' => 'required|string|max:255',
            'pdf_file' => 'nullable|file|mimes:pdf|max:5000',
        ]);

        $sop = ScSOP::findOrFail($id);

        if ($request->hasFile('pdf_file')) {
            if (File::exists(public_path($sop->pdf_file))) {
                File::delete(public_path($sop->pdf_file));
            }

            $file = $request->file('pdf_file');
            $filename = $request->doc_name;
            $path = 'assets/pdf/sop/sc/';
            $file->move(public_path($path), $filename);
            $filePath = $path . $filename;

            $sop->pdf_file = $filePath;
        } else {
            // If no new file is uploaded, check if the document name has changed
            if ($sop->doc_name !== $request->doc_name) {
                // Determine the old and new file paths
                $oldFilePath = public_path($sop->pdf_file);
                $newFileName = $request->doc_name;
                $newFilePath = 'assets/pdf/sop/sc/' . $newFileName;

                // Rename the existing file if it exists
                if (File::exists($oldFilePath)) {
                    File::move($oldFilePath, public_path($newFilePath));
                    // Update the file path in the database
                    $sop->pdf_file = $newFilePath;
                }
            }
        }

        $sop->update([
            'doc_no' => $request->doc_no,
            'doc_name' => $request->doc_name,
            'eff_date' => $request->eff_date,
            'revision_no' => $request->revision_no,
        ]);

        return back()->with('status', 'SOP updated successfully.');
    }

    public function scsopdelete($id)
    {
        $sop = ScSOP::findOrFail($id);

        // Delete the associated PDF file if it exists
        if (File::exists(public_path($sop->pdf_file))) {
            File::delete(public_path($sop->pdf_file));
        }

        $sop->delete();
        return back()->with('status', 'SOP has been removed.');
    }
}

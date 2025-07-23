<?php

namespace App\Http\Controllers\Qa\Excel;

use App\Models\ExportExcel;
use App\Models\ImportExcel;
use Illuminate\Http\Request;
use App\Exports\ExportFeedbackExcel;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'excel_file'=>'required|mimes:xlsx'
        ]);
        Excel::import(new ImportExcel,  $request->excel_file);
        return back()->with('status','Excel Sheet successfully imported.');
    }

    public function export()
    {
        return Excel::download(new ExportExcel, 'users-excel.xlsx');
    }

    public function exportfeedback()
    {
        return Excel::download(new ExportFeedbackExcel, 'feedback-excel.xlsx');
    }

}

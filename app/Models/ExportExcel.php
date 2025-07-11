<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class ExportExcel implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    //this is default for  export excel file
    // public function collection()
    // {
    //     return Students::all();
    // }

    //this is custom for  export excel file
    public function view(): View
    {
        return view('qa.users.export.export', [
            'users' => User::all()
        ]);
    }
}

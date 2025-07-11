<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IaReport extends Model
{
    protected $fillable = [

        'report_no',
        'doc_date',

        'internal_auditor1',
        'internal_auditor2',

        'department1',
        'date_dep1',
        'area1',
        'scope1',

        'department2',
        'date_dep2',
        'area2',
        'scope2',

        'department3',
        'date_dep3',
        'area3',
        'scope3',

        'summary',
        'deviation_no',

        'prepared_by',
        'preparation_date',
        'approved_by',
        'approval_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden =
        [

        ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts =
        [

        ];
}

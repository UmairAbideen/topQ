<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IaSchedule extends Model
{
    protected $fillable = [

        'internal_auditor1',
        'internal_auditor2',
        'doc_date',

        'department1',
        'date_dep1',
        'time1',
        'area1',
        'auditee1a',
        'auditee1b',
        'auditee1c',

        'department2',
        'date_dep2',
        'time2',
        'area2',
        'auditee2a',
        'auditee2b',
        'auditee2c',

        'department3',
        'date_dep3',
        'time3',
        'area3',
        'auditee3a',
        'auditee3b',
        'auditee3c',

        'prepared_by',
        'approved_by',
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

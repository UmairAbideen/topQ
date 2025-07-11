<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Risk extends Model
{
    protected $fillable = [
        'qre_no',
        'receipt_date',
        'department',

        'area',
        'description',
        'existing_controls',
        'coordinator',

        'severity_before',
        'probablity_before',
        'detectability_before',
        'rpn_before',
        'criticality_before',

        'action1',
        'responsibility1',
        'completion_date1',

        'action2',
        'responsibility2',
        'completion_date2',

        'action3',
        'responsibility3',
        'completion_date3',

        'action4',
        'responsibility4',
        'completion_date4',

        'action5',
        'responsibility5',
        'completion_date5',

        'severity_after',
        'probablity_after',
        'detectability_after',
        'rpn_after',
        'criticality_after',

        'closing_date',
        'verified_by',
        'reviewed_by',
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

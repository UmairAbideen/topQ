<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecallClosure extends Model
{
    protected $fillable = [

        'product',
        'recall_no',

        'problem_detail',
        'batch',
        'serial',
        'expiry',
        'manufacturing_date',

        'distributed_c',
        'recovered_c',
        'recovery_c',

        'distributed_s',
        'recovered_s',
        'recovery_s',

        'remarks',
        'decision',

        'reviewed_by',
        'review_date',
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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recall extends Model
{
    protected $fillable = [

        'reporter_name',
        'organization',
        'address',
        'contact',
        'email',
        'receipt_date',

        'product_name',
        'registration_no',
        'batch',
        'serial',
        'expiry',
        'manufacturing_date',

        'qty_before',
        'qty_distributed',

        'customer_name1',
        'distribution_date1',

        'customer_name2',
        'distribution_date2',

        'customer_name3',
        'distribution_date3',

        'source',
        'problem_detail',
        'no_of_complaint',
        'action_taken',
        'risk_assessment',
        'recall_type',

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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CAPA extends Model
{
    use HasFactory;

    protected $fillable = [

        // Initial Information
        'capa_no',
        'initiation_date',
        'department',

        // Details
        'source',
        'description',

        // Initiator Information
        'initiator_name',
        'initiator_department',
        'initiator_designation',
        'initiator_signtime',

        // Verifier Information
        'verifier_name',
        'verifier_department',
        'verifier_designation',
        'verifier_signtime',

        // Reviewer Information
        'reviewer_name',
        'reviewer_department',
        'reviewer_designation',
        'reviewer_signtime',

        // Implementation
        'action1',
        'responsible1',
        'due_date1',
        'implementation_date1',

        'action2',
        'responsible2',
        'due_date2',
        'implementation_date2',

        'action3',
        'responsible3',
        'due_date3',
        'implementation_date3',

        'action4',
        'responsible4',
        'due_date4',
        'implementation_date4',

        'action5',
        'responsible5',
        'due_date5',
        'implementation_date5',

        'action6',
        'responsible6',
        'due_date6',
        'implementation_date6',

        'action7',
        'responsible7',
        'due_date7',
        'implementation_date7',

        'action8',
        'responsible8',
        'due_date8',
        'implementation_date8',

        'action9',
        'responsible9',
        'due_date9',
        'implementation_date9',

        'action10',
        'responsible10',
        'due_date10',
        'implementation_date10',

        // Approver Information
        'approver_name',
        'approver_department',
        'approver_designation',
        'approver_signtime',

        // Effectiveness
        'effectiveness',

        // Closer Information
        'closer_name',
        'closer_department',
        'closer_designation',
        'closer_signtime',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden =
    [];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts =
    [];
}

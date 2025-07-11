<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CCM extends Model
{
    protected $fillable = [

        'request_no',
        'logging_date',
        'initiator',
        'department',
        'description',
        'justification',
        'area',
        'impact',

        'action1',
        'action2',
        'action3',
        'priority',
        'required_date',

        'effected_doc1',
        'doc_no1',
        'effected_doc2',
        'doc_no2',
        'effected_doc3',
        'doc_no3',

        'initiator_name',
        'initiator_department',
        'initiator_designation',
        'initiator_signtime',

        'verifier_name',
        'verifier_department',
        'verifier_designation',
        'verifier_signtime',

        'classification',

        'reviewer_name1',
        'reviewer_department1',
        'reviewer_designation1',
        'reviewer_signtime1',
        'recommendation1',

        'reviewer_name2',
        'reviewer_department2',
        'reviewer_designation2',
        'reviewer_signtime2',
        'recommendation2',

        'reviewer_name3',
        'reviewer_department3',
        'reviewer_designation3',
        'reviewer_signtime3',
        'recommendation3',

        'approver_name',
        'approver_department',
        'approver_designation',
        'approver_signtime',

        'task1',
        'responsible1',
        'completion_date1',

        'task2',
        'responsible2',
        'completion_date2',

        'task3',
        'responsible3',
        'completion_date3',

        'summary',
        'implementation_date',
        'final_assessment',
        'monitoring',

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
        [
            // 'password',
            // 'remember_token',
        ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts =
        [
            // 'email_verified_at' => 'datetime',
            // 'password' => 'hashed',
        ];
}

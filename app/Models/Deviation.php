<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deviation extends Model
{
    protected $fillable = [

       // Initial Information
       'deviation_date',
       'deviation_no',
       'initiator_name',
       'initiator_department',
       'initiator_designation',

       // Initial Assessment
       'subject',
       'detail',
       'status',
       'statement',
       'action',

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

       // Approver Information
       'approver_name',
       'approver_department',
       'approver_designation',
       'approver_signtime',

       // Root Cause Analysis
       'root_causes',
       'root_cause_remarks',

       // Categorization
       'categorization',

       // Review Committee
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

       // Impact Evaluation By Manager
       'device_effected',
       'patient_effected',
       'other_effected',

       // Manager Confirmation
       'confirmer_name',
       'confirmer_department',
       'confirmer_designation',
       'confirmer_signtime',

       // Impact Evaluation By QA
       'required_recall',
       'recall_no',
       'required_capa',
       'capa_no',
       'required_ccm',
       'ccm_no',

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

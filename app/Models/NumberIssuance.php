<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NumberIssuance extends Model
{
    use HasFactory;

    protected $fillable = [
        'department',
        'doc_no',
        'doc_name',
        'reason',

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
    ];
}

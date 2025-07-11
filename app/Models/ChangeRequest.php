<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChangeRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        // General Information
        'change_no',
        'department',
        'doc_no',
        'doc_name',
        'impact',

        // Verifier Information
        'verifier_name',
        'verifier_department',
        'verifier_designation',
        'verifier_signtime',

        // Approver Information
        'approver_name',
        'approver_department',
        'approver_designation',
        'approver_signtime',
    ];

    /**
     * Dynamically add change and reason fields to fillable.
     */
    public function __construct(array $attributes = [])
    {
        for ($i = 1; $i <= 5; $i++) {
            $this->fillable[] = "change{$i}";
            $this->fillable[] = "reason{$i}";
        }
        parent::__construct($attributes);
    }
}

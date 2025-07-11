<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TsSOP extends Model
{
    use HasFactory;

    protected $table = 'ts_sops';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'department',
        'doc_no',
        'doc_name',
        'eff_date',
        'revision_no',
        'pdf_file',
    ];
}

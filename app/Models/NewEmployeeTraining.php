<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewEmployeeTraining extends Model
{
    use HasFactory;

    protected $fillable = [
        'attendee_name',
        'attendee_department',
        'attendee_designation',
        'joining_date',
        'trainer_name',
        'trainer_department',
    ];

    /**
     * Dynamically add training fields to fillable.
     */
    public function __construct(array $attributes = [])
    {
        for ($i = 1; $i <= 20; $i++) {
            $this->fillable[] = "training_name{$i}";
            $this->fillable[] = "training_date{$i}";
        }
        parent::__construct($attributes);
    }
}

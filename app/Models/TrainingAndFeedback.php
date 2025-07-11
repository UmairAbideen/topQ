<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingAndFeedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'training_name',
        'location',
        'date',
        'from',
        'to',
        'department',
        'trainer_name',
        'trainer_department',
        'trainer_designation',
        'trainer_signtime',

        'created_at',
        'updated_at',
    ];

    // Dynamically add fillable fields for trainees from 1 to 60
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        for ($i = 1; $i <= 60; $i++) {
            $this->fillable[] = "attendee_name{$i}";
            $this->fillable[] = "absence{$i}";
            $this->fillable[] = "attendee_department{$i}";
            $this->fillable[] = "attendee_designation{$i}";
            $this->fillable[] = "attendee_signtime{$i}";
        }
    }
}

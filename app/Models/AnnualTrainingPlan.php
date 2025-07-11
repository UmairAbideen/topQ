<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnualTrainingPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'department',
        'trainer_name',
        'created_at',
        'updated_at',
    ];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // Add dynamic fields for training_name and month to $fillable
        for ($i = 1; $i <= 20; $i++) {
            $this->fillable[] = "training_name{$i}";
            $this->fillable[] = "month{$i}";
        }
    }
}

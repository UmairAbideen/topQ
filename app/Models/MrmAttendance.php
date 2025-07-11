<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MrmAttendance extends Model
{
    // Define the attributes that can be mass assigned
    protected $fillable = [
        'mrm_agenda_id',
        'meeting_no',
        'name1',
        'department1',
        'absence1',
        'name2',
        'department2',
        'absence2',
        'name3',
        'department3',
        'absence3',
        'name4',
        'department4',
        'absence4',
        'name5',
        'department5',
        'absence5',
        'name6',
        'department6',
        'absence6',
        'name7',
        'department7',
        'absence7',
        'name8',
        'department8',
        'absence8',
        'created_at',
        'updated_at', // Include this if you're using timestamps
    ];

    public function agenda()
    {
        return $this->belongsTo(MrmAgenda::class, 'mrm_agenda_id', 'id');
    }

}


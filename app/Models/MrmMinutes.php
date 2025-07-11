<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MrmMinutes extends Model
{
    protected $fillable = [
        'meeting_no',
        'mrm_agenda_id',
        'decision1',
        'action1',
        'responsible1',
        'completion_date1',
        'remarks1',
        'decision2',
        'action2',
        'responsible2',
        'completion_date2',
        'remarks2',
        'decision3',
        'action3',
        'responsible3',
        'completion_date3',
        'remarks3',

        'decision4',
        'action4',
        'responsible4',
        'completion_date4',
        'remarks4',
        'decision5',
        'action5',
        'responsible5',
        'completion_date5',
        'remarks5',
        'decision6',
        'action6',
        'responsible6',
        'completion_date6',
        'remarks6',

        'decision7',
        'action7',
        'responsible7',
        'completion_date7',
        'remarks7',
        'decision8',
        'action8',
        'responsible8',
        'completion_date8',
        'remarks8',

        'decision9',
        'action9',
        'responsible9',
        'completion_date9',
        'remarks9',
        'decision10',
        'action10',
        'responsible10',
        'completion_date10',
        'remarks10',

        'prepared_by',
        'approved_by',
    ];


    // public function agenda()
    // {
    //     return $this->belongsTo(MrmAgenda::class);
    // }


    public function agenda()
    {
        return $this->belongsTo(MrmAgenda::class, 'mrm_agenda_id', 'id');
    }


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

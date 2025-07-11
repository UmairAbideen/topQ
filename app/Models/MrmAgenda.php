<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MrmAgenda extends Model
{

    protected $fillable = [
        'meeting_no',
        'meeting_date',
        'review_period',
        'start_time',
        'end_time',
        'venue',
        'review_item1',
        'review_item2',
        'review_item3',
        'review_item4',
        'review_item5',
        'review_item6',
        'review_item7',
        'review_item8',
        'review_item9',
        'review_item10',
        'review_item11',
        'review_item12',
        'review_item13',
        'review_item14',
        'review_item15',
        'review_item16',
        'review_item17',
        'review_item18',
        'review_item19',
        'review_item20',
    ];


    public function minute()
    {
        return $this->hasOne(MrmMinutes::class);
    }

    public function attendance()
    {
        return $this->hasOne(MrmAttendance::class);
    }


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden =
        [

        ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts =
        [

        ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loan extends Model
{
    //
    protected $fillable = ['amount', 'term', 'interest_rate', 'start_date',];


    /* //Accessors : User to retreive data from Database (with format etc.)
    public function getAmountAttribute($value){
        return number_format($value, 2);
    }

    public function getTermAttribute($value){
        return number_format($value, 0);
    }
    */

    //Mutators
    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = date('Y-m-d', strtotime($value));
    }

    //Cast
//    protected $casts = [
//        'start_date' => 'datetime:Y-m',
//    ];
}

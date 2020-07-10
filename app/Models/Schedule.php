<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'patient_id','date_of_visit','status','doctor_id','reason'
    ];


    protected $attributes = ['status'=>'awaiting approval'];


    public function patient(){
        return $this->belongsTo('App\User','patient_id');
    }

    public function doctor(){
        return $this->belongsTo('App\User','doctor_id');
    }

}

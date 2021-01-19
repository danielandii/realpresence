<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [
        'id', 'created_at'
    ];

    public function salary()
    {
    	return $this->hasMany('App\Model\Salary', 'user_id', 'id');
    }

    public function user()
    {
    	return $this->hasMany('App\Model\User', 'user_id', 'id');
    }
}

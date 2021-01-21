<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use SoftDeletes;

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

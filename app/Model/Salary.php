<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
	protected $guarded = ['id', 'created_at'];
	
    public function employee()
    {
    	return $this->belongsTo('App\Model\Employee', 'user_id', 'id');
    }

}

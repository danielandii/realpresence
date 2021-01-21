<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salary extends Model
{
	use SoftDeletes;

	protected $guarded = ['id', 'created_at'];
	
    public function employee()
    {
    	return $this->belongsTo('App\Model\Employee', 'user_id', 'id');
    }

}

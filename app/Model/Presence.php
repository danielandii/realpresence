<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presence extends Model
{
	use SoftDeletes;

    protected $guarded = [
        'id', 'created_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\Model\User', 'user_id', 'id');
    }
}

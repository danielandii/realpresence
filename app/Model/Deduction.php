<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Deduction extends Model
{
    protected $fillable = ['pph_percentage', 'bpjs_percentage'];
}

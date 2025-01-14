<?php

namespace App\Models\dashboard;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
 protected $guarded = [];

 public function Problems()
 {
    return $this->hasMany(ProblemCategory::class, 'problems');
 }
}

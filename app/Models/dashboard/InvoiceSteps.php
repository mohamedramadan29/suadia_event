<?php

namespace App\Models\dashboard;

use Illuminate\Database\Eloquent\Model;

class InvoiceSteps extends Model
{
    protected $guarded = [];

    public function Admin(){
        return $this->belongsTo(Admin::class,'admin_id');
    }
}

<?php

namespace App\Models\dashboard;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = [];

    public function Problems()
    {
        return $this->hasMany(ProblemCategory::class, 'problems');
    }

    public function files()
    {
        return $this->hasMany(InvoiceImage::class, 'invoice_id');
    }

    public function Recieved()
    {
        return $this->belongsTo(Admin::class, 'admin_recieved_id');
    }
    public function Technical()
    {
        return $this->belongsTo(Admin::class, 'admin_repair_id');
    }

    public function Steps(){
        return $this->hasMany(InvoiceSteps::class,'invoice_id');
    }

}

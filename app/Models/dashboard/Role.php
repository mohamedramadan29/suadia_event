<?php

namespace App\Models\dashboard;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    public function admins(){
        return $this->hasMany(Admin::class,'role_id');
    }
}

<?php

namespace App\Models\dashboard;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $guarded = [];

    public $timestamps = false;

    public function colage(){
        return $this->belongsTo(Collage::class,'collage_id');
    }

    public function type(){
        return $this->belongsTo(Eventtype::class,'event_type_id');
    }
}

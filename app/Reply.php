<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $guarded = [];
    public function owner(){
        return $this->belongsTo('\App\User','user_id');
    }
    public function discussion(){
        return $this->belongsTo('\App\Discussion');
    }
}

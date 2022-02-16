<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = ['user_id','discussion_id','like'];
    public function discussion(){
        return $this->belongsTo('\App\Discussion');
    }
}

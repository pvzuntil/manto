<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tco extends Model
{
    //
    protected $fillable = ['idUser','idPro','banyak'];

    public function tpro()
    {
      return $this->belongsTo(tpro::class,'idPro','id');
    }
}

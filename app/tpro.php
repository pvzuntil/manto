<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tpro extends Model
{
    //
    protected $guarded = [''];

    public function tkat()
    {
      return $this->belongsTo(tkat::class,'idKat','id');
    }
}

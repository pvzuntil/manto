<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class this extends Model
{
    //
    protected $guarded=[''];
    protected $table = 'this';

    public function tpel(){
        return $this->belongsTo(tpel::class, 'kodePembelian', 'kodePembelian');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';

    protected $fillable = ['location_name'];

    public function good_receipt(){
        return $this->hasMany(GoodReceive::class,'id_goodreceipt','id');
    }
}

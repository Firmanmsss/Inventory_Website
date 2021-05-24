<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodReceive extends Model
{
    protected $table = 'good_receives';

    protected $fillable = ['id_cust','id_partname','tanggal','checker','pic','qty_in','location','qty_loc'];

    public function Mpartname(){
        return $this->belongsTo(Part_Name::class,'id_partname','id');
    }

    public function customer(){
        return $this->belongsTo(Customer::class,'id_cust','id');
    }

    public function checker(){
        return $this->belongsTo(Checker::class,'checker','id');
    }

    public function personinc(){
        return $this->belongsTo(PersonInC::class,'pic','id');
    }

    public function locat(){
        return $this->belongsTo(Location::class,'location','id');
    }
}

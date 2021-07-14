<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodReceive extends Model
{
    protected $table = 'good_receives';

    protected $fillable = ['id_po','id_cust','nomor_po','checker','pic'];

    public function customer(){
        return $this->belongsTo(Customer::class,'id_cust','id');
    }

    public function checker(){
        return $this->belongsTo(Checker::class,'checker','id');
    }

    public function personinc(){
        return $this->belongsTo(PersonInC::class,'pic','id');
    }

    public function details()
    {
        return $this->hasMany(GRDetail::class, 'id_po', 'id_po');
    }
}

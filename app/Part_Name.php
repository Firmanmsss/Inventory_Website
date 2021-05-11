<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part_Name extends Model
{
    protected $table = 'part__names';

    protected $fillable = ['id_cust','name','satuan','std_qty','foto','stok'];

    public function customer(){
        return $this->belongsTo(Customer::class,'id_cust','id');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $table = 'purchase_orders';

    protected $fillable = ['id_partname','price','qty','total'];

    public function good_receipt(){
        return $this->hasMany(GoodReceive::class,'id_goodreceipt','id');
    }

    public function partname(){
        return $this->belongsTo(Part_Name::class,'id_partname','id');
    }
}

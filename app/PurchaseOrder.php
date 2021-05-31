<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $table = 'purchase_orders';

    protected $fillable = ['nomor_po'];

    public function good_receipt(){
        return $this->hasMany(GoodReceive::class,'id_goodreceipt','id');
    }

    public function details(){
        return $this->hasMany(PurchaseDetail::class,'nomor_po','nomor_po');
    }
}
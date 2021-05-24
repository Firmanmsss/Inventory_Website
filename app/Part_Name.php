<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Part_Name extends Model
{
    protected $table = 'part__names';

    protected $fillable = ['id_cust','id_category','id_unit','partname','std_qty','foto','stok'];

    public function customer(){
        return $this->belongsTo(Customer::class,'id_cust','id');
    }

    public function category(){
        return $this->belongsTo(Category::class,'id_category','id');
    }

    public function unit(){
        return $this->belongsTo(Satuan::class,'id_unit','id');
    }

    public function good_receipt(){
        return $this->hasMany(GoodReceive::class,'id_goodreceipt','id');
    }

    public function purchase_order(){
        return $this->hasMany(PurchaseOrder::class,'id_purchaseorder','id');
    }
}

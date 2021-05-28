<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    protected $table = 'purchase_details';

    protected $fillable = ['nomor_po','id_partname','price','qty','total'];

    public function namepart(){
        return $this->belongsTo(Part_Name::class,'id_partname','id');
    }

    public function purchaseorder(){
        return $this->belongsTo(PurchaseOrder::class,'nomor_po','nomor_po');
    }
}

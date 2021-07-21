<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SODetail extends Model
{
    protected $table = 'stock_opdetail';

    protected $fillable = ['id_so','id_partname','qty_sistem','qty_fisik','total_qty_selisih'];

    protected function stock_opname(){
        return $this->belongsTo(StockOpname::class, 'id_so','id');
    }

    protected function partname(){
        return $this->belongsTo(Part_Name::class,'id_partname','id');
    }
}

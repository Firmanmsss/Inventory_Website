<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockOpname extends Model
{
    protected $table = 'stock_opnames';

    protected $fillable = ['keterangan'];

    public function details()
    {
        return $this->hasMany(SODetail::class, 'id', 'id_so');
    }
}

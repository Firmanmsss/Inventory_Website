<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GIDetail extends Model
{
    protected $table = 'gi_detail';

    protected $fillable = ['id_gi', 'id_buyer', 'id_partname', 'price', 'qty', 'total'];

    public function buyer()
    {
        return $this->belongsTo(Buyer::class, 'id_buyer', 'id');
    }

    public function partname()
    {
        return $this->belongsTo(Part_Name::class, 'id_partname', 'id');
    }

    public function details()
    {
        return $this->belongsTo(GIDetail::class, 'id_gi', 'id');
    }
}

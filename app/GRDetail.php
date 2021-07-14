<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GRDetail extends Model
{
    protected $table = 'gr_details';

    protected $fillable = ['id_gr','id_po', 'id_partname','price', 'qty_in','total', 'location'];

    public function Mpartname()
    {
        return $this->belongsTo(Part_Name::class, 'id_partname', 'id');
    }

    public function GoodReceive()
    {
        return $this->belongsTo(GoodReceive::class, 'id_po', 'id_po');
    }

    public function locat()
    {
        return $this->belongsTo(Location::class, 'location', 'id');
    }
}

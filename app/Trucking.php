<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trucking extends Model
{
    protected $table = 'truckings';

    protected $fillable = ['id_packing','nama_pengendara','plat_nomor'];
}

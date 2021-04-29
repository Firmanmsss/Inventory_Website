<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Packing extends Model
{
    protected $table = 'packings';

    protected $fillable = ['id_picking','from','destination','tanggal','total_qty'];
}
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodReceive extends Model
{
    protected $table = 'good_receives';

    protected $fillable = ['id_cust','id_partname','tgl','checker','pic','qty_in','location','qty_loc'];
}

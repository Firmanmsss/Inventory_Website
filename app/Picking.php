<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picking extends Model
{
    protected $table = 'pickings';

    protected $fillable = ['id_good_issue','qty','location'];
}

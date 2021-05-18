<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    protected $table = 'satuans';

    protected $fillaable = ['name'];

    public function partname(){
        return $this->hasMany(Part_Name::class,'id_partname', 'id' );
    }
}

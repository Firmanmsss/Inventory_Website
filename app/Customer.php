<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table='customers';

    protected $fillable=['name','no_telp','alamat'];

    public function goodreceive(){
        return $this->hasOne('App\goodreceive');
    }

    public function goodissue(){
        return $this->hasOne('App\goodissue');
    }

    public function partname(){
        return $this->hasMany(Part_Name::class,'id_partname', 'id' );
    }
}

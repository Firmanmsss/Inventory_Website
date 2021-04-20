<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table='customers';

    protected $fillable=['name','no_telp','alamat'];

    public function goodreceive(){
        return $this->hasOne('App\GoodReceive');
    }

    public function goodissue(){
        return $this->hasOne('App\GoodIssue');
    }

    public function partname(){
        return $this->hasMany('App\Part_Name');
    }
}

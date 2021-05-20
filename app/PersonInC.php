<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonInC extends Model
{
    protected $table = 'person_in_c_s';

    protected $fillable = ['name','posisi'];

    public function goodreceive(){
        return $this->hasOne('App\goodreceive');
    }

    public function goodissue(){
        return $this->hasOne('App\goodissue');
    }
}

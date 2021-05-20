<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Checker extends Model
{
    protected $table = 'checkers';

    protected $fillable = ['name','posisi'];

    public function goodreceive(){
        return $this->hasOne('App\goodreceive');
    }

    public function goodissue(){
        return $this->hasOne('App\goodissue');
    }
}

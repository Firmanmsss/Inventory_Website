<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    protected $table = 'buyers';

    protected $fillable = ['name','no_telp','alamat'];

    public function goodissue(){
        return $this->hasMany(GoodIssue::class,'id_good_issue', 'id' );
    }
}

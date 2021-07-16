<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodIssue extends Model
{
    protected $table = 'good_issues';

    protected $fillable = ['id_buyer','id_cust','no_po_buyer','checker','pic', 'location','destination'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_cust', 'id');
    }

    public function buyer()
    {
        return $this->belongsTo(Buyer::class, 'id_buyer', 'id');
    }

    public function checker()
    {
        return $this->belongsTo(Checker::class, 'checker', 'id');
    }

    public function personinc()
    {
        return $this->belongsTo(PersonInC::class, 'pic', 'id');
    }

    public function locat()
    {
        return $this->belongsTo(Location::class, 'location', 'id');
    }

    public function details()
    {
        return $this->hasMany(GIDetail::class, 'id', 'id_gi');
    }
}

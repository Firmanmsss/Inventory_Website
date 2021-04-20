<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoodIssue extends Model
{
    protected $table = 'good_issues';

    protected $fillable = ['id_cust','id_partname','tanggal','no_po_cust','checker','pic','destination','qty','location'];
}

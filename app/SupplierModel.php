<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupplierModel extends Model
{
    protected  $table = "ys_supplier";
    protected  $primaryKey = 'id';
    public $timestamps = false;
    protected $guarded = [];


}

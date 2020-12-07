<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    public function Pizza(){
        return $this->belongsTo(Pizza::class,"PizzaID");
    }

    protected $table = "trtransactiondetail";
    public $timestamps = false;
}

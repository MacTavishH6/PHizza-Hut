<?php

namespace App;

use Illuminate\Database\Eloquent\Model; 

class PizzaCart extends Model
{
    protected $table = "tr_pizzacart";
    public $timestamps = false;

    public function Pizza(){
        return $this->hasOne(Pizza::class,'id','PizzaID');
    }
}
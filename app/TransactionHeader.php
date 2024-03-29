<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionHeader extends Model
{
    public function User(){
        return $this->belongsTo(User::class,'UserID');
    }

    protected $table = "trtransactionheader";
    public $timestamps = false;
}

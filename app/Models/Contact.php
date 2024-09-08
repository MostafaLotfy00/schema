<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $guarded;

    public static function booted(){
        static::creating(function($model){
            if($model->contact_type == 'customer'){
                $model->balance_due= $model->opening_balance;
            }else if($model->contact_type == 'supplier'){
                $model->remaining_balance= $model->opening_balance;
            }
        });
    }

}

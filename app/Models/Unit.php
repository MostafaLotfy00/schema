<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $guarded;

    public function unit(){
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}

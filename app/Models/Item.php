<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    const FACT_1 = 1700;
    const FACT_2 = 20;

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}

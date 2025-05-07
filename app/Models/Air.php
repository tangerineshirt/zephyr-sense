<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Air extends Model
{
    protected $fillable = ['pm25', 'co', 'no2', 'temp', 'humidity', 'air_quality'];
}

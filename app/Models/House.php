<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    //protected $fillable = ['location_latitude', 'location_longitude'];

    protected $casts = [
        'images' => 'json',
    ];
}

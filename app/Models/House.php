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

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function rentings()
    {
        return $this->hasMany(Renting::class);
    }
}

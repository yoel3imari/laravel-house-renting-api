<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renting extends Model
{
    use HasFactory;

    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

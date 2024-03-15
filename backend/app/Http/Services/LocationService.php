<?php

namespace App\Http\Services;

use App\Models\House;

class LocationService
{

  public static function houses_near_location($query, $location)
  {
    $query->whereBetween(
      'latitude',
      [
        $location['min_latitude'],
        $location['max_latitude']
      ],
    )->whereBetween(
        'longitude',
        [
          $location['min_longitude'],
          $location['max_longitude']
        ],
      );

    return $query;
  }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeoRegions extends Model
{
	protected $table = 'geo_regions';
    protected $primaryKey = 'id';
    public $timestamps = false;
}
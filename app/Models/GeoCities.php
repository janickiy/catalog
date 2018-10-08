<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeoCities extends Model
{
	protected $table = 'geo_cities';
    protected $primaryKey = 'id';
    public $timestamps = false;
}

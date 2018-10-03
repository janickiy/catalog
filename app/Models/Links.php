<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
	protected $table = 'links';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'url',
        'email',
        'reciprocal_link',
        'description',
        'keywords',
        'full_description',
        'htmlcode_banner',
        'catalog_id',
        'status',
        'token',
        'check_link',
        'views',
        'comment',
        'time_check',
        'number_check'
    ];

    public function catalog()
    {
        return $this->belongsTo(Models\Catalog::class);
    }


}

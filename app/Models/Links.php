<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    const PER_PAGE = 1000;

	protected $table = 'links';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'url',
        'email',
        'city',
        'phone',
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
        return $this->belongsTo(Catalog::class);
    }

    public function getStatusAttribute()
    {
        switch ($this->attributes['status']) {
            case 0:
                return 'new';
            case 1:
                return 'publish';
            case 2:
                return 'hide';
            case 3:
                return 'black';
        }
    }
}

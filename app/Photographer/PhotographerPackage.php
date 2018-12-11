<?php

namespace App\Photographer;

use Illuminate\Database\Eloquent\Model;

class PhotographerPackage extends Model
{
    protected $primaryKey = 'package_id';
    protected $table = 'pgr_package';
    public $timestamps = true;
    
    protected $fillable = [
        'partner_id',
        'partner_name',
        'pkg_name',
        'pkg_mua',
        'pkg_stylist',
        'max_range_price',
        'min_range_price',
        'given_photos',
        'edited_photos',
        'format_photos',
        'pkg_duration',
        'pkg_description',
    ];

    public function partner()
    {
        return $this->belongsTo('Partner');
    }
}

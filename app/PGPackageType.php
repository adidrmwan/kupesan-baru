<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PGPackageType extends Model
{
    protected $table = 'pg_package_type';
    
    protected $fillable = [
        'package_id', 'type_id',
    ];
}

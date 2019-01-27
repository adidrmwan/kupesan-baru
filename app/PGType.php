<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PGType extends Model
{
    protected $table = 'pg_package_type';
    
    protected $fillable = [
        'id', 'type_id',
    ];
}

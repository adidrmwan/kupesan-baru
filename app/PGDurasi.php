<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PGDurasi extends Model
{
    protected $table = 'pg_durasi';
    public $timestamps = true;
    protected $fillable = [
        'partner_id','package_id', 'durasi_jam', 'durasi_harga',
    ];
}

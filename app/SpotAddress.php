<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpotAddress extends Model
{
    protected $table = 'ps_spot_address';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'user_id','package_id', 'pr_addr', 'pr_prov',
        'pr_kota','pr_kel', 'pr_kec', 'pr_postal_code', 'flag',
    ];
}

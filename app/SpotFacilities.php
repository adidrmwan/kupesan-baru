<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpotFacilities extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'ps_spot_facilities';
    public $timestamps = true;
    
    protected $fillable = [
        'facilities_id',
        'user_id',
        'package_id',
        'toilet',
        'wifi',
        'rganti',
        'parkir',
        'ac'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}

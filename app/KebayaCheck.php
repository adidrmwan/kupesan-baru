<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KebayaCheck extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'kebaya_booking_check';
    public $timestamps = true;
    protected $dates = ['created_at', 'updated_at', 'booking_date'];
    
    protected $fillable = [
        'partner_id',
        'package_id',
        'booking_date',
        'kuantitas',
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }
}

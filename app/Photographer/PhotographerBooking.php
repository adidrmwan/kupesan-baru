<?php

namespace App\Photographer;

use Illuminate\Database\Eloquent\Model;

class PhotographerBooking extends Model
{
    protected $primaryKey = 'booking_id';
    protected $table = 'pgr_booking';
    public $timestamps = true;
    protected $dates = ['created_at', 'updated_at', 'start_date', 'end_date'];
    protected $fillable = [
        'user_id',
        'partner_id',
        'package_id',
        'partner_name',
        'user_name',
        'user_nohp',
        'user_email',
        'start_date',
        'end_date',
        'quantity',
        'durasi_sewa',
        'booking_price',
        'biaya_dry_clean',
        'biaya_kirim',
        'booking_total',
        'booking_status',
        'booking_at',
        'kode_booking',
        'bukti_transfer',
        'upload_bukti_at',
        'alamat',
        'deposit',
    ];

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function partner()
    {
        return $this->belongsTo('Partner');
    }

    public function photographerpackage()
    {
        return $this->belongsTo('PhotographerPackage');
    }

}

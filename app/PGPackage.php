<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PGPackage extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'pg_package';
    public $timestamps = true;
    
    protected $fillable = [
        'partner_id',
        'partner_name',
        'pg_category',
        'pg_name',
        'pg_mua',
        'pg_stylist',
        'pg_duration',
        'pg_desc',
        'pg_img_1',
        'pg_img_2',
        'pg_img_3',
        'pg_img_4',
        'pg_price',
        'pg_location_jumlah',
        'pg_album_kolase',
        'pg_album_ukuran',
        'pg_album_jumlah_hal',
        'pg_album_jumlah_foto',
        'pg_printed',
        'pg_printed_size',
        'pg_printed_frame',
        'pg_printed_jumlah',
        'pg_edited',
        'pg_edited_jumlah',
        'pg_edited_saved',
        'pg_status',

    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}

<?php

namespace App\Http\Controllers\Photographer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PGPackage;
use App\Partner;
use App\PGDurasi;
use App\PGCheck;
use App\PGBooking;
use App\Jam;
use App\User;
use App\Provinces;
use App\Regencies;
use App\Districts;
use App\Villages;
use App\PGLocationAddress;
use File;
use Image;
use Mail;
use Auth;



class BookingController extends Controller
{
    public function step1(Request $request) 
    {
        $package_id = $request->package_id;
        $package = PGPackage::where('id', $package_id)->get();
        $id = PGPackage::where('id', $package_id)->first();
        $partner = Partner::where('user_id', $id->partner_id)->first();
        $provinsi = Provinces::where('id', $partner->pr_prov)->first();
        $kota = Regencies::where('id', $partner->pr_kota)->first();
        $kecamatan = Districts::where('id', $partner->pr_kec)->first();
        $durasiPaket = PGDurasi::where('package_id', $package_id)->first();

        if (Auth::user()) {
            return redirect()->intended(route('pg.step2', ['package_id' => $package_id]));
        }

        return view('online-booking.fotostudio.step1', ['package' => $package, 'pid' => $package_id, 'partner_id' => $partner->user_id], compact('package', 'partner', 'provinsi', 'kota', 'kecamatan', 'durasiPaket'));
 
    }

    public function step2(Request $request) 
    {
        if (Auth::user()) {
            $package_id = $request->package_id;
            $package = PGPackage::where('id', $package_id)->get();
            $id = PGPackage::where('id', $package_id)->first();
            $partner_id = $id->partner_id;
            $partner = Partner::where('user_id', $partner_id)->first();
            $provinsi = Provinces::where('id', $partner->pr_prov)->first();
            $kota = Regencies::where('id', $partner->pr_kota)->first();
            $kecamatan = Districts::where('id', $partner->pr_kec)->first();
            $booking_check = PGCheck::join('pg_package', 'pg_package.id', '=', 'pg_booking_check.package_id')
                            ->where('pg_booking_check.package_id', $package_id)
                            ->where('pg_booking_check.kuantitas', '=', 1)
                            ->select('booking_date as disableDates')->get();
            $disableDates = array_column($booking_check->toArray(), 'disableDates');
            $jam = Jam::all();
            $durasiPaket = PGDurasi::where('package_id', $package_id)->first();
            if(empty($request->booking_date)) {
                return view('online-booking.pg.step2', compact('package','package_id','partner_id','partner', 'pu', 'disableDates', 'provinsi', 'kota', 'kecamatan', 'durasiPaket', 'jam'));
            }
        }
        return redirect()->route('login');
 
    }

    public function submitStep2(Request $request)
    {
        $package_id = $request->package_id;
        $start_date = $request->start_date;
        $start_date = date('Y-m-d', strtotime("$start_date"));

        if ($request->jam_mulai < 10) {
            $start_time = '0'.$request->jam_mulai.':00:00';
        } else {
            $start_time = $request->jam_mulai.':00:00';
        }
        $start_booking = date('Y-m-d H:i:s', strtotime("$start_date $start_time"));
        $package = PGPackage::find($package_id);
        $partner = Partner::where('user_id', $package->partner_id)->first();
        $partner_id = $package->partner_id;
        $cek_booking = PGBooking::where('user_id', Auth::user()->id)->where('package_id', $package_id)->where('partner_id', $partner_id)->whereDate('start_date', '=', $start_date)->first();

        if(empty($cek_booking)) {
            $booking = new PGBooking();
            $booking->user_id = Auth::user()->id;
            $booking->package_id = $package_id;
            $booking->partner_id = $package->partner_id;
            $booking->start_date = $start_booking;
            $booking->start_time = $request->jam_mulai;
            $booking->booking_status = 'cek_ketersediaan_online';
            $booking->save();
            $booking_id = $booking->booking_id;
        } else {
            $booking_id = $cek_booking->booking_id;
            $booking = PGBooking::find($booking_id);
            $booking->start_date = $start_booking;
            $booking->start_time = $request->jam_mulai;
            $booking->save();
        }

        return redirect()->intended(route('pg.step2a', ['bid' => $booking_id]));
    }

    public function step2a(Request $request) 
    {
        $booking_id = $request->bid;
        $booking = PGBooking::find($booking_id);
        $package_id = $booking->package_id;
        $partner_id = $booking->partner_id;
        $package = PGPackage::where('id', $package_id)->get();
        $package2 = PGPackage::find($package_id);
        $partner = Partner::where('user_id', $partner_id)->first();
        
        $tanggalPenyewaan = $booking->start_date;
        $provinces = Provinces::where('name', 'JAWA TIMUR')->get();
        $provinsi = Provinces::where('id', $partner->pr_prov)->first();
        $kota = Regencies::where('id', $partner->pr_kota)->first();
        $kecamatan = Districts::where('id', $partner->pr_kec)->first();
        $durasiPaket = PGDurasi::where('package_id', $package_id)->first();
        $makslokasi = $package2->pg_location_jumlah;
        
        return view('online-booking.pg.step2a', compact('package','package_id','partner_id','partner', 'durasiPaket', 'tanggalPenyewaan', 'booking_id', 'provinsi', 'kota', 'kecamatan', 'jam', 'provinces', 'makslokasi'));
    }

    public function submitStep2a(Request $request)
    {
        // dd($request);
        $booking_id = $request->booking_id;
        $booking = PGBooking::find($booking_id);

        $package_id = $booking->package_id;
        $start_date = $booking->start_date;
        $start_date = date('Y-m-d', strtotime("$start_date"));

        $time_booking = '00:00:00';
        $start_booking = date('Y-m-d H:i:s', strtotime("$start_date $time_booking"));
        $pg_booking_check = PGCheck::where('package_id', $package_id)->where('booking_date', $start_booking)->first();

        if (empty($pg_booking_check)) {
            $pg_booking_check = new PGCheck();
            $pg_booking_check->package_id = $package_id;
            $pg_booking_check->booking_date = $start_booking;
            $pg_booking_check->kuantitas = 1;
            $pg_booking_check->save();
        } else {
            return redirect()->route('pg.step2', ['package_id' => $package_id])->with('warning', 'Jasa Fotografer sudah penuh. Silahkan cari tanggal lain.');
        }

        $endtime = '23:59:59';
        $end_date = date('Y-m-d H:i:s', strtotime("$start_date $endtime"));

        $booking->end_date = $end_date;
        $booking->end_time = 23;
        $booking->save();

        $package = PGPackage::where('id', $package_id)->first();
        $makslokasi = $package->pg_location_jumlah;
        for ($i=0; $i < $makslokasi; $i++) { 
            if ($i==0) {
                $locationadd = new PGLocationAddress();
                $locationadd->user_id = Auth::user()->id;
                $locationadd->booking_id = $booking_id;
                $locationadd->loc_name = $request->location_name_1;
                $locationadd->loc_addr = $request->location_detail_1;
                $locationadd->loc_prov = $request->loc_prov;
                $locationadd->loc_kota = $request->loc_kota;
                $locationadd->loc_kel = $request->loc_kel;
                $locationadd->loc_kec = $request->loc_kec;
                $locationadd->loc_postal_code = $request->loc_postal_code;
                $locationadd->flag = 1;
                $locationadd->save();
            } else {
                $locationadd = new PGLocationAddress();
                $locationadd->user_id = Auth::user()->id;
                $locationadd->booking_id = $booking_id;
                $locationadd->loc_name = $request->location_name[$i-1];
                $locationadd->loc_addr = $request->location_detail[$i-1];
                $locationadd->flag = $i+1;
                $locationadd->save();
            }
        }

        return redirect()->intended(route('pg.step3', ['bid' => $booking_id]));
    }

    public function step3(Request $request)
    {
        dd($request);
        $booking_id = $request->bid;
        $booking = PGBooking::find($booking_id);
        $package_id = $booking->package_id;
        $package = PGPackage::where('id', $package_id)->get();
        $package2 = PGPackage::where('id', $package_id)->first();
        $partner = Partner::where('user_id', $package2->partner_id)->first();
        $partner_id = $package2->partner_id;

        $provinces = Provinces::where('name', 'JAWA TIMUR')->get();

        $booking_start_date = date('Y-m-d', strtotime("$booking->start_date"));
        $booking_end_date = date('Y-m-d', strtotime("$booking->end_date"));

        $pg_booking_check = PGCheck::where('package_id', $package_id)->whereBetween('booking_date', [$booking_start_date, $booking_end_date])->get(['kuantitas']);

        $kuantitas = '0';
        // cek berapa banyak busana yang sudah terbooking pada tanggal yang dipilih, ambil yang paling maks
        foreach ($pg_booking_check as $key => $value) {
            if (empty($value->kuantitas) || $value = '0') {
                    $kuantitas = 1;
                    $value->kuantitas = $kuantitas;
                }    
        }
        
        $provinsi = Provinces::where('id', $partner->pr_prov)->first();
        $kota = Regencies::where('id', $partner->pr_kota)->first();
        $kecamatan = Districts::where('id', $partner->pr_kec)->first();
        $durasiPaket = PGDurasi::where('package_id', $package_id)->first();
        
        if ($kuantitas == '0') {
            return redirect()->route('pg.step2', ['package_id' => $package_id])->with('warning', 'Stok kebaya sudah tidak tersedia.');
        }

        return view('online-booking.pg.step3', compact('partner', 'quantity2', 'partner_id', 'package_id', 'package', 'package2', 'booking', 'booking_id', 'pu', 'provinces', 'provinsi', 'kota', 'kecamatan', 'biayaSewa'));    

    }
}

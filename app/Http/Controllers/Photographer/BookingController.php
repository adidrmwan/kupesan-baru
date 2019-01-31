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

            $durasiPaket = PGDurasi::where('package_id', $package_id)->first();
            if(empty($request->booking_date)) {
                return view('online-booking.pg.step2', compact('package','package_id','partner_id','partner', 'pu', 'disableDates', 'provinsi', 'kota', 'kecamatan', 'durasiPaket'));
            }
        }
        return redirect()->route('login');
 
    }

    public function submitStep2(Request $request)
    {
        $package_id = $request->package_id;
        $start_date = $request->start_date;
        $time = '00:00:00';
        $start_date = date('Y-m-d H:i:s', strtotime("$start_date $time"));

        $package = PGPackage::find($package_id);
        $partner = Partner::where('user_id', $package->partner_id)->first();
        $partner_id = $partner->partner_id;

        if(empty($booking_id)) {
            $booking = new PGBooking();
            $booking->user_id = Auth::user()->id;
            $booking->package_id = $package_id;
            $booking->partner_id = $package->partner_id;
            $booking->start_date = $start_date;
            $booking->booking_status = 'cek_ketersediaan_online';
            $booking->save();
            $booking_id = $booking->booking_id;
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
        
        $tanggalPenerimaan = $booking->start_date;
        
        $provinsi = Provinces::where('id', $partner->pr_prov)->first();
        $kota = Regencies::where('id', $partner->pr_kota)->first();
        $kecamatan = Districts::where('id', $partner->pr_kec)->first();
        $durasiPaket = PGDurasi::where('package_id', $package_id)->first();

        $jam = Jam::all();
        return view('online-booking.pg.step2a', compact('package','package_id','partner_id','partner', 'durasiPaket', 'tanggalPenerimaan', 'booking_id', 'provinsi', 'kota', 'kecamatan', 'jam'));
    }

    public function submitStep2a(Request $request){
        $booking_id = $request->booking_id;
        if ($request->jam_mulai < 10) {
            $starttime = '0'.$request->jam_mulai.':00:00';
        } else {
            $starttime = $request->jam_mulai.':00:00';
        }
        $booking = PGBooking::find($booking_id);
        $package_id = $booking->package_id;
        $start_date = $booking->start_date;

        $edate = $start_date->addDays(1);
        $endtime = '23:59:59';
        $end_date = date('Y-m-d H:i:s', strtotime("$edate $endtime"));
        
        $sdate = date('Y-m-d', strtotime("$start_date"));
        $start_date = date('Y-m-d H:i:s', strtotime("$sdate $starttime"));

        $booking->start_time = $request->jam_mulai;
        $booking->start_date = $start_date;
        $booking->end_date = $end_date;
        $booking->save();

        $durasi_sewa = 1;

        for ($i=0; $i < $durasi_sewa; $i++) { 
            $booking_date = $booking->start_date->addDays($i);
            $cek_booking_sdate = PGCheck::where('package_id', $package_id)->where('booking_date', $booking_date)->first();
            if (empty($cek_booking_sdate)) {
                $booking_check = new PGCheck();
                $booking_check->package_id = $package_id;
                $booking_check->booking_date = $booking_date;
                $booking_check->save();
            }
        }
            return redirect()->intended(route('pg.step3', ['bid' => $booking_id]));
    }

    public function step3(Request $request)
    {
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

<?php

namespace App\Http\Controllers\Photographer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PGPackage;
use App\Partner;
use App\PGDurasi;
use App\PGCheck;
use File;
use Image;
use App\User;
use Mail;
use Auth;
use App\Provinces;
use App\Regencies;
use App\Districts;
use App\Villages;


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

        $package = KebayaProduct::find($package_id);

        $partner = Partner::where('user_id', $package->partner_id)->first();
        $partner_id = $partner->user_id;

        if(empty($booking_id)) {
            $booking = new KebayaBooking();
            $booking->user_id = Auth::user()->id;
            $booking->package_id = $package_id;
            $booking->partner_id = $package->partner_id;
            $booking->start_date = $start_date;
            $booking->booking_status = 'cek_ketersediaan_online';
            $booking->save();
            $booking_id = $booking->booking_id;
        }
        
        return redirect()->intended(route('kebaya.step2a', ['bid' => $booking_id]));
        
    }
}

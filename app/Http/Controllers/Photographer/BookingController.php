<?php

namespace App\Http\Controllers\Photographer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\PGLocationAddress;
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
use Carbon\Carbon;
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

        return view('online-booking.pg.step1', ['package' => $package, 'pid' => $package_id, 'partner_id' => $partner->user_id], compact('package', 'partner', 'provinsi', 'kota', 'kecamatan', 'durasiPaket'));
 
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
        $user = Auth::user();
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
            $pg_booking_check->user_id = Auth::user()->id;
            $pg_booking_check->save();

            $endtime = '23:59:59';
            $end_date = date('Y-m-d H:i:s', strtotime("$start_date $endtime"));
            $package = PGPackage::where('id', $package_id)->first();

            $booking->end_date = $end_date;
            $booking->end_time = 23;
            $booking->user_name = $user->first_name.' '.$user->last_name;
            $booking->user_nohp = $user->phone_number;
            $booking->user_email = $user->email;
            $booking->booking_price = $package->pg_price;
            $booking->booking_total = $package->pg_price;
            $booking->partner_name = $package->partner_name;
            $booking->save();

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
        } elseif (Auth::user()->id != $pg_booking_check->user_id) {
            return redirect()->route('pg.step2', ['package_id' => $package_id])->with('warning', 'Jasa Fotografer sudah penuh. Silahkan cari tanggal lain.');
        } else {
            $package = PGPackage::where('id', $package_id)->first();
            $pglog = PGLocationAddress::where('user_id', Auth::user()->id)->where('booking_id', $booking_id)->get();
            foreach ($pglog as $key => $locationadd) {
                if ($locationadd->flag == 1) {
                    $locationadd->loc_name = $request->location_name_1;
                    $locationadd->loc_addr = $request->location_detail_1;
                    $locationadd->loc_prov = $request->loc_prov;
                    $locationadd->loc_kota = $request->loc_kota;
                    $locationadd->loc_kel = $request->loc_kel;
                    $locationadd->loc_kec = $request->loc_kec;
                    $locationadd->loc_postal_code = $request->loc_postal_code;
                    $locationadd->save();
                } elseif ($locationadd->flag > 1) {
                    $locationadd->loc_name = $request->location_name[$key-1];
                    $locationadd->loc_addr = $request->location_detail[$key-1];
                    $locationadd->save();
                }
            }
        }

        return redirect()->intended(route('pg.step3', ['bid' => $booking_id]));
    }

    public function step3(Request $request)
    {
        $booking_id = $request->bid;
        $booking = PGBooking::find($booking_id);
        // dd($booking);
        $package_id = $booking->package_id;

        $provinces = Provinces::where('name', 'JAWA TIMUR')->get();
        $package = PGPackage::where('id', $package_id)->get();
        $package2 = PGPackage::where('id', $package_id)->first();
        $partner = Partner::where('user_id', $package2->partner_id)->first();
        $partner_id = $package2->partner_id;
        $provinsi = Provinces::where('id', $partner->pr_prov)->first();
        $kota = Regencies::where('id', $partner->pr_kota)->first();
        $kecamatan = Districts::where('id', $partner->pr_kec)->first();
        $durasiPaket = PGDurasi::where('package_id', $package_id)->first();
        
        $detail_pesanan = PGBooking::where('booking_id', $booking_id)->get();
        $pglog = PGLocationAddress::where('user_id', Auth::user()->id)->where('booking_id', $booking_id)->get();

        return view('online-booking.pg.step4', compact('partner', 'partner_id', 'package_id', 'package', 'package2', 'booking', 'booking_id', 'pu', 'provinces', 'provinsi', 'kota', 'kecamatan', 'durasiPaket', 'detail_pesanan', 'pglog'));    

    }

    public function submitStep4(Request $request)
    {
        $booking = PGBooking::find($request->booking_id);
        $partner_id = $booking->partner_id;
        $package_id = $booking->package_id;
        $partner = Partner::where('user_id', $partner_id)->first();
        $package = PGPackage::where('id', $package_id)->get();
        $package2 = PGPackage::where('id', $package_id)->first();
        
        if ($booking->booking_status == 'cek_ketersediaan_online' || $booking->booking_status == 'un_approved') {
            $book = PGBooking::where('booking_id', $booking->booking_id)->select('booking_id')->first()->toArray();
            $user = PGBooking::join('pg_package', 'pg_package.id', '=', 'pg_booking.package_id')
                    ->join('pg_location_address', 'pg_location_address.booking_id', '=', 'pg_booking.booking_id')
                    ->join('partner', 'pg_booking.partner_id', '=', 'partner.user_id')
                    ->join('users', 'users.id', '=', 'partner.user_id')
                    ->select( 'pg_package.*', 'pg_booking.*', 'partner.pr_name', 'users.email', 'users.id',  'users.first_name', 'users.last_name')
                    ->where('pg_booking.booking_id', $booking->booking_id)->first()->toArray();
            if($booking->booking_status != 'un_approved') {
                $user['link'] = str_random(35);
                DB::table('booking_activations_pg')->insert(['id_user'=>$user['id'], 'booking_id'=>$book['booking_id'], 'token'=>$user['link']]);
                Mail::send('emails.booking-notification.pg', $user, function($message) use ($user){
                  $message->to($user['email']);
                  $message->subject('Kupesan.id | Notifikasi Pesanan Pelanggan');
                });
                if ($booking->booking_status == 'cek_ketersediaan_online') {
                    $booking->booking_status = 'un_approved';
                    $booking->save();
                }
            }
        } else {
            return redirect()->route('dashboard');
        }

        $provinsi = Provinces::where('id', $partner->pr_prov)->first();
        $kota = Regencies::where('id', $partner->pr_kota)->first();
        $kecamatan = Districts::where('id', $partner->pr_kec)->first();
        $durasiPaket = PGDurasi::where('package_id', $package_id)->first();
        

        return view('online-booking.pg.step5', compact('partner', 'package', 'provinsi', 'kota', 'kecamatan', 'durasiPaket'));
    }

    public function step6(Request $request)
    {
        if (Auth::check()) {
            $user_id = Auth::user()->id;
            $booking = PGBooking::find($request->bid);
            $package_id = $booking->package_id;
            $partner_id = $booking->partner_id;
            $bid = $booking->booking_id;

            $package = PGPackage::where('id', $package_id)->get();
            $package2 = PGPackage::where('id', $package_id)->first();
            $partner = Partner::where('user_id', $partner_id)->first();
            $provinsi = Provinces::where('id', $partner->pr_prov)->first();
            $kota = Regencies::where('id', $partner->pr_kota)->first();
            $kecamatan = Districts::where('id', $partner->pr_kec)->first();
            $durasiPaket = PGDurasi::where('package_id', $package_id)->first();
            $pglog = PGLocationAddress::where('user_id', Auth::user()->id)->where('booking_id', $bid)->get();

            $review = PGBooking::join('pg_package', 'pg_package.id', '=', 'pg_booking.package_id')
                ->select('pg_package.*', 'pg_booking.*')
                ->where('booking_id', $bid)->get();

            return view('online-booking.pg.step6', compact('bid', 'review', 'package', 'package2', 'partner', 'provinsi', 'kota', 'kecamatan', 'durasiPaket', 'pglog'));
        }

        return redirect()->route('index');
    }

    public function step7(Request $request)
    {   
        $mytime = Carbon::now();
        $waktu = $mytime->toDateTimeString();        
        $bid = $request->bid;
        $booking = PGBooking::find($request->bid);

        if(!empty($booking->upload_bukti_at)) {
            return redirect()->intended(route('pg.step9', ['bid' => $bid])); 
        }

        if(empty($booking->booking_at)) {
            $booking_at = date("Y-m-d H:i:s", strtotime("+1 hours"));
            $booking->booking_at = $booking_at;
            $booking->save();
        }
        
        if($waktu >= $booking->booking_at) {
            $booking->booking_status = 'booking-failed';
            $booking->save();
            return view('online-booking.pg.failed');
        }

        $booking->booking_status = 'on_pembayaran';
        $booking->save();
        $deadline = $booking->booking_at;

        $review = PGBooking::join('pg_package', 'pg_package.id', '=', 'pg_booking.package_id')
                ->select('pg_package.*', 'pg_booking.*')
                ->where('booking_id', $bid)->get();

        return view('online-booking.pg.step7', compact('review', 'bid', 'deadline'));
    }

    public function step8(Request $request)
    {   
        $bid = $request->bid;
        $booking = PGBooking::find($bid);
        if(!empty($booking->upload_bukti_at)) {
            return redirect()->intended(route('pg.step9', ['bid' => $bid])); 
        }
        return view('online-booking.pg.step8', compact('bid'));
    }

    public function uploadBukti(Request $request)
    {   
        $mytime = Carbon::now();
        $time = $mytime->toDateTimeString();    
        $bid = $request->bid;
        $booking = PGBooking::find($bid);
        if(empty($booking->upload_bukti_at)) {
            $booking->bukti_transfer = 'PG_' . $booking->booking_date . '_' . $booking->booking_id . '_' . $booking->user_id. '_' . $booking->booking_total;
            $booking->upload_bukti_at = $time;
            $booking->booking_status = 'paid';
            $booking->save();
        }

        if ($request->hasFile('bukti_pembayaran')) {
            $foto_new = $booking->bukti_transfer;
            if( File::exists(public_path('/bukti_pembayaran/' . $foto_new .'.jpeg' ))){
                File::delete(public_path('/bukti_pembayaran/' . $foto_new .'.jpeg' ));
            }
            if( File::exists(public_path('/bukti_pembayaran/' . $foto_new .'.jpg' ))){
                File::delete(public_path('/bukti_pembayaran/' . $foto_new .'.jpg' ));
            }
            if( File::exists(public_path('/bukti_pembayaran/' . $foto_new .'.png' ))){
                File::delete(public_path('/bukti_pembayaran/' . $foto_new .'.png' ));
            }

            $foto = $request->file('bukti_pembayaran');
            $foto_name = $foto_new . '.' .$foto->getClientOriginalExtension();
            Image::make($foto)->save( public_path('/bukti_pembayaran/' . $foto_name ) );
            $booking = PGBooking::find($bid);
            $booking->save();
        }    
        
        
        return redirect()->intended(route('pg.step9', ['bid' => $bid])); 
    }

    public function step9(Request $request)
    { 
        $bid = $request->bid;
        $review = PGBooking::join('pg_package', 'pg_package.id', '=', 'pg_booking.package_id')
                ->select('pg_package.*', 'pg_booking.*')
                ->where('booking_id', $bid)->get();

        return view('online-booking.pg.step9', ['review' => $review]);
    }
}

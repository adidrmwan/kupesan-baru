<?php

namespace App\Http\Controllers\Photographer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use App\PGLocationAddress;
use App\PGPackage;
use App\Partner;
use App\PGDurasi;
use App\PGCheck;
use App\PGBooking;
use App\Provinces;
use App\Regencies;
use App\Districts;
use App\Villages;
use App\Booking;
use App\PSPkg;
use App\Jam;
use App\User;
use Carbon\Carbon;
use Image;
Use Alert;
use Auth;
use File;
use Mail;
use App\Tnc;
use DateTime;

class PartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $user = Auth::user();
        $partner = DB::table('partner')
                    ->where('user_id',$user->id)
                    ->select('*')
                    ->first();

        if (empty($partner->pr_name)) {
            return redirect()->intended(route('partner.profile.form'));
        }

        $booking_unapprove = PGBooking::join('pg_package', 'pg_package.id', '=', 'pg_booking.package_id')
                            ->where('pg_booking.booking_status', 'un_approved')
                            ->where('pg_package.partner_id', $user->id)
                            ->select('pg_booking.booking_id', 'pg_booking.user_id', 'pg_booking.package_id','pg_package.pg_name', 'pg_package.pg_mua', 'pg_package.pg_stylist', 'pg_package.pg_location_jumlah', 'pg_booking.start_date', 'pg_booking.booking_price', 'pg_booking.booking_total', 'pg_booking.updated_at')
                            ->orderBy('pg_booking.updated_at', 'desc')
                            ->get();
        
        return view('partner.home', ['partner' => $partner], compact('booking_unapprove'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function profile()
    {
        $user = Auth::user();
        $partner = DB::table('partner')
                    ->where('user_id',$user->id)
                    ->select('*')
                    ->first();

        if ($partner->status == '0') {
            return view('partner.home', ['partner' => $partner]);

        }
        else {
            $type = DB::table('partner_type')
                    ->where('partner_type.id', '=', $partner->pr_type)
                    ->first();
            $phone_number = $user->phone_number;
            $jam = Jam::all();
            $provinces = Provinces::where('name', 'JAWA TIMUR')->get();
            $partner_prov = Provinces::where('id', $partner->pr_prov)->first();
            $partner_kota = Regencies::where('id', $partner->pr_kota)->first();
            $partner_kel = Villages::where('id', $partner->pr_kel)->first();
            $partner_kec = Districts::where('id', $partner->pr_kec)->first();
            $email = $user->email;
            $fasilitas = DB::table('facilities_partner')->where('user_id', $user->id)->select('*')->first();
            $tnc = Tnc::where('partner_id', $user->id)->get();
            $partner->pr_type = '1';
            $subkategori = DB::table('partner_type')
                    ->where('partner_type.id', '=', $partner->pr_subtype)
                    ->first();

        }
        return view('partner.pg.profile', ['partner' => $partner, 'data' => $partner, 'type' => $type, 'email' => $email, 'jam' => $jam, 'fasilitas' => $fasilitas, 'phone_number' => $phone_number], compact('provinces', 'partner_prov', 'partner_kota', 'partner_kel', 'partner_kec','subkategori', 'tnc'));
    }

    public function updateProfile(Request $request){
        $user = Auth::user();
        $partner = Partner::where('user_id', $user->id)->first();
        $partner->pr_owner_name = $request->input('pr_owner_name');
        $partner->pr_addr = $request->input('pr_addr');
        $partner->pr_kel = $request->input('pr_kel');
        $partner->pr_kec = $request->input('pr_kec');
        $partner->pr_area = $request->input('pr_area');
        $partner->pr_postal_code = $request->input('pr_postal_code');
        $partner->pr_desc = $request->input('pr_desc');
        $partner->pr_phone = $request->input('pr_phone');
        $partner->pr_phone2 = $request->input('pr_phone2');
        $partner->open_hour = $request->input('open_hour');
        $partner->close_hour = $request->input('close_hour');
        $partner->save();
        
        $logo = Partner::where('user_id', $user->id)->first();
        $logo->pr_logo = $logo->id . '_' . $logo->pr_type . '_' . $logo->pr_name;
        $logo->save();
        
        if ($request->hasFile('pr_logo')) {
            //Found existing file then delete
            $foto_new = $logo->pr_logo;
            if( File::exists(public_path('/logo/' . $foto_new .'.jpeg' ))){
                File::delete(public_path('/logo/' . $foto_new .'.jpeg' ));
            }
            if( File::exists(public_path('/logo/' . $foto_new .'.jpg' ))){
                File::delete(public_path('/logo/' . $foto_new .'.jpg' ));
            }
            if( File::exists(public_path('/logo/' . $foto_new .'.png' ))){
                File::delete(public_path('/logo/' . $foto_new .'.png' ));
            }
            $foto = $request->file('pr_logo');
            $foto_name = $foto_new . '.' .$foto->getClientOriginalExtension();
            Image::make($foto)->save( public_path('/logo/' . $foto_name ) );
            $user = Auth::user();
            $logo = Partner::where('user_id', $user->id)->first();
            $logo->save();
        }
        return redirect()->intended(route('pg.profile'));
    }

    public function bookingActivationPG($token)
    {
      $check = DB::table('booking_activations_pg')->where('token',$token)->first();
      if(!is_null($check)){
        $user = User::find($check->id_user);
        $bid = $check->booking_id;

        if ($user->is_activated == 1){
            if(Auth::check()) {
                return redirect()->route('partner.dashboard');
            } else {
                return redirect()->route('mitra.login');
            }
        }

        $user->update(['is_activated' => 1]);

        return redirect()->route('partner.dashboard');
      }
      return redirect()->to('home')->with('Warning',"Your token is invalid");
    } 

    public function cancelBooking(Request $request)
    {
        $booking_id = $request->id;
        $booking = PGBooking::find($booking_id);

        $book = PGBooking::where('booking_id', $booking_id)->select('booking_id')->first()->toArray();
        $user = PGBooking::join('users', 'users.id', '=', 'pg_booking.user_id')
                ->join('pg_package', 'pg_package.id', '=', 'pg_booking.package_id')
                ->where('pg_booking.booking_id', $booking_id)
                ->first()->toArray();
        Mail::send('emails.booking-cancel-pg', $user, function($message) use ($user){
          $message->to($user['email']);
          $message->subject('Kupesan.id | Pesanan Tidak Tersedia');
        });
        
        $booking->booking_status = 'canceled_by_partner';
        $booking->save();

        return redirect()->back();
    }

    public function showStep1()
    {
        $user = Auth::user();
        $partner = DB::table('partner')
                    ->where('user_id',$user->id)
                    ->select('*')
                    ->first();
        $package = PGPackage::where('partner_id', $user->id)
                    ->where('status', '1')->get();
        return view('partner.pg.booking.step1', compact('package', 'partner'));    
    }

    public function showStep2(Request $request)
    {
        $user = Auth::user();
        $partner = DB::table('partner')
                    ->where('user_id',$user->id)
                    ->select('*')
                    ->first();
        $product_id = $request->product_id;
        $package = PGPackage::where('pg_package.id', $product_id)->get();
        $package2 = PGPackage::find($product_id);

        $booking_check = PGCheck::join('pg_package', 'pg_package.id', '=', 'pg_booking_check.package_id')
                            ->where('pg_booking_check.package_id', $product_id)
                            ->where('pg_booking_check.kuantitas', '=', 1)
                            ->select('booking_date as disableDates')->get();
        $disableDates = array_column($booking_check->toArray(), 'disableDates');

        $durasiPaket = PGDurasi::where('package_id', $product_id)->first();
        return view('partner.pg.booking.step2', ['partner' => $partner], compact('dates', 'package', 'product_id', 'disableDates', 'durasiPaket'));    
    }

    public function submitStep2(Request $request)
    {
        $user = Auth::user();
        $user_name = $request->user_name;
        $user_nohp = $request->user_nohp;
        $user_email = $request->user_email;
        $package_id = $request->product_id;
        $product_id = $package_id;
        $partner = DB::table('partner')
                    ->where('user_id',$user->id)
                    ->select('*')
                    ->first();
        $package = PGPackage::where('id', $product_id)->first();

        $sdate = explode('/', $request->start_date, 3); $sm = $sdate[0]; $sd = $sdate[1]; $sy = $sdate[2];
        $start_date = $sy.'-'.$sm.'-'.$sd;
        $start_time = '00:00:00';
        $start_booking = date('Y-m-d H:i:s', strtotime("$start_date $start_time"));
        
        $package = PGPackage::find($package_id);
        $partner = Partner::where('user_id', $package->partner_id)->first();
        $partner_id = $package->partner_id;

        $durasiPaket = PGDurasi::where('package_id', $product_id)->first();
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
            $booking->user_name = $user_name;
            $booking->user_nohp = $user_nohp;
            $booking->user_email = $user_email;
            $booking->booking_price = $package->pg_price;
            $booking->booking_total = $package->pg_price;
            $booking->partner_name = $package->partner_name;
            $booking->save();
            return redirect()->intended(route('pg.off-booking.step3', compact('booking_id', 'durasiPaket')));
        } elseif (Auth::user()->id != $pg_booking_check->user_id) {
            return redirect()->route('pg.off-booking')->with('warning', 'Jasa Fotografer sudah penuh. Silahkan cari tanggal lain.');
        }

        return view('partner.pg.booking.step1', ['partner' => $partner]);    
    }

    public function showStep3(Request $request)
    {
        $user = Auth::user();
        $partner = DB::table('partner')
                    ->where('user_id',$user->id)
                    ->select('*')
                    ->first();

        $booking = PGBooking::find($request->booking_id);
        $package = PGPackage::where('id', $booking->package_id)->get();
        $package2 = PGPackage::where('id', $booking->package_id)->first();
        $package_id = $package2->id;
        $booking_id = $booking->booking_id;

        $durasiPaket = PGDurasi::where('package_id', $package_id)->first();

        return view('partner.pg.booking.step3', ['partner' => $partner], compact('quantity2', 'package_id', 'package', 'booking', 'booking_id', 'durasiPaket'));    

    }

    public function submitStep3(Request $request)
    {
        $user = Auth::user();
        $partner = DB::table('partner')
                    ->where('user_id',$user->id)
                    ->select('*')
                    ->first();
        
        $booking = PGBooking::find($request->booking_id);
        $package = PGPackage::where('id', $booking->package_id)->get();
        $package2 = PGPackage::where('id', $booking->package_id)->first();
        $package_id = $package2->id;
        $booking_id = $booking->booking_id;

        if(empty($booking->kode_booking)) {
            $kode_booking = '4P'.str_random(7);
            $booking->booking_status = 'offline-booking';
            $booking->kode_booking = strtoupper($kode_booking);
            $booking->save();
        }
        $detail_pesanan = PGBooking::join('pg_package', 'pg_package.id', '=', 'pg_booking.package_id')
                            ->where('booking_id', $request->booking_id)
                            ->select('pg_package.*', 'pg_booking.*')->get();
        $durasiPaket = PGDurasi::where('package_id', $package_id)->first();
        return view('partner.pg.booking.step5', ['partner' => $partner], compact('package_id', 'package', 'booking', 'booking_id', 'detail_pesanan', 'durasiPaket')); 
    }

    public function showBookingSchedule(Request $request)
    {   
        $user = Auth::user();
        $partner = DB::table('partner')
                    ->where('user_id',$user->id)
                    ->select('*')
                    ->first();

        $title = 'Libur';
        $events = [];
        $data = PGBooking::join('pg_package', 'pg_package.id', '=', 'pg_booking.package_id')
                    ->where('pg_booking.partner_id', $user->id)->get();
        if($data->count()) {
            foreach ($data as $key => $value) {
                $title = $value->user_name.' - '.$value->name;
                if($value->booking_status == 'confirmed') {
                    $events[] = Calendar::event(
                    $title,
                    false,
                    $value->start_date,
                    $value->end_date,
                    null,
                    // Add color and link on event
                     [
                         'color' => '#28a745',
                         'url' => route('pg.detail.booking', ['booking_id' => $value->booking_id]),
                     ]
                    );
                }
                elseif($value->booking_status == 'libur') {
                    $events[] = Calendar::event(
                    $title,
                    false,
                    $value->start_date,
                    $value->end_date,
                    null,
                    // Add color and link on event
                     [
                         'color' => '#dc3545',
                         'url' => '#',
                     ]
                    );
                }elseif($value->booking_status == 'offline-booking') {
                    $events[] = Calendar::event(
                    $title,
                    false,
                    $value->start_date,
                    $value->end_date,
                    null,
                    // Add color and link on event
                     [
                         'color' => '#ffc107',
                         'textColor' => '#000000',
                         'url' => route('pg.detail.booking', ['booking_id' => $value->booking_id]),
                     ]
                    );
                }
            }
        }
        $calendar = Calendar::addEvents($events);
        
        $mytime = Carbon::now();
        $waktu = $mytime->toDateTimeString();        
        $waktu2 = explode(' ', $waktu);
        $now_date = $waktu2[0];
        $now_time = $waktu2[1];
        
        $booking = PGBooking::join('pg_package', 'pg_package.id', '=', 'pg_booking.package_id')
                    ->where('pg_booking.partner_id', $user->id)
                    ->where('pg_booking.booking_status', 'offline-booking')
                    ->orwhere('pg_booking.booking_status', 'confirmed')
                    ->where('pg_booking.partner_id', $user->id)
                    ->select('pg_booking.*', 'pg_package.pg_name', 'pg_package.pg_mua', 'pg_package.pg_stylist')
                    ->orderBy('pg_booking.start_date', 'asc')->get();
        return view('partner.pg.booking.schedule', ['partner' => $partner], compact('calendar', 'booking'));
    }

    public function showDetailBooking(Request $request)
    {   
        $mytime = Carbon::now();
        $waktu = $mytime->toDateTimeString();        
        $waktu2 = explode(' ', $waktu);
        $now_date = $waktu2[0];
        $now_time = $waktu2[1];
        
        $booking_id = $request->booking_id;
        $user = Auth::user();
        $partner = DB::table('partner')
                    ->where('user_id',$user->id)
                    ->select('*')
                    ->first();
        $package_id = PGBooking::where('booking_id', $booking_id)->select('package_id')->first();
        $package = PGPackage::where('id', $package_id->package_id)->first();

        $booking =  PGBooking::join('pg_package', 'pg_package.id', '=', 'pg_booking.package_id')
                            ->where('booking_id', $booking_id)
                            ->select('pg_package.*', 'pg_booking.*')
                            ->get();
        $booking2 = PGBooking::where('booking_id', $booking_id)->first();
        $booking_start_date = date('Y-m-d', strtotime("$booking2->start_date"));        
        $pglog = PGLocationAddress::where('user_id', $booking2->user_id)->where('booking_id', $booking_id)->get();            
        if($booking_start_date != $now_date){
            $flag_date = 0; //can't order
        } else {
            $flag_date = 1; //can order
        }
        return view('partner.pg.detail-booking', ['partner' => $partner, 'booking' => $booking, 'package' => $package], compact('flag_date', 'booking2', 'pglog'));
    }

    public function showBookingHistory()
    {   
        $user = Auth::user();
        $partner = DB::table('partner')
                    ->where('user_id',$user->id)
                    ->select('*')
                    ->first();

        $booking = PGBooking::join('pg_package', 'pg_package.id', '=', 'pg_booking.package_id')
                    ->where('pg_booking.partner_id', $user->id)
                    ->where('pg_booking.booking_status', 'done')
                    ->orwhere('pg_booking.booking_status', 'offline-booking-done')
                    ->select('pg_booking.*', 'pg_package.pg_name', 'pg_package.pg_mua', 'pg_package.pg_stylist')
                    ->orderBy('pg_booking.start_date', 'asc')->get();

        $booking_offline = PGBooking::join('pg_package', 'pg_package.id', '=', 'pg_booking.package_id')
                    ->where('pg_booking.partner_id', $user->id)
                    ->where('pg_booking.booking_status', 'offline-booking-cancel')
                    ->select('pg_booking.*', 'pg_package.pg_name', 'pg_package.pg_mua', 'pg_package.pg_stylist')
                    ->orderBy('pg_booking.start_date', 'asc')->get();
        return view('partner.pg.booking.history', ['partner' => $partner, 'booking' => $booking], compact('booking_offline'));
    }

    public function bookingFinished(Request $request)
    {
        // dd($request);
        $booking_id = $request->id;
        $booking = PGBooking::where('booking_id', $booking_id)->first();
        $booking->booking_status = 'offline-booking-done';
        $booking->save();

        return redirect()->back();
    }

    public function bookingFinishedOnline(Request $request)
    {
        // dd($request);
        $booking_id = $request->id;
        $booking = PGBooking::where('booking_id', $booking_id)->first();
        $booking->booking_status = 'done';
        $booking->save();

        return redirect()->route('pg.schedule');
    }

    public function offlineCancel(Request $request)
    {
        $booking_id = $request->id;
        $booking = PGBooking::where('booking_id', $booking_id)->first();
        $package_id = $booking->package_id;
        $start_booking = $booking->start_date;
        $pg_booking_check = PGCheck::where('package_id', $package_id)->where('booking_date', $start_booking)->first();
        
        if (!empty($pg_booking_check)) {
            $booking->booking_status = 'offline-booking-cancel';
            $booking->save();

            $pg_booking_check->delete();
        }


        return redirect()->back();
    }

}

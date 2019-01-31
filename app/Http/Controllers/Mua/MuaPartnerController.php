<?php

namespace App\Http\Controllers\Mua;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use App\FasilitasPartner;
use App\PartnerDurasi;
use App\KebayaBooking;
use App\KebayaUkuran;
use App\BookingCheck;
use App\Fasilitas;
use App\Provinces;
use App\Regencies;
use App\Districts;
use App\Villages;
use App\Booking;
use App\Partner;
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

class MuaPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        return view('partner.mua.profile', ['partner' => $partner, 'data' => $partner, 'type' => $type, 'email' => $email, 'jam' => $jam, 'fasilitas' => $fasilitas, 'phone_number' => $phone_number], compact('provinces', 'partner_prov', 'partner_kota', 'partner_kel', 'partner_kec','subkategori', 'tnc'));
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
        $data = KebayaBooking::join('kebaya_product', 'kebaya_product.id', '=', 'kebaya_booking.package_id')
                    ->where('kebaya_booking.partner_id', $user->id)->get();
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
                         'url' => route('detail.booking.kebaya', ['booking_id' => $value->booking_id]),
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
                         'url' => route('detail.booking.kebaya', ['booking_id' => $value->booking_id]),
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
        
        $booking = KebayaBooking::join('kebaya_product', 'kebaya_product.id', '=', 'kebaya_booking.package_id')
                    ->join('kebaya_category', 'kebaya_category.id', '=', 'kebaya_product.category')
                    ->where('kebaya_booking.partner_id', $user->id)
                    ->where('kebaya_booking.booking_status', 'offline-booking')
                    ->orwhere('kebaya_booking.booking_status', 'confirmed')
                    ->where('kebaya_booking.partner_id', $user->id)
                    ->select('kebaya_booking.*', 'kebaya_product.name', 'kebaya_product.size', 'kebaya_product.set', 'kebaya_category.category_name')
                    ->orderBy('kebaya_booking.start_date', 'asc')->get();


        return view('partner.mua.booking.schedule', ['partner' => $partner], compact('calendar', 'booking'));
    }

    public function showFormDayOff()
    {
        $user = Auth::user();
        $partner = DB::table('partner')
                    ->where('user_id',$user->id)
                    ->select('*')
                    ->first();
        if ($partner->status == '0') {
            return view('partner.home', ['partner' => $partner]);
        }
        
        return view('partner.mua.dayoff', ['partner' => $partner], compact('jam', 'disableDates'));        
        
    }
    
    public function submitFormDayOff(Request $request)
    {
        $user = Auth::user();
        $partner = Partner::where('user_id', $user->id)->first();
        $tanggal_libur = $request->Tanggal_libur;
        $durasi_libur = $request->durasi_libur;
        $judul = $request->judul;
        
        $time = '00:00:00';
        $dayoff_date = date('Y-m-d H:i:s', strtotime("$tanggal_libur $time"));
        
        $bookingcheck = new KebayaCheck();
        $bookingcheck->package_id = '10000'.$user->id;
        $bookingcheck->booking_date = $dayoff_date;
        $bookingcheck->save();
        
        $temp_day_off_sub = $bookingcheck->booking_date;
        $day_off_sub = $temp_day_off_sub->subDays(1);
        
        $temp_start_dayoff = $bookingcheck->booking_date;
        $temp_end_dayoff = $temp_start_dayoff->addDays($durasi_libur);
        
        $end_dayoff = date('Y-m-d', strtotime("$temp_end_dayoff"));
        
        $temp_show_end_dayoff = $temp_end_dayoff;
        $temp2_show_end_dayoff = $temp_show_end_dayoff->subDays(1);
        $show_end_dayoff = date('Y-m-d', strtotime("$temp2_show_end_dayoff"));
        
        $package = KebayaProduct::where('partner_id', $user->id)->get();
        
        $package_dayoff = new KebayaProduct();
        $package_dayoff->partner_id = $user->id;
        $package_dayoff->partner_name = $partner->pr_name;
        $package_dayoff->status = '8';
        $package_dayoff->save();
        
        for ($i=0; $i < $durasi_libur; $i++) { 
            $date_dayoff = $day_off_sub->addDays(1);
            $dayoff = date('Y-m-d', strtotime("$date_dayoff"));
            
            foreach ($package as $key => $value) {
                $cek_booking_dayoff = KebayaCheck::where('package_id', $value->id)->where('booking_date', $dayoff)->first();
                if(!empty($cek_booking_dayoff->kuantitas) && $cek_booking_dayoff->kuantitas == $value->quantity) {
                    return redirect()->back()->with('error', 'Cek Booking Schedule Anda! Ada pesanan pada tanggal '.$dayoff);
                }
            }
            
            foreach ($package as $key => $value) {
                $bookingcheck = new KebayaCheck();
                $bookingcheck->package_id = $value->id;
                $bookingcheck->booking_date = $dayoff;
                $bookingcheck->kuantitas = $value->quantity;
                $bookingcheck->save();
                
            }
        }
        
        $jam_mulai = '00:00:00';
        $booking_start_date = date('Y-m-d H:i:s', strtotime("$tanggal_libur $jam_mulai"));
        $jam_selesai = '00:00:00';
        $booking_end_date = date('Y-m-d H:i:s', strtotime("$end_dayoff $jam_selesai"));
        $booking = new KebayaBooking();
        $booking->user_id = $user->id;
        $booking->partner_id = $user->id;
        $booking->start_date = $booking_start_date;
        $booking->end_date = $booking_end_date;
        $booking->booking_status = 'libur';
        $booking->partner_name = $judul;
        $booking->package_id = $package_dayoff->id;
        $booking->save();
        
        return redirect()->back()->with('success', 'Berhasil menambahkan hari libur pada tanggal '.$tanggal_libur.' sampai dengan '.$show_end_dayoff);
    }

    public function showBookingHistory()
    {   
        $user = Auth::user();
        $partner = DB::table('partner')
                    ->where('user_id',$user->id)
                    ->select('*')
                    ->first();

        $booking = KebayaBooking::join('kebaya_product', 'kebaya_product.id', '=', 'kebaya_booking.package_id')
                    ->where('kebaya_booking.partner_id', $user->id)
                    ->where('kebaya_booking.booking_status', 'done')
                    ->orwhere('kebaya_booking.booking_status', 'offline-booking-done')
                    ->select('kebaya_booking.*', 'kebaya_product.name', 'kebaya_product.size', 'kebaya_product.set')
                    ->orderBy('kebaya_booking.start_date', 'asc')->get();

        $booking_offline = KebayaBooking::join('kebaya_product', 'kebaya_product.id', '=', 'kebaya_booking.package_id')
                    ->where('kebaya_booking.partner_id', $user->id)
                    ->where('kebaya_booking.booking_status', 'offline-booking-cancel')
                    ->select('kebaya_booking.*', 'kebaya_product.name', 'kebaya_product.size', 'kebaya_product.set')
                    ->orderBy('kebaya_booking.start_date', 'asc')->get();
        // dd($booking_offline);
        return view('partner.kebaya.booking.history', ['partner' => $partner, 'booking' => $booking], compact('booking_offline'));
    }
}

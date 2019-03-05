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
use File;
use Image;
use Mail;
use Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $booking = PGBooking::join('ps_package', 'ps_package.id', '=', 'pg_booking.package_id')->where('booking_status', 'on_review')->get();
        $booking_unapprove = PGBooking::join('pg_package', 'pg_package.id', '=', 'pg_booking.package_id' )
                            ->join('users', 'users.id', '=', 'pg_package.partner_id')
                            ->join('partner', 'Partner.user_id', '=', 'users.id')
                            ->join('pg_durasi', 'pg_durasi.package_id', '=', 'pg_booking.package_id')
                            ->where('pg_booking.booking_status', '=', 'un_approved')
                            ->orderBy('pg_booking.updated_at', 'desc')
                            ->select('pg_booking.booking_id', 'pg_booking.updated_at', 'partner.pr_name', 'users.phone_number', 'pg_booking.start_date', 'pg_package.pg_name', 'pg_package.pg_mua', 'pg_package.pg_stylist', 'pg_durasi.durasi_jam', 'pg_booking.booking_price', 'pg_booking.booking_total')
                            ->get();
        $booking_unconfirmed = PGBooking::join('pg_package', 'pg_package.id', '=', 'pg_booking.package_id' )
                            ->where('pg_booking.booking_status', 'paid')->get();

        $booking_confirmed = PGBooking::join('pg_package', 'pg_package.id', '=', 'pg_booking.package_id' )
                            ->where('pg_booking.booking_status', 'confirmed')->get();

        $total_partner = Partner::count();
        $total_user = User::join('role_user', 'role_user.user_id', '=', 'users.id')->where('role_user.role_id', '=', '2')->count();
        $total_booking_paid = PGBooking::where('booking_status', 'paid')->count();
        $total_booking_confirmed = PGBooking::where('booking_status', 'confirmed')->count();
        $total_booking = PGBooking::count();
        return view('superadmin.fotografer.booking-list', ['booking' => $booking, 'booking_confirmed' => $booking_confirmed], compact('total_user', 'total_partner', 'total_booking', 'total_booking_paid', 'total_booking_confirmed', 'booking_unapprove', 'booking_unconfirmed', 'biayaKirim'));
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

    public function approveBooking(Request $request)
    {
        $booking_id = $request->id;
        $booking = PGBooking::find($booking_id);
        $book = PGBooking::where('booking_id', $booking_id)->select('booking_id')->first()->toArray();

        $user = PGBooking::join('users', 'users.id', '=', 'pg_booking.user_id')
                ->join('pg_package', 'pg_package.id', '=', 'pg_booking.package_id')
                ->where('pg_booking.booking_id', $booking_id)
                ->first()->toArray();    
        // dd($user);
        $user['link'] = '5'.str_random(30).'PG';

        DB::table('booking_activations_pg')->insert(['id_user'=>$user['user_id'], 'booking_id'=>$book['booking_id'], 'token'=>$user['link']]);

        Mail::send('emails.booking-approve-pg', $user, function($message) use ($user){
          $message->to($user['email']);
          $message->subject('Kupesan.id | Pesanan Tersedia');
        });

        $booking->booking_status = 'approved';
        $booking->save();

        return redirect()->back();
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

        $booking->booking_status = 'canceled_by_admin';
        $booking->save();

        return redirect()->back();
    }

    public function bookingActivation($token){
      $check = DB::table('booking_activations_pg')->where('token',$token)->first();
      if(!is_null($check)){
        $user = User::find($check->id_user);
        $bid = $check->booking_id;

        if ($user->is_activated == 1){

            return redirect()->route('pg.step6', ['bid' => $bid]);
        } 

        $user->update(['is_activated' => 1]);

        return redirect()->route('pg.step6', ['bid' => $bid]);
      }
      return redirect()->to('home')->with('Warning',"Your token is invalid");
    }

    public function confirmBukti(Request $request)
    {
        // dd($request);
        $booking_id = $request->id;
        $booking = PGBooking::find($booking_id);
        $kode_booking = '4P'.str_random(7);
        $booking->kode_booking = strtoupper($kode_booking);
        $booking->save();

        $user = PGBooking::join('users', 'users.id', '=', 'pg_booking.user_id')
                ->join('pg_package', 'pg_package.id', '=', 'pg_booking.package_id')
                ->join('partner', 'partner.user_id', '=', 'pg_package.partner_id')
                ->where('booking_id', $booking_id)
                ->select('users.*', 'pg_booking.*', 'pg_package.*', 'partner.pr_phone')
                ->first()->toArray();
        
        Mail::send('emails.kode-booking.pg', $user, function($message) use ($user){
          $message->to($user['email']);
          $message->subject('Kupesan.id | Kode Booking ');
        });
        
        $booking->booking_status = 'confirmed';
        $booking->save();

        return redirect()->back();
    }

    public function cancelBukti(Request $request)
    {
        $booking_id = $request->id;
        $booking = PGBooking::find($booking_id);
        
        $user = PGBooking::join('users', 'users.id', '=', 'booking.user_id')
                ->join('ps_package', 'ps_package.id', '=', 'booking.package_id')
                ->where('booking.booking_id', $booking_id)
                ->first()->toArray();
                
        Mail::send('emails.bukti-cancel.pg', $user, function($message) use ($user){
          $message->to($user['email']);
          $message->subject('Kupesan.id | Bukti Pembayaran Tidak Diterima');
        });
        
        $booking->booking_status = 'paid_unvalid';
        $bid = $booking_id;
        $package_id = $booking->package_id;
        $quantity_cancel = $booking->quantity;
        $booking_start_date = date('Y-m-d', strtotime("$booking->start_date"));
        $booking_end_date = date('Y-m-d', strtotime("$booking->end_date"));

        $kebaya_booking_check = KebayaCheck::where('package_id', $package_id)->whereBetween('booking_date', [$booking_start_date, $booking_end_date])->get();
        // dd($kebaya_booking_check);

        foreach ($kebaya_booking_check as $key => $value) {
            $kuantitas = $value->kuantitas;
            $kebaya_cancel = KebayaCheck::find($value->id);
            $kebaya_cancel->kuantitas =   $kuantitas - $quantity_cancel;
            $kebaya_cancel->save();
        }

        $booking->save();

        return redirect()->back();
    }

    public function showBukti(Request $request)
    {
        $booking_id = $request->id;
        $booking = PGBooking::join('pg_package', 'pg_package.id', '=', 'pg_booking.package_id')
                    ->where('pg_booking.booking_id', $booking_id)
                    ->get();
        return view('superadmin.fotografer.show-bukti', compact('booking'));
    }

    public function partnerList()
    {
        $partner = Partner::join('partner_type', 'partner_type.id', '=', 'partner.pr_type')->join('users', 'users.id', '=', 'partner.user_id')->where('partner.status', '0')->get();
        $partner_confirmed = Partner::join('partner_type', 'partner_type.id', '=', 'partner.pr_type')->join('users', 'users.id', '=', 'partner.user_id')->where('partner.status', '1')->get();
        // dd($partner);
        $total_fotostudio = Partner::where('pr_type', '1')->count();
        $total_fotografer = Partner::where('pr_type', '2')->count();
        $total_mua = Partner::where('pr_type', '3')->count();
        $total_kebaya = Partner::where('pr_type', '4')->count();
        return view('superadmin.daftarpartner', ['partner' => $partner, 'partner_confirmed' => $partner_confirmed], compact('total_fotostudio', 'total_fotografer', 'total_mua', 'total_kebaya'));
    }
}

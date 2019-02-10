<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booking;
use App\PSPkg;
use App\User;
use App\Partner;
use DB;
use Mail;
use Auth;
use File;
use Image;
use App\Jam;
use App\Provinces;
use App\Regencies;
use App\Districts;
use App\Villages;
use App\BookingCheck;
use App\KebayaBooking;
use App\KebayaCheck;
use App\Album;
use App\SpotAddress;
use App\SpotFacilities;
class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login-admin');
    }

    public function dashboard()
    {
        $booking = Booking::join('ps_package', 'ps_package.id', '=', 'booking.package_id')->where('booking_status', 'on_review')->get();
        $booking_unapprove = Booking::join('ps_package', 'ps_package.id', '=', 'booking.package_id')
                            ->join('partner', 'ps_package.user_id', '=', 'partner.user_id')
                            ->join('users', 'users.id', '=', 'partner.user_id')
                            ->where('booking.booking_status', 'un_approved')
                            ->select('ps_package.*','partner.*','booking.*', 'users.phone_number', 'users.email')
                            ->get();
                            // dd($booking_unreview);
        $booking_unconfirmed = Booking::join('ps_package', 'ps_package.id', '=', 'booking.package_id')->where('booking_status', 'paid')->get();

        $booking_confirmed = Booking::join('ps_package', 'ps_package.id', '=', 'booking.package_id')->where('booking_status', 'confirmed')->get();
        $total_partner = Partner::count();
        $total_user = User::join('role_user', 'role_user.user_id', '=', 'users.id')->where('role_user.role_id', '=', '2')->count();
        $total_booking_paid = Booking::where('booking_status', 'paid')->count();
        $total_booking_confirmed = Booking::where('booking_status', 'confirmed')->count();
        $total_booking = Booking::count();
        return view('superadmin.dashboard', ['booking' => $booking, 'booking_confirmed' => $booking_confirmed], compact('total_user', 'total_partner', 'total_booking', 'total_booking_paid', 'total_booking_confirmed', 'booking_unapprove', 'booking_unconfirmed'));
    }

    public function listBookingKebaya()
    {
        $booking = Booking::join('ps_package', 'ps_package.id', '=', 'booking.package_id')->where('booking_status', 'on_review')->get();
        $booking_unapprove = KebayaBooking::join('kebaya_product', 'kebaya_product.id', '=', 'kebaya_booking.package_id')
                            ->join('partner', 'kebaya_product.partner_id', '=', 'partner.user_id')
                            ->join('users', 'users.id', '=', 'partner.user_id')
                            ->join('kebaya_booking_address', 'kebaya_booking_address.booking_id', '=', 'kebaya_booking.booking_id')
                            ->where('kebaya_booking.booking_status', 'un_approved')
                            ->select('kebaya_product.name','kebaya_product.set','kebaya_product.size','partner.pr_name','partner.pr_name','kebaya_booking.start_date', 'kebaya_booking.end_date','kebaya_booking.booking_id','kebaya_booking.package_id','kebaya_booking.booking_status', 'kebaya_booking.quantity', 'kebaya_booking.booking_price', 'kebaya_booking.biaya_dry_clean','kebaya_booking.biaya_kirim', 'kebaya_booking.booking_total','kebaya_booking.deposit', 'users.phone_number', 'users.email', 'kebaya_booking.updated_at', 'kebaya_booking_address.flag', 'kebaya_product.price_dryclean')
                            ->get();
        // dd($booking_unapprove);
        $booking_unconfirmed = KebayaBooking::join('kebaya_product', 'kebaya_product.id', '=', 'kebaya_booking.package_id')
                            ->join('kebaya_booking_address', 'kebaya_booking_address.booking_id', '=', 'kebaya_booking.booking_id')
                            ->where('kebaya_booking.booking_status', 'paid')->get();

        $booking_confirmed = KebayaBooking::join('kebaya_product', 'kebaya_product.id', '=', 'kebaya_booking.package_id')
                            ->join('kebaya_booking_address', 'kebaya_booking_address.booking_id', '=', 'kebaya_booking.booking_id')
                            ->where('kebaya_booking.booking_status', 'confirmed')->get();

        $total_partner = Partner::count();
        $total_user = User::join('role_user', 'role_user.user_id', '=', 'users.id')->where('role_user.role_id', '=', '2')->count();
        $total_booking_paid = Booking::where('booking_status', 'paid')->count();
        $total_booking_confirmed = Booking::where('booking_status', 'confirmed')->count();
        $total_booking = Booking::count();
        $biayaKirim = '10000';
        return view('superadmin.kebaya.booking-list', ['booking' => $booking, 'booking_confirmed' => $booking_confirmed], compact('total_user', 'total_partner', 'total_booking', 'total_booking_paid', 'total_booking_confirmed', 'booking_unapprove', 'booking_unconfirmed', 'biayaKirim'));
    }

    public function approveBooking(Request $request)
    {
        // dd($request);
        $booking_id = $request->id;
        $booking = Booking::where('booking_id', $booking_id)->first();
        $book = Booking::where('booking_id', $booking_id)->select('booking_id')->first()->toArray();
        $user = Booking::join('users', 'users.id', '=', 'booking.user_id')
                    ->join('ps_package', 'ps_package.id', '=', 'booking.package_id')
                    ->where('booking.booking_id', $booking_id)->first()->toArray();
        
        $user['link'] = str_random(35);

        DB::table('booking_activations')->insert(['id_user'=>$user['id'], 'booking_id'=>$book['booking_id'], 'token'=>$user['link']]);

        Mail::send('emails.booking-approve', $user, function($message) use ($user){
          $message->to($user['email']);
          $message->subject('Kupesan.id | Pesanan Tersedia');
        });

        $booking->booking_status = 'approved';
        $booking->save();

        return redirect()->back();
    }

    public function bookingActivation($token){
      $check = DB::table('booking_activations')->where('token',$token)->first();
      if(!is_null($check)){
        $user = User::find($check->id_user);
        $bid = $check->booking_id;

        if ($user->is_activated == 1){

            return redirect()->route('form.step6', ['bid' => $bid]);
        }

        $user->update(['is_activated' => 1]);

        return redirect()->route('form.step6', ['bid' => $bid]);
      }
      return redirect()->to('home')->with('Warning',"Your token is invalid");
    }

    public function cancelBooking(Request $request)
    {
        // dd($request);
        $booking_id = $request->id;
        $booking = Booking::where('booking_id', $booking_id)->first();
        $book = Booking::where('booking_id', $booking_id)->select('booking_id')->first()->toArray();
        $user = Booking::join('users', 'users.id', '=', 'booking.user_id')
                ->join('ps_package', 'ps_package.id', '=', 'booking.package_id')
                ->where('booking.booking_id', $booking_id)
                ->first()->toArray();
                
        Mail::send('emails.booking-cancel-spotfoto', $user, function($message) use ($user){
          $message->to($user['email']);
          $message->subject('Kupesan.id | Pesanan Tidak Tersedia');
        });
        
        $booking->booking_status = 'canceled_by_admin';
        $booking->save();

        return redirect()->back();
    }

    public function confirmBukti(Request $request)
    {
    	// dd($request);
    	$booking_id = $request->id;
    	$kode_booking = '1X'.str_random(7);
        $booking = Booking::where('booking_id', $booking_id)->first();
        $booking->kode_booking = strtoupper($kode_booking);
        $booking->save();

        $user = Booking::join('users', 'users.id', '=', 'booking.user_id')
                ->join('ps_package', 'ps_package.id', '=', 'booking.package_id')
                ->where('booking.booking_id', $booking_id)
                ->first()->toArray();
        
        Mail::send('emails.kode-booking.fotostudio', $user, function($message) use ($user){
          $message->to($user['email']);
          $message->subject('Kupesan.id | Kode Booking ');
        });
        
        $booking->booking_status = 'confirmed';
        $booking->save();

        return redirect()->back();
    }

    public function cancelBukti(Request $request)
    {
        // dd($request);
        $booking_id = $request->id;
        $booking = Booking::where('booking_id', $booking_id)->first();
        
        $user = Booking::join('users', 'users.id', '=', 'booking.user_id')
                ->join('ps_package', 'ps_package.id', '=', 'booking.package_id')
                ->where('booking.booking_id', $booking_id)
                ->first()->toArray();
                
        Mail::send('emails.bukti-cancel.spotfoto', $user, function($message) use ($user){
          $message->to($user['email']);
          $message->subject('Kupesan.id | Bukti Pembayaran Tidak Diterima');
        });
        
        $booking->booking_status = 'paid_unvalid';
        $bid = $booking_id;

        $range_jam2 = DB::select('select j.num_hour, b.p_id, b.b_date from jam j, (select package_id as p_id, booking_start_date as b_date,  booking_start_time as mulai, (booking_end_time + booking_overtime - 1) as selesai from booking where booking_id = :id ) b where j.num_hour BETWEEN b.mulai and b.selesai', ['id' => $bid]);

        foreach ($range_jam2 as $value) {
            $b_date = $value->b_date;
            $booking_start_date = date('Y-m-d', strtotime("$b_date"));
            $bookingcheck = BookingCheck::where('package_id', $value->p_id)->where('booking_date', $booking_start_date)->first();
            if(!empty($bookingcheck)) {
                if ($value->num_hour == '1') { $bookingcheck->num_hour_1 = null;}
                if ($value->num_hour == '2') { $bookingcheck->num_hour_2 = null;}
                if ($value->num_hour == '3') { $bookingcheck->num_hour_3 = null;}
                if ($value->num_hour == '4') { $bookingcheck->num_hour_4 = null;}
                if ($value->num_hour == '5') { $bookingcheck->num_hour_5 = null;}
                if ($value->num_hour == '6') { $bookingcheck->num_hour_6 = null;}
                if ($value->num_hour == '7') { $bookingcheck->num_hour_7 = null;}
                if ($value->num_hour == '8') { $bookingcheck->num_hour_8 = null;}
                if ($value->num_hour == '9') { $bookingcheck->num_hour_9 = null;}
                if ($value->num_hour == '10') { $bookingcheck->num_hour_10 = null;}    
                if ($value->num_hour == '11') { $bookingcheck->num_hour_11 = null;}
                if ($value->num_hour == '12') { $bookingcheck->num_hour_12 = null;}
                if ($value->num_hour == '13') { $bookingcheck->num_hour_13 = null;}
                if ($value->num_hour == '14') { $bookingcheck->num_hour_14 = null;}
                if ($value->num_hour == '15') { $bookingcheck->num_hour_15 = null;}
                if ($value->num_hour == '16') { $bookingcheck->num_hour_16 = null;}
                if ($value->num_hour == '17') { $bookingcheck->num_hour_17 = null;}
                if ($value->num_hour == '18') { $bookingcheck->num_hour_18 = null;}
                if ($value->num_hour == '19') { $bookingcheck->num_hour_19 = null;}
                if ($value->num_hour == '20') { $bookingcheck->num_hour_20 = null;}    
                if ($value->num_hour == '21') { $bookingcheck->num_hour_21 = null;}
                if ($value->num_hour == '22') { $bookingcheck->num_hour_22 = null;}
                if ($value->num_hour == '23') { $bookingcheck->num_hour_23 = null;}
                if ($value->num_hour == '24') { $bookingcheck->num_hour_24 = null;} 
                $bookingcheck->save();
            }
        }

        $booking->save();

        return redirect()->back();
    }

    public function showBukti(Request $request)
    {
        // dd($request);
        $booking_id = $request->id;
        $booking = Booking::where('booking_id', $booking_id)->get();

        return view('superadmin.booking.show-bukti', compact('booking'));
    }

    // kebaya

    public function approveBookingKebaya(Request $request)
    {
        // dd($request);
        $booking_id = $request->id;
        $booking = KebayaBooking::find($booking_id);
        $book = KebayaBooking::where('booking_id', $booking_id)->select('booking_id')->first()->toArray();

        $user = KebayaBooking::join('users', 'users.id', '=', 'kebaya_booking.user_id')
                ->join('kebaya_product', 'kebaya_product.id', '=', 'kebaya_booking.package_id')
                ->where('kebaya_booking.booking_id', $booking_id)
                ->first()->toArray();         
        $user['link'] = '4'.str_random(30).'KbY';

        DB::table('booking_activations_kebaya')->insert(['id_user'=>$user['id'], 'booking_id'=>$book['booking_id'], 'token'=>$user['link']]);

        Mail::send('emails.booking-approve-kebaya', $user, function($message) use ($user){
          $message->to($user['email']);
          $message->subject('Kupesan.id | Pesanan Tersedia');
        });

        $booking->booking_status = 'approved';
        $booking->save();

        return redirect()->back();
    }

    public function bookingActivationKebaya($token){
      $check = DB::table('booking_activations_kebaya')->where('token',$token)->first();
      if(!is_null($check)){
        $user = User::find($check->id_user);
        $bid = $check->booking_id;

        if ($user->is_activated == 1){

            return redirect()->route('kebaya.step6', ['bid' => $bid]);
        }

        $user->update(['is_activated' => 1]);

        return redirect()->route('kebaya.step6', ['bid' => $bid]);
      }
      return redirect()->to('home')->with('Warning',"Your token is invalid");
    }

    public function cancelBookingKebaya(Request $request)
    {
        // dd($request);
        $booking_id = $request->id;
        $booking = KebayaBooking::find($booking_id);

        $book = KebayaBooking::where('booking_id', $booking_id)->select('booking_id')->first()->toArray();
        $user = KebayaBooking::join('users', 'users.id', '=', 'kebaya_booking.user_id')
                ->join('kebaya_product', 'kebaya_product.id', '=', 'kebaya_booking.package_id')
                ->where('kebaya_booking.booking_id', $booking_id)
                ->first()->toArray();
        Mail::send('emails.booking-cancel', $user, function($message) use ($user){
          $message->to($user['email']);
          $message->subject('Kupesan.id | Pesanan Tidak Tersedia');
        });
        
        $booking->booking_status = 'canceled_by_admin';
        $booking->save();

        return redirect()->back();
    }

    public function confirmBuktiKebaya(Request $request)
    {
        // dd($request);
        $booking_id = $request->id;
        $booking = KebayaBooking::find($booking_id);
        $kode_booking = '4X'.str_random(7);
        $booking->kode_booking = strtoupper($kode_booking);
        $booking->save();

        $user = KebayaBooking::join('users', 'users.id', '=', 'kebaya_booking.user_id')
                ->join('kebaya_product', 'kebaya_product.id', '=', 'kebaya_booking.package_id')
                ->join('kebaya_category', 'kebaya_category.id', '=', 'kebaya_product.category')
                ->join('partner', 'partner.user_id', '=', 'kebaya_product.partner_id')
                ->where('booking_id', $booking_id)
                ->select('users.*', 'kebaya_booking.*', 'kebaya_product.*', 'kebaya_category.category_name', 'kebaya_booking.quantity as kuantitas_pesanan', 'partner.pr_phone')
                ->first()->toArray();
        
        Mail::send('emails.kode-booking.kebaya', $user, function($message) use ($user){
          $message->to($user['email']);
          $message->subject('Kupesan.id | Kode Booking ');
        });
        
        $booking->booking_status = 'confirmed';
        $booking->save();

        return redirect()->back();
    }

    public function cancelBuktiKebaya(Request $request)
    {
        // dd($request);
        $booking_id = $request->id;
        $booking = KebayaBooking::find($booking_id);
        
        $user = KebayaBooking::join('users', 'users.id', '=', 'booking.user_id')
                ->join('ps_package', 'ps_package.id', '=', 'booking.package_id')
                ->where('booking.booking_id', $booking_id)
                ->first()->toArray();
                
        Mail::send('emails.bukti-cancel.busana', $user, function($message) use ($user){
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

    public function showBuktiKebaya(Request $request)
    {
        $booking_id = $request->id;
        $booking = KebayaBooking::join('kebaya_product', 'kebaya_product.id', '=', 'kebaya_booking.package_id')
                    ->join('kebaya_booking_address', 'kebaya_booking_address.booking_id', '=', 'kebaya_booking.booking_id')
                    ->where('kebaya_booking.booking_id', $booking_id)
                    ->get();
        $biayaKirim = '10000';
        return view('superadmin.kebaya.show-bukti', compact('booking', 'biayaKirim'));
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

    public function confirmPartner(Request $request)
    {
        $partner_id = $request->id;
        
        $user = User::where('id', $partner_id)->first()->toArray();

        $user['link'] = str_random(30);

        DB::table('partner_activations')->insert(['id_user'=>$user['id'],'token'=>$user['link']]);

        Mail::send('emails.approve', $user, function($message) use ($user){
          $message->to($user['email']);
          $message->subject('Kupesan - Partner Activation Account');
        });

        $partner = Partner::where('user_id', $partner_id)->first();
        $partner->status = '1';
        $partner->save();

        $foto_ktp = $partner->ktp;
        $foto_bangunan = $partner->bangunan;
        if( File::exists(public_path('/partner_ktp/' . $foto_ktp .'.jpeg' ))){
            File::delete(public_path('/partner_ktp/' . $foto_ktp .'.jpeg' ));
            File::delete(public_path('/partner_ktp/' . $foto_bangunan .'.jpeg' ));
        }
        elseif( File::exists(public_path('/partner_ktp/' . $foto_ktp .'.jpg' ))){
            File::delete(public_path('/partner_ktp/' . $foto_ktp .'.jpg' ));
            File::delete(public_path('/partner_ktp/' . $foto_bangunan .'.jpg' ));
        }
        elseif( File::exists(public_path('/partner_ktp/' . $foto_ktp .'.png' ))){
            File::delete(public_path('/partner_ktp/' . $foto_ktp .'.png' ));
            File::delete(public_path('/partner_ktp/' . $foto_bangunan .'.png' ));
        }
        elseif( File::exists(public_path('/partner_ktp/' . $foto_ktp .'.jpg' ))){
            File::delete(public_path('/partner_ktp/' . $foto_ktp .'.jpg' ));
            File::delete(public_path('/partner_ktp/' . $foto_bangunan .'.jpg' ));
        }
        elseif( File::exists(public_path('/partner_ktp/' . $foto_ktp .'.png' ))){
            File::delete(public_path('/partner_ktp/' . $foto_ktp .'.png' ));
            File::delete(public_path('/partner_ktp/' . $foto_bangunan .'.png' ));
        }

        return redirect()->back();
    }

    public function partnerActivation($token){
      $check = DB::table('partner_activations')->where('token',$token)->first();
      if(!is_null($check)){
        $user = User::find($check->id_user);
        if ($user->is_activated ==1){
            if(Auth::check()) {
                return redirect()->route('partner.dashboard');
            } else {
                return redirect()->route('mitra.login')->with('success',"Selamat, profil perusahan Anda telah berhasil kami tinjau.");
            }
          

        }
        $user->update(['is_activated' => 1]);
        DB::table('user_activations')->where('token',$token)->delete();
        return redirect()->to('partner-ku/login')->with('success',"Account active successfully, please enter your e-mail and password to Log-In.");
      }
      return redirect()->to('login')->with('Warning',"Your token is invalid");
    }

    public function cancelPartner(Request $request)
    {
        // dd($request);
        $partner_id = $request->id;
        
        $user = User::where('id', $partner_id)->first()->toArray();

        Mail::send('emails.cancel-partner', $user, function($message) use ($user){
          $message->to($user['email']);
          $message->subject('Kupesan - Partner Cancellation Account');
        });

        $partner = Partner::where('user_id', $partner_id)->first();
        $partner->status = '2';
        $partner->save();

        $foto_ktp = $partner->ktp;
        $foto_bangunan = $partner->bangunan;
        if( File::exists(public_path('/partner_ktp/' . $foto_ktp .'.jpeg' ))){
            File::delete(public_path('/partner_ktp/' . $foto_ktp .'.jpeg' ));
            File::delete(public_path('/partner_ktp/' . $foto_bangunan .'.jpeg' ));
        }
        elseif( File::exists(public_path('/partner_ktp/' . $foto_ktp .'.jpg' ))){
            File::delete(public_path('/partner_ktp/' . $foto_ktp .'.jpg' ));
            File::delete(public_path('/partner_ktp/' . $foto_bangunan .'.jpg' ));
        }
        elseif( File::exists(public_path('/partner_ktp/' . $foto_ktp .'.png' ))){
            File::delete(public_path('/partner_ktp/' . $foto_ktp .'.png' ));
            File::delete(public_path('/partner_ktp/' . $foto_bangunan .'.png' ));
        }
        elseif( File::exists(public_path('/partner_ktp/' . $foto_ktp .'.jpg' ))){
            File::delete(public_path('/partner_ktp/' . $foto_ktp .'.jpg' ));
            File::delete(public_path('/partner_ktp/' . $foto_bangunan .'.jpg' ));
        }
        elseif( File::exists(public_path('/partner_ktp/' . $foto_ktp .'.png' ))){
            File::delete(public_path('/partner_ktp/' . $foto_ktp .'.png' ));
            File::delete(public_path('/partner_ktp/' . $foto_bangunan .'.png' ));
        }
        
        return redirect()->back();
    }

    public function showPartner(Request $request)
    {
        $partner_id = $request->id;
        $partner = Partner::join('users', 'users.id', '=', 'partner.user_id')->where('partner.user_id', $partner_id)->get();
        $partner1 = Partner::join('users', 'users.id', '=', 'partner.user_id')->where('partner.user_id', $partner_id)->first();
        foreach ($partner as $key => $value) {
            $type = DB::table('partner_type')->where('id', $value->pr_type)->get();
        }
        $provinsi = Provinces::where('id', $partner1->pr_prov)->first();
        $kota = Regencies::where('id', $partner1->pr_kota)->first();
        $kecamatan = Districts::where('id', $partner1->pr_kec)->first();
        return view('superadmin.partner.application-form', compact('partner', 'type', 'provinsi', 'kota', 'kecamatan'));
    }
    
    public function showAllFreeSpot(Request $request)
    {
        $freespot = Partner::where('pr_type', '9')
                        ->join('partner_type', 'partner_type.id', '=', 'partner.pr_subtype')
                        ->get();
        return view('superadmin.free-spot.index', compact('freespot'));
    }
    
    public function addFreeSpot(Request $request)
    {
        $user = Auth::user();
        $email = $user->email;
        $provinces = Provinces::where('name', 'JAWA TIMUR')->get();
        $phone_number = $user->phone_number;
        $type = DB::table('partner_type')->select('*')->get();
        $jam = Jam::all();
        $partner = DB::table('partner')
                    ->where('user_id',$user->id)
                    ->select('*')
                    ->first();
        return view('superadmin.free-spot.add', ['partner' => $partner, 'email' => $email, 'type' => $type, 'phone_number' => $phone_number],compact('provinces', 'jam') );   
    }
    
    public function storeFreeSpot(Request $request)
    {
        $pr_type = '9';
        $user = new User();
        $user->first_name = $request->input('pr_name');
        $user->phone_number = $request->input('pr_phone');
        $user->save(); 
        $partner = new Partner();
        $partner->user_id = $user->id;
        $partner->pr_name = $request->input('pr_name');
        $partner->pr_owner_name = $request->input('pr_name');
        $partner->pr_type = $pr_type;
        $partner->pr_subtype = $request->input('pr_subtype');
        $partner->open_hour = $request->input('open_hour');
        $partner->close_hour = $request->input('close_hour');
        $partner->pr_desc = $request->input('pr_desc');
        $partner->pr_prov = $request->input('pr_prov');
        $partner->pr_kota = $request->input('pr_kota');
        $partner->pr_kec = $request->input('pr_kec');
        $partner->pr_kel = $request->input('pr_kel');
        $partner->pr_postal_code = $request->input('pr_postal_code');
        $partner->pr_addr = $request->input('pr_addr');
        $partner->pr_phone = $request->input('pr_phone');
        $partner->pr_phone2 = $request->input('pr_phone2');
        $partner->status = '1';
        $partner->save(); 
        
        $logo = Partner::where('id', $partner->id)->first();
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
            $logo = Partner::where('id', $partner->id)->first();
            $logo->save();
        }
        
        $album = new Album();
        $album->user_id = $partner->user_id;
        $album->save();
        
	    if ($request->hasFile('album_img_1')) {
    	    $album->album_img_1 = $album->id . '_' . $album->user_id . '_album1';
        	$album->save();

            //Found existing file then delete
            $foto_new = $album->album_img_1;
            if( File::exists(public_path('/album/' . $foto_new .'.jpeg' ))){
                File::delete(public_path('/album/' . $foto_new .'.jpeg' ));
            }
            if( File::exists(public_path('/album/' . $foto_new .'.jpg' ))){
                File::delete(public_path('/album/' . $foto_new .'.jpg' ));
            }
            if( File::exists(public_path('/album/' . $foto_new .'.png' ))){
                File::delete(public_path('/album/' . $foto_new .'.png' ));
            }
            if( File::exists(public_path('/album/' . $foto_new .'.JPEG' ))){
                File::delete(public_path('/album/' . $foto_new .'.JPEG' ));
            }
            if( File::exists(public_path('/album/' . $foto_new .'.JPG' ))){
                File::delete(public_path('/album/' . $foto_new .'.JPG' ));
            }
            if( File::exists(public_path('/album/' . $foto_new .'.PNG' ))){
                File::delete(public_path('/album/' . $foto_new .'.PNG' ));
            }
            $foto = $request->file('album_img_1');
            $foto_name = $foto_new . '.' .$foto->getClientOriginalExtension();
            Image::make($foto)->save( public_path('/album/' . $foto_name ) );
            $user = Auth::user();
            $album = Album::where('user_id',$partner->user_id)->first();
            $album->save();
        }
        
        if ($request->hasFile('album_img_2')) {
    	    $album->album_img_2 = $album->id . '_' . $album->user_id . '_album2';
        	$album->save();

            //Found existing file then delete
            $foto_new = $album->album_img_2;
            if( File::exists(public_path('/album/' . $foto_new .'.jpeg' ))){
                File::delete(public_path('/album/' . $foto_new .'.jpeg' ));
            }
            if( File::exists(public_path('/album/' . $foto_new .'.jpg' ))){
                File::delete(public_path('/album/' . $foto_new .'.jpg' ));
            }
            if( File::exists(public_path('/album/' . $foto_new .'.png' ))){
                File::delete(public_path('/album/' . $foto_new .'.png' ));
            }
            if( File::exists(public_path('/album/' . $foto_new .'.JPEG' ))){
                File::delete(public_path('/album/' . $foto_new .'.JPEG' ));
            }
            if( File::exists(public_path('/album/' . $foto_new .'.JPG' ))){
                File::delete(public_path('/album/' . $foto_new .'.JPG' ));
            }
            if( File::exists(public_path('/album/' . $foto_new .'.PNG' ))){
                File::delete(public_path('/album/' . $foto_new .'.PNG' ));
            }
            $foto = $request->file('album_img_2');
            $foto_name = $foto_new . '.' .$foto->getClientOriginalExtension();
            Image::make($foto)->save( public_path('/album/' . $foto_name ) );
            $user = Auth::user();
            $album = Album::where('user_id',$partner->user_id)->first();
            $album->save();
        }
        
        if ($request->hasFile('album_img_3')) {
    	    $album->album_img_3 = $album->id . '_' . $album->user_id . '_album3';
        	$album->save();

            //Found existing file then delete
            $foto_new = $album->album_img_3;
            if( File::exists(public_path('/album/' . $foto_new .'.jpeg' ))){
                File::delete(public_path('/album/' . $foto_new .'.jpeg' ));
            }
            if( File::exists(public_path('/album/' . $foto_new .'.jpg' ))){
                File::delete(public_path('/album/' . $foto_new .'.jpg' ));
            }
            if( File::exists(public_path('/album/' . $foto_new .'.png' ))){
                File::delete(public_path('/album/' . $foto_new .'.png' ));
            }
            if( File::exists(public_path('/album/' . $foto_new .'.JPEG' ))){
                File::delete(public_path('/album/' . $foto_new .'.JPEG' ));
            }
            if( File::exists(public_path('/album/' . $foto_new .'.JPG' ))){
                File::delete(public_path('/album/' . $foto_new .'.JPG' ));
            }
            if( File::exists(public_path('/album/' . $foto_new .'.PNG' ))){
                File::delete(public_path('/album/' . $foto_new .'.PNG' ));
            }
            $foto = $request->file('album_img_3');
            $foto_name = $foto_new . '.' .$foto->getClientOriginalExtension();
            Image::make($foto)->save( public_path('/album/' . $foto_name ) );
            $user = Auth::user();
            $album = Album::where('user_id', $partner->user_id)->first();
            $album->save();
        }
        
        if ($request->hasFile('album_img_4')) {
    	    $album->album_img_4 = $album->id . '_' . $album->user_id . '_album4';
        	$album->save();

            //Found existing file then delete
            $foto_new = $album->album_img_4;
            if( File::exists(public_path('/album/' . $foto_new .'.jpeg' ))){
                File::delete(public_path('/album/' . $foto_new .'.jpeg' ));
            }
            if( File::exists(public_path('/album/' . $foto_new .'.jpg' ))){
                File::delete(public_path('/album/' . $foto_new .'.jpg' ));
            }
            if( File::exists(public_path('/album/' . $foto_new .'.png' ))){
                File::delete(public_path('/album/' . $foto_new .'.png' ));
            }
            if( File::exists(public_path('/album/' . $foto_new .'.JPEG' ))){
                File::delete(public_path('/album/' . $foto_new .'.JPEG' ));
            }
            if( File::exists(public_path('/album/' . $foto_new .'.JPG' ))){
                File::delete(public_path('/album/' . $foto_new .'.JPG' ));
            }
            if( File::exists(public_path('/album/' . $foto_new .'.PNG' ))){
                File::delete(public_path('/album/' . $foto_new .'.PNG' ));
            }
            $foto = $request->file('album_img_4');
            $foto_name = $foto_new . '.' .$foto->getClientOriginalExtension();
            Image::make($foto)->save( public_path('/album/' . $foto_name ) );
            $user = Auth::user();
            $album = Album::where('user_id', $partner->user_id)->first();
            $album->save();
        }

        return redirect()->intended(route('show.free.spot'));  
    }
    
    public function showAllPartnerSpot(Request $request)
    {
        $user_id = $request->id;
        $freespot = PSPkg::where('user_id', $user_id)
                        ->get();
        return view('superadmin.free-spot.spot.index', compact('freespot', 'user_id'));
    }
    
    public function addPartnerSpot(Request $request)
    {
        $user_id = $request->user_id;
        $user = Auth::user();
        $email = $user->email;
        $provinces = Provinces::where('name', 'JAWA TIMUR')->get();
        $phone_number = $user->phone_number;
        $type = DB::table('partner_type')->select('*')->get();
        $jam = Jam::all();
        $partner = DB::table('partner')
                    ->where('user_id',$user->id)
                    ->select('*')
                    ->first();
        return view('superadmin.free-spot.spot.add', ['partner' => $partner, 'email' => $email, 'type' => $type, 'phone_number' => $phone_number],compact('provinces', 'jam', 'user_id') );   
    }
    
    
    public function storePartnerSpot(Request $request)
    {
        $user_id = $request->user_id;
        
        $partner = Partner::where('user_id', $user_id)->first();
        
        $package = new PSPkg();
        $package->user_id = $user_id;
        $package->partner_name = $partner->pr_name;
        $package->pkg_name_them = $request->input('pkg_name_them');
        $package->pkg_desc = $request->input('pr_desc');
        $package->status = '1';
        $package->save();
        
        $address = new SpotAddress();
        $address->user_id = $user_id;
        $address->package_id = $package->id;
        $address->pr_prov = $request->input('pr_prov');
        $address->pr_kota = $request->input('pr_kota');
        $address->pr_kec = $request->input('pr_kec');
        $address->pr_kel = $request->input('pr_kel');
        $address->pr_postal_code = $request->input('pr_postal_code');
        $address->pr_addr = $request->input('pr_addr');
        $address->save();
        
        $fasilitas = new SpotFacilities();
        $fasilitas->user_id = $user_id;
        $fasilitas->package_id = $package->id;
        $fasilitas->toilet = $request->input('toilet');
        $fasilitas->wifi = $request->input('wifi');
        $fasilitas->rganti = $request->input('rganti');
        $fasilitas->ac = $request->input('ac');
        $fasilitas->parkir = $request->input('parkir');
        $fasilitas->facilities_id = '1';
        $fasilitas->save();
        
        if ($request->hasFile('pkg_img_them')) {
            $package->pkg_img_them = $package->id . '_' . $package->pkg_category_them . '_' . $package->pkg_name_them . '_1';
            $package->save();
            $foto_new = $package->pkg_img_them;
            if( File::exists(public_path('/img_pkg/' . $foto_new .'.jpeg' ))){
                File::delete(public_path('/img_pkg/' . $foto_new .'.jpeg' ));
            } elseif( File::exists(public_path('/img_pkg/' . $foto_new .'.jpg' ))){
                File::delete(public_path('/img_pkg/' . $foto_new .'.jpg' ));
            } elseif( File::exists(public_path('/img_pkg/' . $foto_new .'.png' ))){
                File::delete(public_path('/img_pkg/' . $foto_new .'.png' ));
            } elseif( File::exists(public_path('/img_pkg/' . $foto_new .'.JPG' ))){
                File::delete(public_path('/img_pkg/' . $foto_new .'.JPG' ));
            } elseif( File::exists(public_path('/img_pkg/' . $foto_new .'.PNG' ))){
                File::delete(public_path('/img_pkg/' . $foto_new .'.PNG' ));
            } elseif( File::exists(public_path('/img_pkg/' . $foto_new .'.JPEG' ))){
                File::delete(public_path('/img_pkg/' . $foto_new .'.JPEG' ));
            }  
            $foto = $request->file('pkg_img_them');
            $foto_name = $foto_new . '.' .$foto->getClientOriginalExtension();
            Image::make($foto)->save( public_path('/img_pkg/' . $foto_name ) );
            $user = Auth::user();
            $package= PSPkg::where('id',$package->id)->first();
            $package->save();
        }

        if ($request->hasFile('pkg_img_them2')) {
            $package->pkg_img_them2 = $package->id . '_' . $package->pkg_category_them . '_' . $package->pkg_name_them . '_2';
            $package->save();
            $foto_new = $package->pkg_img_them2;
            if( File::exists(public_path('/img_pkg/' . $foto_new .'.jpeg' ))){
                File::delete(public_path('/img_pkg/' . $foto_new .'.jpeg' ));
            } elseif( File::exists(public_path('/img_pkg/' . $foto_new .'.jpg' ))){
                File::delete(public_path('/img_pkg/' . $foto_new .'.jpg' ));
            } elseif( File::exists(public_path('/img_pkg/' . $foto_new .'.png' ))){
                File::delete(public_path('/img_pkg/' . $foto_new .'.png' ));
            } elseif( File::exists(public_path('/img_pkg/' . $foto_new .'.JPG' ))){
                File::delete(public_path('/img_pkg/' . $foto_new .'.JPG' ));
            } elseif( File::exists(public_path('/img_pkg/' . $foto_new .'.PNG' ))){
                File::delete(public_path('/img_pkg/' . $foto_new .'.PNG' ));
            } elseif( File::exists(public_path('/img_pkg/' . $foto_new .'.JPEG' ))){
                File::delete(public_path('/img_pkg/' . $foto_new .'.JPEG' ));
            }
            $foto = $request->file('pkg_img_them2');
            $foto_name = $foto_new . '.' .$foto->getClientOriginalExtension();
            Image::make($foto)->save( public_path('/img_pkg/' . $foto_name ) );
            $user = Auth::user();
            $package= PSPkg::where('id',$package->id)->first();
            $package->save();
        }

        if ($request->hasFile('pkg_img_them3')) {
            $package->pkg_img_them3 = $package->id . '_' . $package->pkg_category_them . '_' . $package->pkg_name_them . '_3';
            $package->save();
            $foto_new = $package->pkg_img_them3;
            if( File::exists(public_path('/img_pkg/' . $foto_new .'.jpeg' ))){
                File::delete(public_path('/img_pkg/' . $foto_new .'.jpeg' ));
            } elseif( File::exists(public_path('/img_pkg/' . $foto_new .'.jpg' ))){
                File::delete(public_path('/img_pkg/' . $foto_new .'.jpg' ));
            } elseif( File::exists(public_path('/img_pkg/' . $foto_new .'.png' ))){
                File::delete(public_path('/img_pkg/' . $foto_new .'.png' ));
            } elseif( File::exists(public_path('/img_pkg/' . $foto_new .'.JPG' ))){
                File::delete(public_path('/img_pkg/' . $foto_new .'.JPG' ));
            } elseif( File::exists(public_path('/img_pkg/' . $foto_new .'.PNG' ))){
                File::delete(public_path('/img_pkg/' . $foto_new .'.PNG' ));
            } elseif( File::exists(public_path('/img_pkg/' . $foto_new .'.JPEG' ))){
                File::delete(public_path('/img_pkg/' . $foto_new .'.JPEG' ));
            }
            $foto = $request->file('pkg_img_them3');
            $foto_name = $foto_new . '.' .$foto->getClientOriginalExtension();
            Image::make($foto)->save( public_path('/img_pkg/' . $foto_name ) );
            $user = Auth::user();
            $package= PSPkg::where('id',$package->id)->first();
            $package->save();
        }

        if ($request->hasFile('pkg_img_them4')) {
            $package->pkg_img_them4 = $package->id . '_' . $package->pkg_category_them . '_' . $package->pkg_name_them . '_4';
            $package->save();
            $foto_new = $package->pkg_img_them4;
            if( File::exists(public_path('/img_pkg/' . $foto_new .'.jpeg' ))){
                File::delete(public_path('/img_pkg/' . $foto_new .'.jpeg' ));
            } elseif( File::exists(public_path('/img_pkg/' . $foto_new .'.jpg' ))){
                File::delete(public_path('/img_pkg/' . $foto_new .'.jpg' ));
            } elseif( File::exists(public_path('/img_pkg/' . $foto_new .'.png' ))){
                File::delete(public_path('/img_pkg/' . $foto_new .'.png' ));
            } elseif( File::exists(public_path('/img_pkg/' . $foto_new .'.JPG' ))){
                File::delete(public_path('/img_pkg/' . $foto_new .'.JPG' ));
            } elseif( File::exists(public_path('/img_pkg/' . $foto_new .'.PNG' ))){
                File::delete(public_path('/img_pkg/' . $foto_new .'.PNG' ));
            } elseif( File::exists(public_path('/img_pkg/' . $foto_new .'.JPEG' ))){
                File::delete(public_path('/img_pkg/' . $foto_new .'.JPEG' ));
            }
            $foto = $request->file('pkg_img_them4');
            $foto_name = $foto_new . '.' .$foto->getClientOriginalExtension();
            Image::make($foto)->save( public_path('/img_pkg/' . $foto_name ) );
            $user = Auth::user();
            $package= PSPkg::where('id',$package->id)->first();
            $package->save();
        }

        return redirect()->route('show.partner.spot',['id' => $user_id]);  
    }
}

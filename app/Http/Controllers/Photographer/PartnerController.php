<?php

namespace App\Http\Controllers\Photographer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
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

}

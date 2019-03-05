<?php

namespace App\Http\Controllers\Mua;

use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\PSPkg;
use File;
use Image;
use Auth;
use Carbon\Carbon;
use App\Partner;
use App\PartnerTag;
use App\KebayaKategori;
use App\KebayaProduct;
use App\KebayaBooking;
use App\KebayaCheck;
use App\KebayaUkuran;
use App\Booking;
use App\Jam;
use App\Provinces;
use App\Regencies;
use App\Districts;
use App\Villages;
use App\Tnc;
use App\KebayaPartnerTema;
use App\KebayaPartnerWarna;
use App\KebayaBiayaSewa;
use DateTime;

class MuaBookingController extends Controller
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

    public function showStep1()
    {
        $user = Auth::user();
        $partner = DB::table('partner')
                    ->where('user_id',$user->id)
                    ->select('*')
                    ->first();
        $package = KebayaProduct::join('kebaya_category', 'kebaya_category.id', '=', 'kebaya_product.category')
                    ->where('partner_id', $user->id)
                    ->where('status', '1')
                    ->select('kebaya_category.category_name', 'kebaya_product.*')->get();

        return view('partner.mua.booking.step1', ['partner' => $partner], compact('package'));    
    }
}

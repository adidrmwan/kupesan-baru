<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use App\Provinces;
use App\Regencies;
use App\Districts;
use App\Villages;
use App\Jam;

class CountryController extends Controller
{
    public function provinces(){
      $provinces = Provinces::all();
      return view('indonesia', compact('provinces'));
    }

    public function regencies(){
      $provinces_id = Input::get('province_id');
      $regencies = Regencies::where('province_id', '=', $provinces_id)->where('name', 'KOTA SURABAYA')->get();
      return response()->json($regencies);
    }

    public function districts(){
      $regencies_id = Input::get('regencies_id');
      $districts = Districts::where('regency_id', '=', $regencies_id)->get();
      return response()->json($districts);
    }

    public function villages(){
      $districts_id = Input::get('districts_id');
      $villages = Villages::where('district_id', $districts_id)->get();
      return response()->json($villages);
    }
    
    public function regencies4(){
      $provinces_id = Input::get('province_id');
      if($provinces_id == '1'){
        //Spot Foto
        $regencies = DB::table('partner_type')->where('id', '5')->orWhere('id', '6')->orWhere('id', '7')->orWhere('id', '8')->get();
      } 
      if ($provinces_id == '2') {
        //Fotografer
        $regencies = DB::table('partner_type')->where('id', '2')->get();
      } 
      if ($provinces_id == '3') {
        //MUA
        $regencies = DB::table('partner_type')->where('id', '3')->get();
      } 
      if ($provinces_id == '4') {
        //Busana
        $regencies = DB::table('partner_type')->where('id', '4')->get();
      }
      
      return response()->json($regencies);
    }

    public function districts4(){
      $regencies_id = Input::get('regencies_id');
      $districts = Districts::where('regency_id', '=', $regencies_id)->get();
      return response()->json($districts);
    }

    public function villages4(){
      $districts_id = Input::get('districts_id');
      $villages = Villages::where('district_id', $districts_id)->get();
      return response()->json($villages);
    }
}

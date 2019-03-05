<?php

namespace App\Http\Controllers\Mua;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use File;
use Image;
use Auth;
Use Redirect;
Use App\PGPackage;
Use App\PGType;
Use App\PGDurasi;
Use App\Partner;

class MuaPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $listTag = DB::table('pg_type')->get();
        $user = Auth::user();
        $package = DB::table('pg_package')
                    ->where('partner_id',$user->id)
                    ->where('status', '1')
                    ->select('*')
                    ->get();
        $partner = DB::table('partner')
                    ->where('user_id',$user->id)
                    ->select('*')
                    ->first();
        

        return view('partner.pg.package.index', compact('partner', 'package'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        $partner = DB::table('partner')
                    ->where('user_id',$user->id)
                    ->select('*')
                    ->first();
        return view('partner.mua.package.create', compact('partner'));
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
}

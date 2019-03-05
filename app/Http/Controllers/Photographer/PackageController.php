<?php

namespace App\Http\Controllers\Photographer;

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
Use App\PGPackageType;

class PackageController extends Controller
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
        $hargaPaket = PGDurasi::where('partner_id', $partner->id)->get();

        return view('partner.pg.package.index', compact('partner', 'package', 'hargaPaket'));
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
        return view('partner.pg.package.create', compact('partner'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->pg_printed == 'Exclude' && $request->pg_printed_frame != 'Exclude') {
            return Redirect::back()->withInput(Input::all());
        }
        // dd($request);
        $user = Auth::user();
        $partner = Partner::where('user_id', $user->id)->first();

        $package = new PGPackage();
        $package->partner_id = $partner->user_id;
        $package->partner_name = $partner->pr_name;
        $package->pg_category = $partner->pr_subtype;
        $package->pg_name = $request->input('pg_name');
        $package->pg_mua = $request->input('pg_mua');
        $package->pg_stylist = $request->input('pg_stylist');
        $package->pg_desc = $request->input('pg_desc');
        $package->pg_location_jumlah = $request->input('pg_location_jumlah');
        $package->pg_album_kolase = $request->input('pg_album_kolase');
        $package->pg_album_ukuran = $request->input('pg_album_ukuran');
        $package->pg_album_jumlah_hal = $request->input('pg_album_jumlah_hal');
        $package->pg_album_jumlah_foto = $request->input('pg_album_jumlah_foto');
        $package->pg_printed = $request->input('pg_printed');
        $package->pg_printed_size = $request->input('pg_printed_size');
        $package->pg_printed_frame = $request->input('pg_printed_frame');
        $package->pg_printed_jumlah = $request->input('pg_printed_jumlah');
        $package->pg_edited = $request->input('pg_edited');
        $package->pg_edited_jumlah = $request->input('pg_edited_jumlah');
        $package->pg_edited_saved = $request->input('pg_edited_saved');
        $package->status = '1';
        $package->save();

        $dataSet = [];
        if ($package->save()) {
            for ($i = 0; $i < count($request->tag); $i++) {
                $dataSet[] = [
                    'package_id' => $package->id,
                    'type_id' => $request->tag[$i],
                ];
            }
        }
        PGPackageType::insert($dataSet);

        $durasiSet = [];
        if ($package->save()) {
            for ($i = 0; $i < count($request->durasi_jam); $i++) {
                $price = $request->durasi_harga[$i];
                $price_array = explode(".", $price);
                $pg_price = '';
                foreach ($price_array as $key => $value) {
                    $pg_price = $pg_price . $price_array[$key];
                }
                $durasiSet[] = [
                    'partner_id' => $partner->id,
                    'package_id' => $package->id,
                    'durasi_jam' => $request->durasi_jam[$i],
                    'durasi_harga' => $pg_price,
                ];
            }
        }
        PGDurasi::insert($durasiSet);

        $durasiPaket = PGDurasi::where('package_id', $package->id)->min('durasi_harga');
        $package->pg_price = $durasiPaket;
        $package->save();
        
        if ($request->hasFile('pg_img_1')) {
            $package->pg_img_1 = $package->id . '_' . $package->pg_category . '_' . $package->pg_name . '_1';
            $package->save();
            $foto_new = $package->pg_img_1;
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
            $foto = $request->file('pg_img_1');
            $foto_name = $foto_new . '.' .$foto->getClientOriginalExtension();
            Image::make($foto)->save( public_path('/img_pkg/' . $foto_name ) );
            $user = Auth::user();
            $package= PGPackage::where('partner_id',$user->id)->first();
            $package->save();
        }

        if ($request->hasFile('pg_img_2')) {
            $package->pg_img_2 = $package->id . '_' . $package->pg_category . '_' . $package->pg_name . '_2';
            $package->save();
            $foto_new = $package->pg_img_2;
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
            $foto = $request->file('pg_img_2');
            $foto_name = $foto_new . '.' .$foto->getClientOriginalExtension();
            Image::make($foto)->save( public_path('/img_pkg/' . $foto_name ) );
            $user = Auth::user();
            $package= PGPackage::where('partner_id',$user->id)->first();
            $package->save();
        }

        if ($request->hasFile('pg_img_3')) {
            $package->pg_img_3 = $package->id . '_' . $package->pg_category . '_' . $package->pg_name . '_3';
            $package->save();
            $foto_new = $package->pg_img_3;
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
            $foto = $request->file('pg_img_3');
            $foto_name = $foto_new . '.' .$foto->getClientOriginalExtension();
            Image::make($foto)->save( public_path('/img_pkg/' . $foto_name ) );
            $user = Auth::user();
            $package= PGPackage::where('partner_id',$user->id)->first();
            $package->save();
        }

        if ($request->hasFile('pg_img_4')) {
            $package->pg_img_4 = $package->id . '_' . $package->pg_category . '_' . $package->pg_name . '_4';
            $package->save();
            $foto_new = $package->pg_img_4;
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
            $foto = $request->file('pg_img_4');
            $foto_name = $foto_new . '.' .$foto->getClientOriginalExtension();
            Image::make($foto)->save( public_path('/img_pkg/' . $foto_name ) );
            $user = Auth::user();
            $package= PGPackage::where('partner_id',$user->id)->first();
            $package->save();
        }

        return redirect()->intended(route('pg-package.index'));   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $partner = DB::table('partner')
                    ->where('user_id',$user->id)
                    ->select('*')
                    ->first();
        $package = PGPackage::where('id', $id)->get();
        $packageList = PGPackage::where('id', $id)->first();
        $partnerTag = PGPackageType::join('pg_type', 'pg_type.id', '=', 'pg_package_type.package_id')->where('package_id', $packageList->id)->get();
        $durasiPaket = PGDurasi::where('package_id', $packageList->id)->get();

        return view('partner.pg.package.show', compact('package', 'partnerTag', 'partner', 'durasiPaket'));
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
        $user = Auth::user();
        $id = $request->id;
        $partner = Partner::where('user_id', $user->id)->first();
        $package = PGPackage::findOrFail($id);
        
        // $package->pg_category = $request->input('pg_category');
        $package->pg_name = $request->input('pg_name');
        $package->pg_mua = $request->input('pg_mua');
        $package->pg_stylist = $request->input('pg_stylist');
        $package->pg_desc = $request->input('pg_desc');
        $package->pg_location_jumlah = $request->input('pg_location_jumlah');
        $package->pg_album_kolase = $request->input('pg_album_kolase');
        $package->pg_album_ukuran = $request->input('pg_album_ukuran');
        $package->pg_album_jumlah_hal = $request->input('pg_album_jumlah_hal');
        $package->pg_album_jumlah_foto = $request->input('pg_album_jumlah_foto');
        $package->pg_printed = $request->input('pg_printed');
        $package->pg_printed_size = $request->input('pg_printed_size');
        $package->pg_printed_frame = $request->input('pg_printed_frame');
        $package->pg_printed_jumlah = $request->input('pg_printed_jumlah');
        $package->pg_edited = $request->input('pg_edited');
        $package->pg_edited_jumlah = $request->input('pg_edited_jumlah');
        $package->pg_edited_saved = $request->input('pg_edited_saved');
        $package->save();

        $package = PGPackage::findOrFail($id);
        
        if(!empty($request->tag)) {
            $dataSet = [];
            if ($package->save()) {
                for ($i = 0; $i < count($request->tag); $i++) {
                    $dataSet[] = [
                        'package_id' => $package->id,
                        'type_id' => $request->tag[$i],
                    ];
                }
            }
            PGPackageType::insert($dataSet);
        }
        
        if(!empty($request->durasi_jam)) {
            $durasiSet = [];
            if ($package->save()) {
                for ($i = 0; $i < count($request->durasi_jam); $i++) {
                    $price = $request->durasi_harga[$i];
                    $price_array = explode(".", $price);
                    $pg_price = '';
                    foreach ($price_array as $key => $value) {
                        $pg_price = $pg_price . $price_array[$key];
                    }
                    $durasiSet[] = [
                        'partner_id' => $partner->id,
                        'package_id' => $package->id,
                        'durasi_jam' => $request->durasi_jam[$i],
                        'durasi_harga' => $pg_price,
                    ];
                }
            }
            PGDurasi::insert($durasiSet);
        }
        
        if ($request->hasFile('pg_img_1')) {
            $package->pg_img_1 = $package->id . '_' . $package->pg_category . '_' . $package->pg_name . '_1';
            $package->save();
            $foto_new = $package->pg_img_1;
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
            $foto = $request->file('pg_img_1');
            $foto_name = $foto_new . '.' .$foto->getClientOriginalExtension();
            Image::make($foto)->save( public_path('/img_pkg/' . $foto_name ) );
            $user = Auth::user();
            $package= PGPackage::where('user_id',$user->id)->first();
            $package->save();
        }

        if ($request->hasFile('pg_img_2')) {
            $package->pg_img_2 = $package->id . '_' . $package->pg_category . '_' . $package->pg_name . '_2';
            $package->save();
            $foto_new = $package->pg_img_2;
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
            $foto = $request->file('pg_img_2');
            $foto_name = $foto_new . '.' .$foto->getClientOriginalExtension();
            Image::make($foto)->save( public_path('/img_pkg/' . $foto_name ) );
            $user = Auth::user();
            $package= PGPackage::where('user_id',$user->id)->first();
            $package->save();
        }

        if ($request->hasFile('pg_img_3')) {
            $package->pg_img_3 = $package->id . '_' . $package->pg_category . '_' . $package->pg_name . '_3';
            $package->save();
            $foto_new = $package->pg_img_3;
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
            $foto = $request->file('pg_img_3');
            $foto_name = $foto_new . '.' .$foto->getClientOriginalExtension();
            Image::make($foto)->save( public_path('/img_pkg/' . $foto_name ) );
            $user = Auth::user();
            $package= PGPackage::where('user_id',$user->id)->first();
            $package->save();
        }

        if ($request->hasFile('pg_img_4')) {
            $package->pg_img_4 = $package->id . '_' . $package->pg_category . '_' . $package->pg_name . '_4';
            $package->save();
            $foto_new = $package->pg_img_4;
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
            $foto = $request->file('pg_img_4');
            $foto_name = $foto_new . '.' .$foto->getClientOriginalExtension();
            Image::make($foto)->save( public_path('/img_pkg/' . $foto_name ) );
            $user = Auth::user();
            $package= PGPackage::where('user_id',$user->id)->first();
            $package->save();
        }
        
         return redirect()->intended(route('pg-package.index'));  
        // return redirect()->intended(route('partner.listpackage'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }

    public function deletePackage(Request $request)
    {
        $id = $request->id;
        $package = PGPackage::findOrFail($id);
        $package->status = '0';
        $package->save();
        return redirect()->intended(route('pg-package.index')); 
    }

}

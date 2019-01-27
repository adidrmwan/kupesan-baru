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

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $package = DB::table('ps_package')
                    ->where('user_id',$user->id)
                    ->where('status', '1')
                    ->select('*')
                    ->get();
        $partner = DB::table('partner')
                    ->where('user_id',$user->id)
                    ->select('*')
                    ->first();

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
        dd($request);
        $user = Auth::user();
        $partner = Partner::where('user_id', $user->id)->first();



        $package = new PSPkg();
        $package->user_id = $partner->user_id;
        $package->sub_category_id = $partner->pr_subtype;
        $package->partner_name = $partner->pr_name;
        $package->pkg_category_them = $request->input('pkg_category_them');
        $package->pkg_name_them = $request->input('pkg_name_them');
        $package->pkg_fotografer = $request->input('pkg_fotografer');
        $package->pkg_print_size = $request->input('pkg_print_size');
        $package->pkg_edited_photo = $request->input('pkg_edited_photo');
        $package->pkg_capacity = $request->input('pkg_capacity');
        $package->pkg_frame = $request->input('pkg_frame');
        $package->pkg_overtime_them = $pkg_overtime_them;
        $package->status = '1';
        $package->save();

        $dataSet = [];
        if ($package->save()) {
            for ($i = 0; $i < count($request->tag); $i++) {
                $dataSet[] = [
                    'package_id' => $package->id,
                    'tag_id' => $request->tag[$i],
                ];
            }
        }
        PartnerTag::insert($dataSet);

        $durasiSet = [];
        if ($package->save()) {
            for ($i = 0; $i < count($request->durasi_jam); $i++) {
                $price = $request->durasi_harga[$i];
                $price_array = explode(".", $price);
                $pkg_price_them = '';
                foreach ($price_array as $key => $value) {
                    $pkg_price_them = $pkg_price_them . $price_array[$key];
                }
                $durasiSet[] = [
                    'partner_id' => $partner->id,
                    'package_id' => $package->id,
                    'durasi_jam' => $request->durasi_jam[$i],
                    'durasi_harga' => $pkg_price_them,
                ];
            }
        }
        PartnerDurasi::insert($durasiSet);

        $durasiPaket = PartnerDurasi::where('package_id', $package->id)->min('durasi_harga');
        $package->pkg_price_them = $durasiPaket;
        $package->save();
        
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
            $package= PSPkg::where('user_id',$user->id)->first();
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
            $package= PSPkg::where('user_id',$user->id)->first();
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
            $package= PSPkg::where('user_id',$user->id)->first();
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
            $package= PSPkg::where('user_id',$user->id)->first();
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

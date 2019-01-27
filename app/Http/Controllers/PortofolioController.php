<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Auth;
use App\Partner;
use App\FasilitasPartner;
use App\Album;
use File;
use Image;

class PortofolioController extends Controller
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

    public function showPortofolio()
    {
        $user = Auth::user();
        // $album = Album::where('user_id', $user->id)->first();
        $partner = DB::table('partner')
                    ->where('user_id',$user->id)
                    ->select('*')
                    ->first();
        if ($partner->status != 1) {
            return redirect()->route('partner.dashboard', compact('partner'));
        }
        $data = DB::table('album')
                ->where('user_id', $user->id)
                ->select('*')
                ->first();
        return view('partner.portofolio.album-portofolio', ['data' => $data, 'partner' => $partner]);
    }

    public function uploadPortofolio(Request $request)
    {
        $user = Auth::user();
        $album = Album::where('user_id', $user->id)->first();
        
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
            $album = Album::where('user_id', $user->id)->first();
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
            $album = Album::where('user_id', $user->id)->first();
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
            $album = Album::where('user_id', $user->id)->first();
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
            $album = Album::where('user_id', $user->id)->first();
            $album->save();
        }
        
        return redirect()->intended(route('partner.portofolio'));
        
    }

    public function updatePortofolio(Request $request)
    {
        $user = Auth::user();
        $album = Album::where('user_id', $user->id)->first();
        
        if ($request->hasFile('album_img_1')) {
            $album->album_img_1 = $album->id . '_' . $album->user_id . '_album1';
            $album->save();
            
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
            $album = Album::where('user_id', $user->id)->first();
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
            $album = Album::where('user_id', $user->id)->first();
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
            $album = Album::where('user_id', $user->id)->first();
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
            $album = Album::where('user_id', $user->id)->first();
            $album->save();
        }
        
        return redirect()->intended(route('partner.portofolio'));
        
    }
}

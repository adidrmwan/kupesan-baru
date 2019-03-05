<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Partner;
use App\FasilitasPartner;
use App\Album;
use File;
use Image;

class AlbumController extends Controller
{
	public function updateFasilitas(Request $request)
    {
        $user = Auth::user();
        $fasilitas = FasilitasPartner::where('user_id', $user->id)->first();
        $fasilitas->toilet = $request->input('toilet');
        $fasilitas->wifi = $request->input('wifi');
        $fasilitas->rganti = $request->input('rganti');
        $fasilitas->ac = $request->input('ac');
        $fasilitas->parkir = $request->input('parkir');
        $fasilitas->save();
        return redirect()->intended(route('partner.profile'));
    }
}

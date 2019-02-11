<div class="main-block flight-block" style="box-shadow: 5px 10px 8px #C9CACA;">
    <div class="frame" style="outline: 1px solid #C9CACA;;" >
        <div class="img-hover" >
            

                    @if(File::exists(public_path("img_pkg/".$data->pg_img_1.".jpg")))
                    <a class="image-popup-no-margins" href="{{ asset('img_pkg/'.$data->pg_img_1.'.jpg')  }}">
                    <img class="" src="{{ asset('img_pkg/'.$data->pg_img_1.'.jpg')  }}" alt= "Package Image" style="max-width: 100%; height: 250px; margin: 0 auto; width: auto; float: none; display: block;position: relative;" />
            </a>
        </div>
        <div class="img-hover" >
            
                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_1.".jpeg")))
                    <a class="image-popup-no-margins" href="{{ asset('img_pkg/'.$data->pg_img_1.'.jpeg')  }}">
                    <img class="" src="{{ asset('img_pkg/'.$data->pg_img_1.'.jpeg')  }}" alt= "Package Image" style="max-width: 100%; height: 250px; margin: 0 auto; width: auto; float: none; display: block;position: relative;"/>
            </a>
        </div>
        <div class="img-hover" >
            
                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_1.".png")))
                    <a class="image-popup-no-margins" href="{{ asset('img_pkg/'.$data->pg_img_1.'.png')  }}">
                    <img class="" src="{{ asset('img_pkg/'.$data->pg_img_1.'.png')  }}" alt= "Package Image" style="max-width: 100%; height: 250px; margin: 0 auto; width: auto; float: none; display: block;position: relative;" />
            </a>
        </div>
        <div class="img-hover" >
            
                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_1.".JPG")))
                    <a class="image-popup-no-margins" href="{{ asset('img_pkg/'.$data->pg_img_1.'.JPG')  }}">
                    <img class="" src="{{ asset('img_pkg/'.$data->pg_img_1.'.JPG')  }}" alt= "Package Image" style="max-width: 100%; height: 250px; margin: 0 auto; width: auto; float: none; display: block;position: relative;" />
            </a>
        </div>
        <div class="img-hover" >
            
                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_1.".JPEG")))
                    <a class="image-popup-no-margins" href="{{ asset('img_pkg/'.$data->pg_img_1.'.JPEG')  }}">
                    <img class="" src="{{ asset('img_pkg/'.$data->pg_img_1.'.JPEG')  }}" alt= "Package Image" style="max-width: 100%; height: 250px; margin: 0 auto; width: auto; float: none; display: block;position: relative;" />
            </a>
        </div>
        <div class="img-hover" >
            
                    @elseif(File::exists(public_path("img_pkg/".$data->pg_img_1.".PNG")))
                    <a class="image-popup-no-margins" href="{{ asset('img_pkg/'.$data->pg_img_1.'.PNG')  }}">
                    <img class="" src="{{ asset('img_pkg/'.$data->pg_img_1.'.PNG')  }}" alt= "Package Image" style="max-width: 100%; height: 250px; margin: 0 auto; width: auto; float: none; display: block;position: relative;" />
                    @endif
            </a>
        </div>
        <div class = "details" >
            <br>
            <p style="text-align:center; color: white;">
                <b>MUA</b> : {{$data->pg_mua}}<br>
                <b>Stylist</b> : {{$data->pg_stylist}}<br>
                Max <b>{{$data->pg_location_jumlah}}</b> Location<br> 
                <b>Exclusive Album</b> : {{$data->pg_album_kolase}}<br>
                @if($data->pg_album_kolase == 'Include')
                ({{$data->pg_album_ukuran}}, {{$data->pg_album_foto}} Sheets, {{$data->pg_album_jumlah_hal}} Pages)<br>
                @endif
                <b>Printed Photo</b> : {{$data->pg_printed}}<br>
                @if($data->pg_printed == 'Include')
                ({{$data->pg_printed_jumlah}} Photos, {{$data->pg_printed_size}}
                    @if($data->pg_printed_frame == 'Include')
                        + Frame)
                    @endif
                    <br>
                @endif
                <b>Edited Photo</b> : {{$data->pg_edited}}<br>
                @if($data->pg_edited == 'Include')
                ({{$data->pg_edited_jumlah}} Photos, {{$data->pg_edited_saved}})
                @endif
            </p>
        </div>
    </div>
    
    
    <div class="flight-info" style="outline:1px solid grey; ">
        <div class="flight-title" style="text-align: center;">
            @if(strlen($data->partner_name) > 10)
            <h3 class="text-uppercase" style="font-size:15px;">{{$data->partner_name}}</h3>
            @else
            <h3 class="text-uppercase" style="font-size:15px;">{{$data->partner_name}}</h3>
            @endif
        </div><!-- end flight-title -->
        
        <ul class="list-unstyled list-inline offer-price-1">
            <li class="price">{{$data->pg_name}}</li><br>
            @if(Auth::check())
            <li >Rp {{ number_format($data->pg_price, 0, ',', '.') }} / Paket</li><br>
            @endif
            <!-- <li >Rp {{$data->pkg_overtime_them}} / Overtime</li><br> -->
            <li>
                <a href="{{route('pg.step1', ['package_id' => $data->id])}}">
                    <button type="submit" class="btn btn-pink" style=" padding: 5px 15px; margin-top: 6px;"><span style="color: white; text-decoration: none;">Pesan</span>
                    </button>
                </a>
            </li><br>
            <li>
                <a href="{{route('detail.fotografer', ['id' => $data->partner_id])}}">
                    <button type="submit" class="btn btn-pink" style=" padding: 5px 15px; margin-top: 6px;"><span style="color: white; text-decoration: none;">View More</span>
                    </button>
                </a>
            </li>
        </ul>
    </div>
</div>